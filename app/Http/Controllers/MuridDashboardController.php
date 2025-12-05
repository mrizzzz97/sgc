<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\Chapter;
use App\Models\ChapterCompletion;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;

class MuridDashboardController extends Controller
{
    /**
     * DASHBOARD UTAMA
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ================================================================
        // 1. HITUNG PROGRESS MODUL
        // ================================================================
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

        // ================================================================
        // 2. XP & LEVEL SYSTEM
        // ================================================================
        $xp_per_modul = 100;
        $xp_total = $modul_selesai * $xp_per_modul;

        $level = 1 + floor($xp_total / 500);
        $xp_for_next = $level * 500;
        $xp_progress = min(100, round(($xp_total / $xp_for_next) * 100));

        // Simpan
        $user->xp_total = $xp_total;
        $user->level = $level;
        $user->save();

        // ================================================================
        // 3. GLOBAL RANKING BERDASARKAN XP
        // ================================================================
        $ranking = User::where('role', 'murid')
            ->orderBy('xp_total', 'desc')
            ->pluck('id')
            ->toArray();

        $rankPosition = array_search($user->id, $ranking);
        $rankPosition = $rankPosition !== false ? $rankPosition + 1 : '-';

        // ================================================================
        // 4. TUGAS PENDING
        // ================================================================
        $tugas_pending = Question::leftJoin('answers', function ($join) use ($user) {
                $join->on('questions.id', '=', 'answers.question_id')
                    ->where('answers.user_id', $user->id);
            })
            ->whereNull('answers.id')
            ->count();

        // ================================================================
        // 5. TUGAS TERBARU
        // ================================================================
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

        // ================================================================
        // 6. BADGES (opsional)
        // ================================================================
        $badges = [];

        // ================================================================
        // 7. RETURN VIEW
        // ================================================================
        return view('dashboard.murid', [
            'user' => $user,

            'modul_selesai'      => $modul_selesai,
            'modules_progress'   => $modules_progress,

            'xp_total'     => $xp_total,
            'level'        => $level,
            'xp_for_next'  => $xp_for_next,
            'xp_progress'  => $xp_progress,

            'rank'         => $rankPosition,

            'tugas_pending' => $tugas_pending,
            'latest_tasks'  => $latest_tasks,
            'badges'        => $badges,
        ]);
    }

    /**
     * PAGE LIST MODUL
     */
    public function modul()
    {
        $modules = Module::all();
        return view('dashboard.modul', compact('modules'));
    }

    /**
     * LEADERBOARD GLOBAL BERDASARKAN XP
     */
    public function leaderboard()
    {
        $user = Auth::user();

        $leaderboard = User::where('role', 'murid')
            ->orderBy('xp_total', 'desc')
            ->get();

        $rank = $leaderboard->search(fn($u) => $u->id === $user->id);
        $rank = $rank !== false ? $rank + 1 : '-';

        return view('murid.leaderboard', [
            'leaderboard' => $leaderboard,
            'userRank' => $rank,
            'user' => $user
        ]);
    }

}
