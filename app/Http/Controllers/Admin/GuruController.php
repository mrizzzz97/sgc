<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = User::where('role', 'guru')->paginate(10);
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $guru = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'guru',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan: ' . $guru->name);
    }

    public function edit(User $guru)
    {
        if ($guru->role !== 'guru') abort(403);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, User $guru)
    {
        if ($guru->role !== 'guru') abort(403);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'max:255', 'unique:users,email,' . $guru->id],
        ]);

        $guru->update($validated);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Profil guru berhasil diperbarui!');
    }

    public function updatePassword(Request $request, User $guru)
    {
        if ($guru->role !== 'guru') abort(403);

        $validated = $request->validate([
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $guru->password = Hash::make($validated['new_password']);
        $guru->save();

        return redirect()->route('admin.guru.edit', $guru->id)
            ->with('success_password', 'Password guru berhasil diubah!');
    }

    public function destroy(User $guru)
    {
        if ($guru->role !== 'guru') abort(403);

        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil dihapus!');
    }
}
