<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    // Murid: Daftar modul dengan memilih guru
    public function store(Request $request, Module $module)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:users,id',
        ]);

        $enrollment = Enrollment::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'module_id' => $module->id,
            ],
            [
                'teacher_id' => $validated['teacher_id'],
                'status' => 'active',
            ]
        );

        return redirect()->route('modules.show', $module)->with('success', 'Berhasil mendaftar modul!');
    }

    // Guru: List murid yang enrolled di modul tertentu
    public function moduleStudents(Module $module)
    {
        $enrollments = Enrollment::where('module_id', $module->id)
            ->where('teacher_id', Auth::id())
            ->with('user')
            ->paginate(15);

        return view('enrollments.students', compact('module', 'enrollments'));
    }

    // Guru: Lihat detail siswa & progress
    public function studentDetail(Module $module, Enrollment $enrollment)
    {
        // Verify that this enrollment belongs to this module and the teacher is the current user
        if ($enrollment->module_id !== $module->id || $enrollment->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $enrollment->load('user.answers.question');
        $chapters = $module->chapters;
        
        return view('enrollments.student-detail', compact('module', 'enrollment', 'chapters'));
    }
}
