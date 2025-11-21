<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Admin Default
        User::create([
            'name' => 'Admin',
            'email' => 'admin@sgc.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Buat Test Siswa
        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@sgc.com',
            'password' => Hash::make('password'),
            'role' => 'murid',
            'email_verified_at' => now(),
        ]);

        // Buat Test Guru
        User::create([
            'name' => 'Guru Test',
            'email' => 'guru@sgc.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'email_verified_at' => now(),
        ]);
    }
}
