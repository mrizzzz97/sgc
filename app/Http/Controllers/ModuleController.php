<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Chapter;
use App\Models\ChapterPage;
use App\Models\ChapterCompletion;
use App\Models\ChapterResult;
use App\Models\ChapterPageProgress;
use App\Models\ModuleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ModuleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GURU: LIST MODUL
    |--------------------------------------------------------------------------
    */
    public function guruIndex()
    {
        $modules = Module::orderBy('order')->get();
        return view('guru.modul.index', compact('modules'));
    }

    /*
    |--------------------------------------------------------------------------
    | GURU: FORM CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('guru.modul.create');
    }

    /*
    |--------------------------------------------------------------------------
    | GURU: SIMPAN MODUL
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|string|max:50',
            'order'       => 'required|integer|min:1',
        ]);

        Module::create($validated);

        return redirect()
            ->route('guru.modul.index')
            ->with('success', 'Modul berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | GURU: EDIT MODUL
    |--------------------------------------------------------------------------
    */
    public function edit(Module $module)
    {
        return view('guru.modul.edit', compact('module'));
    }

    /*
    |--------------------------------------------------------------------------
    | GURU: UPDATE MODUL
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|string|max:50',
            'order'       => 'required|integer|min:1',
        ]);

        $module->update($validated);

        return redirect()
            ->route('guru.modul.index')
            ->with('success', 'Modul berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | GURU: DELETE MODUL
    |--------------------------------------------------------------------------
    */
    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()
            ->route('guru.modul.index')
            ->with('success', 'Modul berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | MURID: LIST SEMUA MODUL
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $modules = Module::orderBy('order')->get();
        return view('dashboard.modul', compact('modules'));
    }

    /*
    |--------------------------------------------------------------------------
    | MURID: TAMPILKAN DETAIL MODUL
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $module = Module::with(['chapters', 'comments.user'])->findOrFail($id);

        $user = Auth::user();

        $completedChapters = ChapterCompletion::where('user_id', $user->id)
            ->whereIn('chapter_id', $module->chapters->pluck('id'))
            ->pluck('chapter_id')
            ->toArray();

        return view('dashboard.modul_show', [
            'module' => $module,
            'completedChapters' => $completedChapters,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | MURID: MASUK KE CHAPTER (AUTO KE PAGE 1)
    |--------------------------------------------------------------------------
    */
    public function chapter($id)
    {
        $chapter = Chapter::with('pages')->findOrFail($id);

        $firstPage = $chapter->pages()->orderBy('page_number')->first();

        if (!$firstPage) abort(404, 'Chapter belum memiliki halaman.');

        return redirect()->route('murid.modules.page', [
            'chapter' => $chapter->id,
            'page' => $firstPage->page_number
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | MURID: TAMPILKAN HALAMAN
    |--------------------------------------------------------------------------
    */
    public function page($chapterId, $pageNumber)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $pages = $chapter->pages()->orderBy('page_number')->get();
        $page = $pages->where('page_number', $pageNumber)->first();

        if (!$page) abort(404);

        $user = Auth::user();

        // Progress record → create jika belum ada
        $progress = ChapterPageProgress::firstOrCreate(
            [
                'user_id'   => $user->id,
                'chapter_id'=> $chapter->id,
                'page_id'   => $page->id,
            ],
            [
                'status' => 'pending',
                'score'  => 0,
                'answer' => null,
            ]
        );

        return view('dashboard.page', [
            'chapter'  => $chapter,
            'pages'    => $pages,
            'page'     => $page,
            'progress' => $progress,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | MURID: COMPLETE PAGE
    |--------------------------------------------------------------------------
    */
    public function complete(Request $request, $chapterId, $currentPage)
    {
        $chapter = Chapter::with('pages')->findOrFail($chapterId);
        $user = Auth::user();

        $page = $chapter->pages()
            ->where('page_number', $currentPage)
            ->firstOrFail();

        // Ambil progress record
        $progress = ChapterPageProgress::firstOrCreate(
            [
                'user_id'   => $user->id,
                'chapter_id'=> $chapter->id,
                'page_id'   => $page->id,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | PAGE = VIDEO
        |--------------------------------------------------------------------------
        */
        if ($page->type === 'video') {
            $progress->update([
                'status' => 'done',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PAGE = QUESTION
        |--------------------------------------------------------------------------
        */
        if ($page->type === 'question') {

            $answer = $request->answer;
            if (!$answer) {
                return back()->with('error', 'Pilih jawaban dulu.');
            }

            $isCorrect = $answer == $page->correct_answer;
            $score = $isCorrect ? 100 : 0;

            $progress->update([
                'status' => 'done',
                'score'  => $score,
                'answer' => $answer,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | NEXT PAGE
        |--------------------------------------------------------------------------
        */
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

        /*
        |--------------------------------------------------------------------------
        | CHAPTER SELESAI → HITUNG NILAI CHAPTER
        |--------------------------------------------------------------------------
        */
        $questionPages = $chapter->pages()->where('type', 'question')->get();
        $totalQuestions = $questionPages->count();
        $correctCount = 0;

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

        $passed = $scorePercent >= 75;

        ChapterResult::updateOrCreate(
            ['user_id' => $user->id, 'chapter_id' => $chapter->id],
            [
                'score'   => $scorePercent,
                'correct' => $correctCount,
                'total'   => $totalQuestions,
                'passed'  => $passed,
            ]
        );

        if (!$passed) {
            return redirect()->route('murid.modules.page', [
                'chapter' => $chapter->id,
                'page' => $page->page_number
            ])->with('error', "Nilai kamu {$scorePercent}%. Minimal 75% untuk lanjut.");
        }

        /*
        |--------------------------------------------------------------------------
        | FINISH CHAPTER PAGE
        |--------------------------------------------------------------------------
        */
        $chapterFinishRedirect = redirect()->route('murid.chapter.finish', [
            'chapter' => $chapter->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK MODUL SELESAI?
        |--------------------------------------------------------------------------
        */
        $module = $chapter->module;
        $chapterIds = $module->chapters->pluck('id');

        $passedCount = ChapterResult::where('user_id', $user->id)
            ->whereIn('chapter_id', $chapterIds)
            ->where('passed', true)
            ->count();

        $allPassed = $passedCount == $chapterIds->count();

        if ($allPassed) {

            $avgScore = round(
                ChapterResult::where('user_id', $user->id)
                    ->whereIn('chapter_id', $chapterIds)
                    ->avg('score')
            );

            return redirect()->route('modules.result', [
                'id' => $module->id,
                'avg' => $avgScore
            ]);
        }

        return $chapterFinishRedirect;
    }

    /*
    |--------------------------------------------------------------------------
    | HASIL MODUL
    |--------------------------------------------------------------------------
    */
    public function result($id)
    {
        $module = Module::with('chapters')->findOrFail($id);

        return view('dashboard.modul_result', [
            'module' => $module,
            'score'  => request()->avg,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE CERTIFICATE PDF (STREAM)
    |--------------------------------------------------------------------------
    */
    public function certificate($id)
    {
        $module = Module::with('chapters')->findOrFail($id);
        $user = Auth::user();

        $chapterIds = $module->chapters->pluck('id')->toArray();

        $passedAll = ChapterResult::whereIn('chapter_id', $chapterIds)
            ->where('user_id', $user->id)
            ->where('passed', true)
            ->count() == count($chapterIds);

        if (!$passedAll) {
            return back()->with('error', 'Beberapa chapter belum lulus.');
        }

        $avgScore = round(
            ChapterResult::whereIn('chapter_id', $chapterIds)
                ->where('user_id', $user->id)
                ->avg('score')
        );

        $pdf = Pdf::loadView('dashboard.certificate_pdf', [
            'user'   => $user,
            'module' => $module,
            'score'  => $avgScore,
            'date'   => now()->format('d F Y'),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream("Sertifikat_{$module->id}.pdf");
    }

    /*
    |--------------------------------------------------------------------------
    | COMMENT: TAMBAH KOMENTAR
    |--------------------------------------------------------------------------
    */
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        ModuleComment::create([
            'module_id' => $id,
            'user_id'   => Auth::id(),
            'comment'   => $request->comment,
        ]);

        return back()->with('success', 'Komentar ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | COMMENT: HAPUS KOMENTAR
    |--------------------------------------------------------------------------
    */
    public function deleteComment($id)
    {
        $comment = ModuleComment::findOrFail($id);

        if ($comment->user_id !== Auth::id() && Auth::user()->role !== 'guru') {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | MURID: HALAMAN CHAPTER SELESAI
    |--------------------------------------------------------------------------
    */
    public function chapterFinish($chapter)

    {
        $chapter = Chapter::with('module')->findOrFail($chapter);

        return view('dashboard.chapter_finish', [
            'chapter' => $chapter,
            'module'  => $chapter->module,
        ]);
    }
}

