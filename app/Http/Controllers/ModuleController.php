<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Chapter;
use App\Models\ChapterPage;
use App\Models\ChapterCompletion;
use App\Models\ChapterResult;
use App\Models\ChapterPageProgress;
use App\Models\ModuleComment;
use App\Models\ModuleNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Browsershot\Browsershot;

class ModuleController extends Controller
{
    /* ======================================================
       GURU MODULE MANAGEMENT
    ====================================================== */
    public function guruIndex()
    {
        $modules = Module::orderBy('order')->get();
        return view('guru.modul.index', compact('modules'));
    }

    public function create()
    {
        return view('guru.modul.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'required|integer|min:1',
        ]);

        Module::create($validated);

        return redirect()->route('guru.modul.index')
            ->with('success', 'Modul berhasil ditambahkan.');
    }

    public function edit(Module $module)
    {
        return view('guru.modul.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'required|integer|min:1',
        ]);

        $module->update($validated);

        return redirect()->route('guru.modul.index')
            ->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('guru.modul.index')
            ->with('success', 'Modul berhasil dihapus.');
    }

    /* ======================================================
       MURID MODULE PAGE
    ====================================================== */
    public function index()
    {
        $modules = Module::orderBy('order')->get();
        return view('dashboard.modul', compact('modules'));
    }

    public function show($id)
    {
        $module = Module::with(['chapters', 'comments.user', 'comments.replies'])->findOrFail($id);

        $completedChapters = ChapterCompletion::where('user_id', Auth::id())
            ->whereIn('chapter_id', $module->chapters->pluck('id'))
            ->pluck('chapter_id')
            ->toArray();

        return view('dashboard.modul_show', compact('module', 'completedChapters'));
    }

    /* ======================================================
       CHAPTER PROTECTION
    ====================================================== */
    public function chapter($id)
    {
        $chapter = Chapter::with('pages', 'module.chapters')->findOrFail($id);
        $user = Auth::user();

        $chapters = $chapter->module->chapters()->orderBy('order')->get();

        $previousChapter = $chapters
            ->where('order', '<', $chapter->order)
            ->sortByDesc('order')
            ->first();

        if ($previousChapter) {
            $isPassed = ChapterResult::where('chapter_id', $previousChapter->id)
                ->where('user_id', $user->id)
                ->where('passed', true)
                ->exists();

            if (!$isPassed) {
                return back()->with('error', 'Selesaikan chapter sebelumnya terlebih dahulu.');
            }
        }

        $firstPage = $chapter->pages()->orderBy('page_number')->first();
        if (!$firstPage) abort(404);

        return redirect()->route('murid.modules.page', [
            'chapter' => $chapter->id,
            'page'    => $firstPage->page_number
        ]);
    }


    /* ======================================================
       PAGE VIEW
    ====================================================== */
    public function page($chapterId, $pageNumber)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $pages   = $chapter->pages()->orderBy('page_number')->get();
        $page    = $pages->where('page_number', $pageNumber)->first();

        if (!$page) abort(404);

        $progress = ChapterPageProgress::firstOrCreate(
            [
                'user_id'   => Auth::id(),
                'chapter_id'=> $chapterId,
                'page_id'   => $page->id,
            ],
            [
                'status' => 'pending',
                'score'  => 0,
                'answer' => null,
            ]
        );

        return view('dashboard.page', compact('chapter', 'pages', 'page', 'progress'));
    }


    /* ======================================================
       COMPLETE PAGE LOGIC
    ====================================================== */
    public function complete(Request $request, $chapterId, $currentPage)
    {
        $chapter = Chapter::with('pages')->findOrFail($chapterId);
        $user    = Auth::user();

        $page = $chapter->pages()
            ->where('page_number', $currentPage)
            ->firstOrFail();

        $progress = ChapterPageProgress::firstOrCreate(
            [
                'user_id'   => $user->id,
                'chapter_id'=> $chapter->id,
                'page_id'   => $page->id,
            ]
        );

        if ($page->type === 'video') {
            $progress->update(['status' => 'done']);
        }

        if ($page->type === 'question') {
            $saved = ChapterPageProgress::where('user_id', $user->id)
                ->where('chapter_id', $chapter->id)
                ->where('page_id', $page->id)
                ->first();

            $answer = $request->answer ?? $saved->answer ?? null;

            if (!$answer) {
                return back()->with('error', 'Pilih jawaban dulu.');
            }

            $isCorrect = $answer == $page->correct_answer;
            $score     = $isCorrect ? 100 : 0;

            $progress->update([
                'status' => 'done',
                'score'  => $score,
                'answer' => $answer,
            ]);
        }

        $nextPage = $chapter->pages()
            ->where('page_number', '>', $currentPage)
            ->orderBy('page_number')
            ->first();

        if ($nextPage) {
            return redirect()->route('murid.modules.page', [
                'chapter' => $chapterId,
                'page'    => $nextPage->page_number
            ]);
        }

        $allPagesDone = $chapter->pages->every(function ($p) use ($user, $chapter) {
            return ChapterPageProgress::where('user_id', $user->id)
                ->where('chapter_id', $chapter->id)
                ->where('page_id', $p->id)
                ->where('status', 'done')
                ->exists();
        });

        if ($allPagesDone) {
            ChapterCompletion::updateOrCreate(
                ['user_id' => $user->id, 'chapter_id' => $chapter->id],
                ['completed_at' => now()]
            );
        }

        $questionPages  = $chapter->pages()->where('type', 'question')->get();
        $totalQuestions = $questionPages->count();
        $correctCount   = 0;

        foreach ($questionPages as $q) {
            $pr = ChapterPageProgress::where('user_id', $user->id)
                ->where('page_id', $q->id)
                ->first();

            if ($pr && $pr->score == 100) {
                $correctCount++;
            }
        }

        $scorePercent = $totalQuestions > 0
            ? round(($correctCount / $totalQuestions) * 100)
            : 100;

        ChapterResult::updateOrCreate(
            ['user_id' => $user->id, 'chapter_id' => $chapter->id],
            [
                'score'   => $scorePercent,
                'correct' => $correctCount,
                'total'   => $totalQuestions,
                'passed'  => $scorePercent >= 75,
            ]
        );

        if ($scorePercent < 75) {
            return back()->with('error', "Nilai kamu {$scorePercent}%. Minimal 75% untuk lanjut.");
        }

        $module     = $chapter->module;
        $chapterIds = $module->chapters->pluck('id');

        $passedCount = ChapterResult::where('user_id', $user->id)
            ->whereIn('chapter_id', $chapterIds)
            ->where('passed', true)
            ->count();

        if ($passedCount == $chapterIds->count()) {
            $avgScore = round(
                ChapterResult::where('user_id', $user->id)
                    ->whereIn('chapter_id', $chapterIds)
                    ->avg('score')
            );

            return redirect()->route('murid.modules.result', [
                'id'  => $module->id,
                'avg' => $avgScore
            ]);
        }

        return redirect()->route('murid.modules.show', $module->id);
    }

    /* ======================================================
       RESULT PAGE
    ====================================================== */
    public function result($id)
    {
        $module = Module::with('chapters')->findOrFail($id);

        return view('dashboard.modul_result', [
            'module' => $module,
            'score'  => request()->avg,
        ]);
    }

    /* ======================================================
       CERTIFICATE (BROWSERSHOT FINAL)
    ====================================================== */
    public function certificate($id)
    {
        $module = Module::with('chapters')->findOrFail($id);
        $user = Auth::user();

        $chapterIds = $module->chapters->pluck('id');
        $passedAll = ChapterResult::whereIn('chapter_id', $chapterIds)
            ->where('user_id', $user->id)
            ->where('passed', true)
            ->count() == $chapterIds->count();

        if (!$passedAll) {
            return back()->with('error', 'Beberapa chapter belum lulus.');
        }

        $avgScore = round(
            ChapterResult::whereIn('chapter_id', $chapterIds)
                ->where('user_id', $user->id)
                ->avg('score')
        );

        $date = now()->format('d F Y');

        // Render HTML
        $html = view('dashboard.certificate_pdf', [
            'user'   => $user,
            'module' => $module,
            'score'  => $avgScore,
            'date'   => $date,
        ])->render();

        $pdfPath = storage_path("app/certificate-{$user->id}.pdf");

        Browsershot::html($html)
            ->setNodeBinary('C:\Program Files\nodejs\node.exe')
            ->setNpmBinary('C:\Program Files\nodejs\npm.cmd')
            ->setChromePath('C:\Program Files\Google\Chrome\Application\chrome.exe')
            ->showBackground()
            ->landscape()
            ->margins(0, 0, 0, 0)
            ->format('A4')
            ->setOption('args', [
                '--disable-web-security',
                '--allow-file-access-from-files'
            ])
            ->timeout(60)
            ->save($pdfPath);

        return response()->file($pdfPath);
    }

    /* ======================================================
       COMMENT SYSTEM
    ====================================================== */
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment'   => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:module_comments,id'
        ]);

        ModuleComment::create([
            'module_id' => $id,
            'user_id'   => Auth::id(),
            'comment'   => $request->comment,
            'parent_id' => $request->parent_id,
        ]);

        $module = Module::findOrFail($id);
        $gurus  = User::where('role', 'guru')->get();

        foreach ($gurus as $guru) {
            if ($guru->id != Auth::id()) {
                ModuleNotification::create([
                    'module_id'    => $module->id,
                    'from_user_id' => Auth::id(),
                    'to_user_id'   => $guru->id,
                    'message'      => Auth::user()->name . " mengomentari modul: " . $module->title,
                ]);
            }
        }

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function deleteComment($id)
    {
        $comment = ModuleComment::findOrFail($id);

        if ($comment->user_id !== Auth::id() && Auth::user()->role !== 'guru') {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    /* ======================================================
       GURU VIEW COMMENTS
    ====================================================== */
    public function guruComments($id)
    {
        $module = Module::with([
            'comments' => function ($q) {
                $q->orderBy('created_at', 'asc');
            },
            'comments.replies',
            'comments.user'
        ])->findOrFail($id);

        return view('guru.modul_comments', compact('module'));
    }

    /* ======================================================
       NOTIFICATIONS
    ====================================================== */
    public function guruNotif()
    {
        $notifs = ModuleNotification::where('to_user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.notif.index', compact('notifs'));
    }

    public function markNotifRead($id)
    {
        $notif = ModuleNotification::findOrFail($id);

        if ($notif->to_user_id != Auth::id()) {
            abort(403);
        }

        $notif->update([
            'read' => true
        ]);

        return back();
    }

    public function clearNotif()
    {
        ModuleNotification::where('to_user_id', Auth::id())->delete();

        return back()->with('success', 'Semua notifikasi berhasil dihapus.');
    }

    /* ======================================================
       LEADERBOARD
    ====================================================== */
    public function leaderboard($moduleId)
    {
        $module = Module::with('chapters')->findOrFail($moduleId);

        $chapterIds = $module->chapters->pluck('id');

        $leaderboard = ChapterResult::select(
                'user_id',
                DB::raw('AVG(score) as avg_score'),
                DB::raw('SUM(passed) as passed_count')
            )
            ->whereIn('chapter_id', $chapterIds)
            ->groupBy('user_id')
            ->orderByDesc('avg_score')
            ->get();

        $users = User::whereIn('id', $leaderboard->pluck('user_id'))->get()->keyBy('id');

        return view('dashboard.leaderboard', compact('module', 'leaderboard', 'users'));
    }

    /* ======================================================
       AUTOSAVE ANSWER
    ====================================================== */
    public function autosave(Request $request)
    {
        $request->validate([
            'chapter_id' => 'required|integer',
            'page_id'    => 'required|integer',
            'answer'     => 'required|string'
        ]);

        ChapterPageProgress::updateOrCreate(
            [
                'user_id'    => Auth::id(),
                'chapter_id' => $request->chapter_id,
                'page_id'    => $request->page_id,
            ],
            [
                'answer' => $request->answer,
            ]
        );

        return response()->json(['status' => 'saved']);
    }

    
}
