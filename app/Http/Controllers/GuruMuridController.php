<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ChapterResult;
use App\Models\Module;
use Illuminate\Http\Request;

class GuruMuridController extends Controller
{
    public function index()
    {
        // Ambil semua murid
        $students = User::where('role', 'murid')->get();

        // Hitung XP tiap murid
        foreach ($students as $s) {
            $s->xp = \App\Models\ChapterResult::where('user_id', $s->id)->sum('score');
        }

        // Urutkan dan buat ranking index
        $students = $students->sortByDesc('xp')->values();

        // Tambahkan ranking (1, 2, 3, dst)
        foreach ($students as $i => $s) {
            $s->rank = $i + 1;
        }

        return view('guru.murid.index', compact('students'));
    }

}
