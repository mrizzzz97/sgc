<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    // Murid: Lihat sertifikat
    public function show(Certificate $certificate)
    {
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        $certificate->load('module');
        $module = $certificate->module;
        return view('certificates.show', compact('certificate', 'module'));
    }

    // Murid: Generate sertifikat setelah selesai modul
    public function generate(Request $request, Module $module)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('module_id', $module->id)
            ->firstOrFail();

        $certificate = Certificate::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'module_id' => $module->id,
            ],
            [
                'certificate_number' => 'CERT-' . now()->format('YmdHis') . '-' . Auth::id(),
                'full_name' => $validated['full_name'],
                'completed_at' => now(),
            ]
        );

        return view('certificates.download', compact('certificate', 'module'));
    }

    // Download sertifikat (bisa jadi PDF atau HTML)
    public function download(Certificate $certificate)
    {
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        $certificate->load('module');
        return view('certificates.pdf', compact('certificate'));
    }
}
