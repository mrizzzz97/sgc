<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\Chapter;
use App\Models\ChapterCompletion;
use App\Models\Answer;
use App\Models\Question;

class MuridDashboardController extends Controller
{
    /**
     * Dashboard utama murid
     */
    public function index()
    {
        $user = Auth::user();

        // ===============================
        // 1. MODUL SELESAI
        // ===============================
        $modul_selesai = ChapterCompletion::where('user_id', $user->id)->count();

        // ===============================
        // 2. TUGAS PENDING
        // ===============================
        $tugas_pending = Question::leftJoin('answers', function ($join) use ($user) {
                $join->on('questions.id', '=', 'answers.question_id')
                     ->where('answers.user_id', $user->id);
            })
            ->whereNull('answers.id')
            ->count();

        // ===============================
        // 3. XP & LEVEL (sementara dummy)
        // ===============================
        $xp_total = 0;
        $level = 1;
        $xp_progress = 0;
        $rank = 1;

        // ===============================
        // 4. PROGRESS SETIAP MODUL
        // ===============================
        $modules_progress = [];
        $modules = Module::with('chapters')->get();

        foreach ($modules as $m) {
            $chapterIds = $m->chapters->pluck('id');
            $total_chapters = $chapterIds->count();

            $completed = ChapterCompletion::where('user_id', $user->id)
                ->whereIn('chapter_id', $chapterIds)
                ->count();

            $percent = $total_chapters > 0
                ? round(($completed / $total_chapters) * 100)
                : 0;

            $modules_progress[] = [
                'title' => $m->title,
                'completed' => $completed,
                'total_chapters' => $total_chapters,
                'percent' => $percent,
            ];
        }

        // ===============================
        // 5. TUGAS TERBARU
        // ===============================
        $latest_tasks = Question::leftJoin('chapters', 'questions.chapter_id', '=', 'chapters.id')
            ->leftJoin('modules', 'chapters.module_id', '=', 'modules.id')
            ->leftJoin('answers', function ($join) use ($user) {
                $join->on('questions.id', '=', 'answers.question_id')
                     ->where('answers.user_id', $user->id);
            })
            ->select(
                'questions.*',
                'modules.title as module_title',
                'chapters.title as chapter_title',
                'answers.id as answer_id',
                'questions.created_at as posted_at'
            )
            ->orderBy('questions.created_at', 'DESC')
            ->limit(5)
            ->get();

        // ===============================
        // 6. BADGES (placeholder aman)
        // ===============================
        $badges = [];

        // ===============================
        // 7. KIRIM KE VIEW
        // ===============================
        return view('dashboard.murid', [
            'user' => $user,
            'modul_selesai' => $modul_selesai,
            'tugas_pending' => $tugas_pending,
            'rank' => $rank,
            'xp_total' => $xp_total,
            'level' => $level,
            'xp_progress' => $xp_progress,
            'modules_progress' => $modules_progress,
            'latest_tasks' => $latest_tasks,
            'badges' => $badges,
        ]);
    }

    /**
     * Halaman daftar tugas murid
     */
    public function tugas()
    {
        $user = Auth::user();

        // Tugas belum dikerjakan
        $pending = Question::leftJoin('answers', function ($join) use ($user) {
                $join->on('questions.id', '=', 'answers.question_id')
                     ->where('answers.user_id', $user->id);
            })
            ->whereNull('answers.id')
            ->select('questions.*')
            ->get();

        // Tugas sudah dikerjakan
        $done = Answer::where('answers.user_id', $user->id)
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->select('questions.*', 'answers.created_at as answered_at')
            ->get();

        return view('dashboard.tugas', compact('pending', 'done'));
    }

    /**
     * Halaman list modul untuk murid
     */
    public function modul()
    {
        $modules = Module::all();
        return view('dashboard.modul', compact('modules'));
    }
}
