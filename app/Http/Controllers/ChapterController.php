<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\ChapterCompletion;
use App\Models\Enrollment;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\XpHelper;

class ChapterController extends Controller
{
    // ===========================
    // GURU: LIST CHAPTER
    // ===========================
    public function index(Module $module)
    {
        $module->load('chapters');
        return view('guru.chapters.index', compact('module'));
    }

    // ===========================
    // MURID: TAMPILKAN CHAPTER
    // ===========================
    public function show(Chapter $chapter)
    {
        if (Auth::check()) {
            XpHelper::addXP(Auth::user(), 20);
        }

        $chapter->load('questions', 'comments.user', 'comments.replies.user');

        return view('chapters.show', compact('chapter'));
    }

    // ===========================
    // MURID: SUBMIT JAWABAN
    // ===========================
    public function submitAnswer(Request $request, Chapter $chapter)
    {
        try {
            $validated = $request->validate([
                'answers' => 'required|array',
            ]);

            $user = $request->user();

            // CEK ENROLLMENT
            $enrollment = $user->enrollments()
                ->where('module_id', $chapter->module_id)
                ->first();

            if (!$enrollment) {
                return response()->json(['error' => 'Not enrolled'], 403);
            }

            $questions = $chapter->questions->keyBy('id');
            $totalXp = 0;
            $essayPending = 0;

            // SIMPAN JAWABAN
            foreach ($validated['answers'] as $questionId => $answerText) {
                $question = $questions->get($questionId);
                if (!$question) continue;

                $answerRecord = Answer::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'question_id' => $question->id,
                    ],
                    [
                        'chapter_id' => $chapter->id,
                        'answer_text' => is_array($answerText)
                            ? json_encode($answerText)
                            : (string)$answerText,
                    ]
                );

                if ($question->type === 'multiple_choice') {

                    // BENAR / SALAH
                    $isCorrect = trim($answerText) === trim($question->correct_answer);
                    $points = $isCorrect ? (int)$question->points : 0;

                    $answerRecord->is_correct = $isCorrect;
                    $answerRecord->points_awarded = $points;
                    $answerRecord->graded_at = now();
                    $answerRecord->graded_by = null;
                    $answerRecord->save();

                    if ($isCorrect) {
                        $totalXp += $points;
                    }

                } else {
                    // ESSAY
                    $answerRecord->is_correct = null;
                    $answerRecord->points_awarded = 0;
                    $answerRecord->save();
                    $essayPending++;
                }
            }

            // TAMBAH DAILY XP
            if ($totalXp > 0) {
                $user->dailyXps()->firstOrCreate(
                    ['date' => now()->toDateString()],
                    ['xp_points' => 0, 'activity' => 'Mengerjakan soal']
                )->increment('xp_points', $totalXp);
            }

            // HITUNG PROGRESS CHAPTER
            $totalQuestions = $questions->count();
            $correctCount = Answer::where('user_id', $user->id)
                ->where('chapter_id', $chapter->id)
                ->where('is_correct', true)
                ->count();

            $chapterCompleted = ($correctCount >= $totalQuestions && $totalQuestions > 0);

            if ($chapterCompleted) {
                ChapterCompletion::firstOrCreate([
                    'user_id' => $user->id,
                    'chapter_id' => $chapter->id,
                ]);
            }

            // HITUNG PROGRESS MODULE
            $module = $chapter->module()->with('chapters')->first();
            $totalChapters = $module->chapters->count() ?: 1;

            $completedChapters = ChapterCompletion::where('user_id', $user->id)
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

        } catch (\Exception $e) {
            logger()->error('submitAnswer error: '.$e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    // ===========================
    // GURU: FORM CREATE
    // ===========================
    public function create(Module $module)
    {
        return view('guru.chapters.create', compact('module'));
    }

    // ===========================
    // GURU: STORE
    // ===========================
    public function store(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'nullable|string',
            'video_url'   => 'nullable|string|max:500',
            'order'       => 'required|integer|min:1',
        ]);

        $module->chapters()->create($validated);

        return redirect()
            ->route('guru.modul.chapter.index', $module->id)
            ->with('success', 'Chapter berhasil ditambahkan');
    }

    // ===========================
    // GURU: FORM EDIT
    // ===========================
    public function edit(Chapter $chapter)
    {
        $module = $chapter->module;
        return view('guru.chapters.edit', compact('chapter', 'module'));
    }

    // ===========================
    // GURU: UPDATE
    // ===========================
    public function update(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'nullable|string',
            'video_url'   => 'nullable|string|max:500',
            'order'       => 'required|integer|min:1',
        ]);

        $chapter->update($validated);

        return redirect()
            ->route('guru.modul.chapter.index', $chapter->module_id)
            ->with('success', 'Chapter berhasil diubah');
    }

    // ===========================
    // GURU: DELETE
    // ===========================
    public function destroy(Chapter $chapter)
    {
        $moduleId = $chapter->module_id;
        $chapter->delete();

        return redirect()
            ->route('guru.modul.chapter.index', $moduleId)
            ->with('success', 'Chapter berhasil dihapus');
    }
}
