<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Question;
use App\Models\ChapterCompletion;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        $chapter->load('questions', 'comments.user', 'comments.replies.user');
        
        return view('chapters.show', compact('chapter'));
    }

    // Murid: Submit jawaban soal (multiple answers)
    public function submitAnswer(Request $request, Chapter $chapter)
    {
        try {
            $validated = $request->validate([
                'answers' => 'required|array',
            ]);

            $user = $request->user();
            $enrollment = $user->enrollments()->where('module_id', $chapter->module_id)->first();
            if (!$enrollment) {
                return response()->json(['error' => 'Not enrolled'], 403);
            }

            // Prepare questions keyed by id for quick lookup
            $questions = $chapter->questions->keyBy('id');
            $totalXp = 0;
            $essayPending = 0;

            foreach ($validated['answers'] as $questionId => $answerText) {
                $question = $questions->get($questionId);
                if (!$question) continue;

                // Save or update answer record
                $answerRecord = \App\Models\Answer::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'question_id' => $question->id,
                    ],
                    [
                        'chapter_id' => $chapter->id,
                        'answer_text' => is_array($answerText) ? json_encode($answerText) : (string) $answerText,
                    ]
                );

                // Auto-grade multiple choice
                if ($question->type === 'multiple_choice') {
                    $isCorrect = trim((string) $answerText) === trim((string) $question->correct_answer);
                    $points = $isCorrect ? (int)$question->points : 0;

                    $answerRecord->is_correct = $isCorrect;
                    $answerRecord->points_awarded = $points;
                    $answerRecord->graded_at = now();
                    $answerRecord->graded_by = null; // system
                    $answerRecord->save();

                    if ($isCorrect) {
                        $totalXp += $points;
                    }
                } else {
                    // Essay: leave is_correct null until teacher grades
                    $answerRecord->is_correct = null;
                    $answerRecord->points_awarded = 0;
                    $answerRecord->save();
                    $essayPending++;
                }
            }

            // Add XP to user's daily XP (only awarded for correct MCQs for now)
            if ($totalXp > 0) {
                $user->dailyXps()->firstOrCreate(
                    ['date' => now()->toDateString()],
                    ['xp_points' => 0, 'activity' => 'Mengerjakan soal']
                )->increment('xp_points', $totalXp);
            }

            // Determine chapter completion: require all questions to be correct (MCQ) and essays must be graded as correct
            $totalQuestions = $questions->count();
            $correctCount = \App\Models\Answer::where('user_id', $user->id)
                ->where('chapter_id', $chapter->id)
                ->where('is_correct', true)
                ->count();

            // For essays, only count those already graded true
            $gradedEssayCount = \App\Models\Answer::where('user_id', $user->id)
                ->where('chapter_id', $chapter->id)
                ->where('is_correct', true)
                ->count();

            // If number of correct answers equals total questions, mark as completed
            $chapterCompleted = ($correctCount >= $totalQuestions && $totalQuestions > 0);

            if ($chapterCompleted) {
                \App\Models\ChapterCompletion::firstOrCreate([
                    'user_id' => $user->id,
                    'chapter_id' => $chapter->id,
                ]);
            }

            // Recalculate enrollment progress based on chapter_completions across module
            $module = $chapter->module()->with('chapters')->first();
            $totalChapters = $module->chapters->count() ?: 1;
            $completedChapters = \App\Models\ChapterCompletion::where('user_id', $user->id)
                ->whereIn('chapter_id', $module->chapters->pluck('id'))
                ->count();

            $progress = intval(($completedChapters / $totalChapters) * 100);
            $enrollment->progress = $progress;
            if ($progress >= 100) {
                $enrollment->status = 'completed';
            }
            $enrollment->save();

            return response()->json([
                'success' => 'Jawaban disimpan',
                'xp' => $totalXp,
                'totalXp' => $user->dailyXps()->sum('xp_points'),
                'chapterCompleted' => $chapterCompleted,
                'essayPending' => $essayPending,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Invalid input', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Log and return JSON so client doesn't get HTML error page
            logger()->error('submitAnswer error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }

    // Guru: Form create chapter
    public function create(\App\Models\Module $module)
    {
        return view('chapters.create', compact('module'));
    }

    // Guru: Save chapter
    public function store(Request $request, \App\Models\Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'youtube_url' => 'required|string|max:500',
            'order' => 'required|integer|min:1',
        ]);

        $chapter = $module->chapters()->create($validated);
        return redirect()->route('modules.edit', $module)->with('success', 'Chapter berhasil ditambahkan');
    }

    // Guru: Form edit chapter
    public function edit(Chapter $chapter)
    {
        $module = $chapter->module;
        return view('chapters.edit', compact('chapter', 'module'));
    }

    // Guru: Update chapter
    public function update(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'youtube_url' => 'required|string|max:500',
            'order' => 'required|integer|min:1',
        ]);

        $chapter->update($validated);
        return redirect()->route('modules.edit', $chapter->module)->with('success', 'Chapter berhasil diubah');
    }

    // Guru: Delete chapter
    public function destroy(Chapter $chapter)
    {
        $module = $chapter->module;
        $chapter->delete();
        return redirect()->route('modules.edit', $module)->with('success', 'Chapter berhasil dihapus');
    }
}
