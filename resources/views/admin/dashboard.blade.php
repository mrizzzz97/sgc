@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- HEADER -->
    <div class="mb-10 animate-fade-in">
        <h1 class="text-4xl font-extrabold text-transparent bg-clip-text 
            bg-gradient-to-r from-indigo-500 to-purple-600 
            dark:from-indigo-300 dark:to-purple-400">
            Dashboard Admin
        </h1>

        <p class="mt-2 text-gray-500 dark:text-gray-400">
            Kelola sistem dengan cepat dan mudah.
        </p>
    </div>

    <!-- GRID CARD -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- CARD GURU --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg 
            border border-gray-200 dark:border-gray-700
            transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl
            animate-slide-up" style="animation-delay:0.1s">

            <div class="flex items-center mb-4">
                <div class="p-3 rounded-lg bg-indigo-100 dark:bg-indigo-900 mr-4">
                    <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Kelola Guru
                </h2>
            </div>

            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Tambah, edit, dan hapus data guru.
            </p>

            <div class="flex gap-3">
                <a href="{{ route('admin.guru.index') }}"
                    class="flex-1 text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 
                    text-white rounded-lg flex items-center justify-center transition">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lihat
                </a>

                <a href="{{ route('admin.guru.create') }}"
                    class="flex-1 text-center px-4 py-2 bg-green-600 hover:bg-green-700 
                    text-white rounded-lg flex items-center justify-center transition">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah
                </a>
            </div>
        </div>

        {{-- CARD MURID --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg 
            border border-gray-200 dark:border-gray-700
            transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl
            animate-slide-up" style="animation-delay:0.2s">

            <div class="flex items-center mb-4">
                <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900 mr-4">
                    <svg class="h-8 w-8 text-green-600 dark:text-green-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z" />
                    </svg>
                </div>

                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Kelola Murid
                </h2>
            </div>

            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Tambah, edit, dan hapus akun murid.
            </p>

            <div class="flex gap-3">
                <a href="{{ route('admin.murid.index') }}"
                    class="flex-1 text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 
                    text-white rounded-lg flex items-center justify-center transition">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lihat
                </a>

                <a href="{{ route('admin.murid.create') }}"
                    class="flex-1 text-center px-4 py-2 bg-green-600 hover:bg-green-700 
                    text-white rounded-lg flex items-center justify-center transition">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah
                </a>
            </div>
        </div>

        {{-- CARD STATISTIK --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg 
            border border-gray-200 dark:border-gray-700
            transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl
            animate-slide-up" style="animation-delay:0.3s">

            <div class="flex items-center mb-4">
                <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900 mr-4">
                    <svg class="h-8 w-8 text-purple-600 dark:text-purple-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5m6 8h4a2 2 0 002-2V5a2 2 0 00-2-2h-6" />
                    </svg>
                </div>

                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Statistik Sistem
                </h2>
            </div>

            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Pantau data pengguna dan modul.
            </p>

            <a href="{{ route('admin.statistik') }}"
                class="w-full text-center px-4 py-2 bg-purple-600 hover:bg-purple-700 
                text-white rounded-lg flex items-center justify-center transition">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5m6 8h4a2 2 0 002-2V5a2 2 0 00-2-2h-6" />
                </svg>
                Lihat Statistik
            </a>

        </div>

    </div>
</div>

<style>
@keyframes fade-in { from {opacity:0; transform:translateY(-10px);} to {opacity:1; transform:translateY(0);} }
@keyframes slide-up { from {opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }

.animate-fade-in { animation: fade-in 0.5s ease-out; }
.animate-slide-up { animation: slide-up 0.5s ease-out; animation-fill-mode: both; }
</style>

@endsection
