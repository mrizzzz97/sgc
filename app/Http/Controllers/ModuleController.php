<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Enrollment;
use App\Models\Certificate;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    // Murid: Lihat semua modul yang tersedia
    public function index()
    {
        $modules = Module::orderBy('order')->get();
        $userEnrollments = Auth::check() ? Enrollment::where('user_id', Auth::id())->pluck('module_id')->toArray() : [];
        
        return view('modules.index', compact('modules', 'userEnrollments'));
    }

    // Murid: Lihat detail modul
    public function show(Module $module)
    {
        $module->load('chapters.questions', 'chapters.comments');
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('module_id', $module->id)
            ->first();

        if (!$enrollment) {
            abort(403, 'Anda belum mendaftar modul ini');
        }

        return view('modules.show', compact('module', 'enrollment'));
    }

    // Guru: Lihat modul untuk assign
    public function teach()
    {
        // Load modules with chapter counts and enrollments count for the current teacher
        $modules = Module::with('chapters')
            ->withCount(['enrollments as enrollments_count' => function ($query) {
                $query->where('teacher_id', Auth::id());
            }])
            ->orderBy('order')
            ->paginate(10);

        // Recent enrollments for this teacher (show latest 6)
        $recentEnrollments = Enrollment::where('teacher_id', Auth::id())
            ->with('user', 'module')
            ->latest()
            ->take(6)
            ->get();

        // Modules managed by this teacher (based on enrollments)
        $managedModuleIds = Module::whereHas('enrollments', function ($q) {
            $q->where('teacher_id', Auth::id());
        })->pluck('id');

        $totalManagedModules = $managedModuleIds->count();
        $totalStudents = Enrollment::where('teacher_id', Auth::id())->distinct('user_id')->count('user_id');
        $totalCertificates = Certificate::whereIn('module_id', $managedModuleIds)->count();

        // Top students by total XP (within this teacher's students)
        $studentIds = Enrollment::where('teacher_id', Auth::id())->pluck('user_id')->unique()->toArray();
        $topStudents = User::whereIn('id', $studentIds)
            ->withSum('dailyXps', 'points')
            ->orderByDesc('daily_xps_sum_points')
            ->take(5)
            ->get();

        // Recent answers from this teacher's students
        $recentAnswers = Answer::whereIn('user_id', $studentIds)
            ->with('user', 'question')
            ->latest()
            ->take(6)
            ->get();

        return view('modules.teach', compact('modules', 'recentEnrollments', 'totalManagedModules', 'totalStudents', 'totalCertificates', 'topStudents', 'recentAnswers'));
    }

    // Guru: Form create modul
    public function create()
    {
        return view('modules.create');
    }

    // Guru: Save modul baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'order' => 'required|integer|min:1',
        ]);

        Module::create($validated);
        return redirect()->route('modules.teach')->with('success', 'Modul berhasil ditambahkan');
    }

    // Guru: Form edit modul
    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    // Guru: Update modul
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'order' => 'required|integer|min:1',
        ]);

        $module->update($validated);
        return redirect()->route('modules.teach')->with('success', 'Modul berhasil diubah');
    }

    // Guru: Delete modul
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.teach')->with('success', 'Modul berhasil dihapus');
    }
}
