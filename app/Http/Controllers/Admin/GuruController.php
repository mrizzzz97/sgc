<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class GuruController extends Controller
{
    /**
     * Display a listing of all guru
     */
    public function index()
    {
        $gurus = User::where('role', 'guru')->paginate(10);
        return view('admin.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new guru
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Store a newly created guru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $guru = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'guru',
            'email_verified_at' => now(), // langsung verified
        ]);

        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil ditambahkan: ' . $guru->name);
    }

    /**
     * Show the form for editing the specified guru
     */
    public function edit(User $guru)
    {
        if ($guru->role !== 'guru') {
            abort(403);
        }
        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * Update the specified guru
     */
    public function update(Request $request, User $guru)
    {
        if ($guru->role !== 'guru') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $guru->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $guru->name = $validated['name'];
        $guru->email = $validated['email'];

        if (!empty($validated['password'])) {
            $guru->password = Hash::make($validated['password']);
        }

        $guru->save();

        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil diperbarui: ' . $guru->name);
    }

    /**
     * Remove the specified guru
     */
    public function destroy(User $guru)
    {
        if ($guru->role !== 'guru') {
            abort(403);
        }

        $name = $guru->name;
        $guru->delete();

        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil dihapus: ' . $name);
    }
}
