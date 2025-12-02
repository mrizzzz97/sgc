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

        // =====================================================================
        // 1. HITUNG MODUL SELESAI (REAL)
        // =====================================================================
        $modules = Module::with('chapters')->get();

        $modul_selesai = 0;
        $modules_progress = [];

        foreach ($modules as $modul) {

            $total_chapters = $modul->chapters->count();

            $completed_chapters = ChapterCompletion::where('user_id', $user->id)
                ->whereIn('chapter_id', $modul->chapters->pluck('id'))
                ->count();

            if ($total_chapters > 0 && $completed_chapters == $total_chapters) {
                $modul_selesai++;
            }

            $percent = $total_chapters > 0
                ? round(($completed_chapters / $total_chapters) * 100)
                : 0;

            $modules_progress[] = [
                'id' => $modul->id,
                'title' => $modul->title,
                'completed' => $completed_chapters,
                'total_chapters' => $total_chapters,
                'percent' => $percent,
            ];
        }

        // =====================================================================
        // 2. HITUNG XP & LEVEL
        // =====================================================================
        $xp_per_modul = 100;
        $xp_total = $modul_selesai * $xp_per_modul;

        // Naik level setiap 500 XP
        $level = 1 + floor($xp_total / 500);

        // Progress menuju level berikutnya
        $xp_for_next = $level * 500;
        $xp_progress = min(100, round(($xp_total / $xp_for_next) * 100));

        // Ranking (placeholder)
        $rank = '-';

        // =====================================================================
        // 3. TUGAS PENDING
        // =====================================================================
        $tugas_pending = Question::leftJoin('answers', function ($join) use ($user) {
                $join->on('questions.id', '=', 'answers.question_id')
                     ->where('answers.user_id', $user->id);
            })
            ->whereNull('answers.id')
            ->count();

        // =====================================================================
        // 4. TUGAS TERBARU
        // =====================================================================
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

        // =====================================================================
        // 5. BADGES (placeholder)
        // =====================================================================
        $badges = [];

        // =====================================================================
        // 6. KIRIM DATA KE VIEW
        // =====================================================================
        return view('dashboard.murid', [
            'user' => $user,

            // Modul & progress
            'modul_selesai' => $modul_selesai,
            'modules_progress' => $modules_progress,

            // XP dan level
            'xp_total' => $xp_total,
            'level' => $level,
            'xp_for_next' => $xp_for_next,
            'xp_progress' => $xp_progress,
            'rank' => $rank,

            // Tugas
            'tugas_pending' => $tugas_pending,
            'latest_tasks' => $latest_tasks,

            // Badges
            'badges' => $badges,
        ]);
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
