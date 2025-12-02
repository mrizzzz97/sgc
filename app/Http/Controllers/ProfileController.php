<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Halaman profil untuk murid/admin/guru.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Halaman profil khusus guru (separated view).
     */
    public function editGuruProfile(Request $request)
    {
        return view('guru.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update nama & email.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password'     => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama salah.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Hapus akun.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'delete_password' => ['required'],
        ]);

        $user = $request->user();

        if (!Hash::check($request->delete_password, $user->password)) {
            return back()->withErrors([
                'delete_password' => 'Password salah.',
            ]);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
