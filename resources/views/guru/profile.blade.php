@extends('layouts.guru')

@section('title', 'Profil Guru')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- CARD PROFIL -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8">

        <!-- Header -->
        <div class="flex items-center gap-5 mb-6">

            <!-- Foto / Initial -->
            <div class="w-20 h-20 rounded-full bg-indigo-600 shadow flex items-center justify-center 
                        text-white text-3xl font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ Auth::user()->name }}
                </h1>

                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    Guru — Sistem Belajar SGC
                </p>
            </div>

        </div>

        <hr class="border-gray-300 dark:border-gray-700 my-6">

        <!-- Informasi Akun -->
        <div class="space-y-4">

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    {{ Auth::user()->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Role</p>
                <p class="text-lg font-semibold text-indigo-600 dark:text-indigo-300">
                    Guru
                </p>
            </div>

        </div>

        <hr class="border-gray-300 dark:border-gray-700 my-6">

        <!-- Tombol Aksi -->
        <div class="flex flex-wrap gap-4">

            <a href="{{ route('guru.profile.edit') }}"
               class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 
                      text-white font-semibold transition">
                Edit Profil
            </a>

        </div>

    </div>

</div>

@endsection
