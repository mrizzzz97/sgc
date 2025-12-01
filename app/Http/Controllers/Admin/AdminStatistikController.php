<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Module;
use App\Models\Chapter;

class AdminStatistikController extends Controller
{
    public function index()
    {
        $totalGuru   = User::where('role', 'guru')->count();
        $totalMurid  = User::where('role', 'murid')->count();
        $totalModul  = Module::count();
        $totalChapter = Chapter::count();

        return view('admin.statistik.index', compact(
            'totalGuru',
            'totalMurid',
            'totalModul',
            'totalChapter'
        ));
    }
}
