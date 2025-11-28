@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<div class="max-w-4xl mx-auto p-4 md:p-6 animate-fade-in">

    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2 dark:text-white bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
             Selamat datang, {{ Auth::user()->name }}
        </h1>
        <p class="text-gray-600 dark:text-gray-400">Kelola dan pantau aktivitas pembelajaran Anda</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
            <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book text-blue-600 dark:text-blue-400 text-xl"></i>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total</span>
                </div>
                <h3 class="font-bold text-lg dark:text-white mb-2">Total Modul</h3>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    {{ DB::table('modules')->count() }}
                </p>
                <div class="mt-4 h-1 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full" style="width: 65%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
            <div class="h-2 bg-gradient-to-r from-purple-500 to-purple-600"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-layer-group text-purple-600 dark:text-purple-400 text-xl"></i>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total</span>
                </div>
                <h3 class="font-bold text-lg dark:text-white mb-2">Total Chapter</h3>
                <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                    {{ DB::table('chapters')->count() }}
                </p>
                <div class="mt-4 h-1 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-500 rounded-full" style="width: 45%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
            <div class="h-2 bg-gradient-to-r from-green-500 to-green-600"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-green-600 dark:text-green-400 text-xl"></i>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total</span>
                </div>
                <h3 class="font-bold text-lg dark:text-white mb-2">Murid Binaan</h3>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                    0
                </p>
                <div class="mt-4 h-1 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold dark:text-white mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('guru.modul.create') }}" class="flex items-center gap-3 p-4 bg-indigo-50 dark:bg-indigo-900/20 hover:bg-indigo-100 dark:hover:bg-indigo-900/30 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <p class="font-semibold dark:text-white">Tambah Modul</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Buat materi baru</p>
                </div>
            </a>
            
            <a href="{{ route('guru.modul.index') }}" class="flex items-center gap-3 p-4 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center text-white">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <p class="font-semibold dark:text-white">Kelola Modul</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Lihat semua modul</p>
                </div>
            </a>
            
            <a href="{{ route('guru.profile') }}" class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center text-white">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div>
                    <p class="font-semibold dark:text-white">Profil</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Pengaturan akun</p>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection