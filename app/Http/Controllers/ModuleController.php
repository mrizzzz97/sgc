<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Chapter;
use App\Models\ChapterCompletion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GURU: TAMPILKAN SEMUA MODUL
    |--------------------------------------------------------------------------
    */
    public function guruIndex()
    {
        $modules = Module::orderBy('order')->get();
        return view('guru.modul.index', compact('modules'));
    }

    /*
    |--------------------------------------------------------------------------
    | GURU: FORM TAMBAH MODUL
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('guru.modul.create');
    }

    /*
    |--------------------------------------------------------------------------
    | GURU: SIMPAN MODUL BARU
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
    | GURU: FORM EDIT MODUL
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
    | GURU: HAPUS MODUL
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
    | =========================
    |  M U R I D  S E C T I O N
    | =========================
    |--------------------------------------------------------------------------
    */

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
    | MURID: TAMPILKAN 1 MODUL + LIST CHAPTER
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $module = Module::with('chapters')->findOrFail($id);
        $user   = Auth::user();

        // Tandai chapter selesai?
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
    | MURID: TAMPILKAN ISI CHAPTER
    |--------------------------------------------------------------------------
    */
    public function chapter($id)
    {
        $chapter = Chapter::with('pages')->findOrFail($id);
        return view('dashboard.chapter_show', compact('chapter'));
    }

    /*
    |--------------------------------------------------------------------------
    | MURID: COMPLETE CHAPTER
    |--------------------------------------------------------------------------
    */
    public function complete($id)
    {
        $chapter = Chapter::findOrFail($id);
        $user    = Auth::user();

        ChapterCompletion::firstOrCreate([
            'user_id' => $user->id,
            'chapter_id' => $chapter->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Chapter berhasil ditandai selesai!'
        ]);
    }
}
