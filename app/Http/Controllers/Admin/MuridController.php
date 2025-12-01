<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MuridController extends Controller
{
    public function index()
    {
        $murids = User::where('role', 'murid')->paginate(10);
        return view('admin.murid.index', compact('murids'));
    }

    public function create()
    {
        return view('admin.murid.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'murid',
        ]);

        return redirect()->route('admin.murid.index')
            ->with('success', 'Murid baru berhasil ditambahkan!');
    }

    public function edit(User $murid)
    {
        if ($murid->role !== 'murid') abort(403);
        return view('admin.murid.edit', compact('murid'));
    }

    public function update(Request $request, User $murid)
    {
        if ($murid->role !== 'murid') abort(403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'max:255', 'unique:users,email,' . $murid->id],
        ]);

        $murid->update($validated);

        return redirect()->route('admin.murid.edit', $murid->id)
            ->with('success', 'Profil murid berhasil diperbarui!');
    }

    public function updatePassword(Request $request, User $murid)
    {
        if ($murid->role !== 'murid') abort(403);

        $validated = $request->validate([
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $murid->password = Hash::make($validated['new_password']);
        $murid->save();

        return redirect()->route('admin.murid.edit', $murid->id)
            ->with('success_password', 'Password murid berhasil diubah!');
    }

    public function destroy(User $murid)
    {
        if ($murid->role !== 'murid') abort(403);
        $murid->delete();

        return redirect()->route('admin.murid.index')
            ->with('success', 'Murid berhasil dihapus!');
    }
}
