@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')

{{-- ========================== --}}
{{-- NOTIFIKASI GLOBAL SUCCESS --}}
{{-- ========================== --}}
@if (session('success'))
    <div 
        class="mb-6 flex items-center gap-3 px-5 py-4 rounded-xl bg-green-500/15 border border-green-600/30 text-green-700 dark:text-green-300 dark:bg-green-900/30 backdrop-blur-md shadow-lg animate-fade-in"
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3500)">
        <i class="fas fa-check-circle text-xl"></i>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

{{-- ========================== --}}
{{-- NOTIFIKASI GLOBAL ERROR --}}
{{-- ========================== --}}
@if (session('error'))
    <div 
        class="mb-6 flex items-center gap-3 px-5 py-4 rounded-xl bg-red-500/15 border border-red-600/30 text-red-700 dark:text-red-300 dark:bg-red-900/30 backdrop-blur-md shadow-lg animate-fade-in"
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3500)">
        <i class="fas fa-exclamation-circle text-xl"></i>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
@endif




{{-- ================================ --}}
{{-- 🔔 NOTIFIKASI DROPDOWN FIX 100% --}}
{{-- ================================ --}}
@php
$notifData = \App\Models\ModuleNotification::where('to_user_id', auth()->id())
    ->latest()
    ->take(10)
    ->get();

$notifCount = \App\Models\ModuleNotification::where('to_user_id', auth()->id())
    ->where('read', false)
    ->count();
@endphp

<div class="flex justify-end mb-6 relative" x-data="{ open:false }">

    {{-- TOMBOL NOTIF --}}
    <button 
        @click="open = !open"
        class="relative w-11 h-11 flex items-center justify-center rounded-full
               bg-gray-700/40 dark:bg-gray-700 hover:bg-gray-600/60 shadow-md transition-all">

        <i class="fas fa-bell text-yellow-400 text-lg"></i>

        @if($notifCount > 0)
        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold
                     w-5 h-5 rounded-full flex items-center justify-center shadow">
            {{ $notifCount }}
        </span>
        @endif
    </button>


    {{-- DROPDOWN NOTIF --}}
    <div 
        x-show="open"
        @click.outside="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute top-14 right-0 w-80 bg-white dark:bg-gray-800 
               border border-gray-300 dark:border-gray-700 
               shadow-xl rounded-xl z-50">

        {{-- HEADER --}}
        <div class="px-4 py-3 border-b dark:border-gray-700">
            <p class="font-semibold dark:text-white">Notifikasi</p>
        </div>

        {{-- LIST NOTIF --}}
        <div class="max-h-60 overflow-y-auto">

            @forelse($notifData as $n)
            <div class="px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                <p class="text-sm font-medium dark:text-gray-200">
                    {{ $n->message }}
                </p>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $n->created_at->diffForHumans() }}
                </span>
            </div>
            @empty
            <div class="px-4 py-4 text-center text-gray-500 dark:text-gray-400 text-sm">
                Tidak ada notifikasi.
            </div>
            @endforelse

        </div>

        {{-- FOOTER --}}
        <div class="px-4 py-2 bg-gray-50 dark:bg-gray-700 text-center rounded-b-xl">
            <a href="{{ route('guru.notif') }}" 
               class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold hover:underline">
                Lihat semua
            </a>
        </div>

    </div>

</div>





{{-- ================================ --}}
{{-- HEADER DASHBOARD --}}
{{-- ================================ --}}
<div class="max-w-5xl mx-auto p-4 md:p-6 animate-fade-in">

    <div class="mb-10">
        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-indigo-500 to-purple-500 text-transparent bg-clip-text">
            Selamat datang, {{ Auth::user()->name }}
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Pantau dan kelola semua aktivitas pembelajaran secara mudah.
        </p>
    </div>


    {{-- ================================ --}}
    {{-- INFO CARDS --}}
    {{-- ================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        @php
            $cards = [
                ['title'=>'Total Modul','count'=>DB::table("modules")->count(),'icon'=>'fa-book','color'=>'blue'],
                ['title'=>'Total Chapter','count'=>DB::table("chapters")->count(),'icon'=>'fa-layer-group','color'=>'purple'],
                ['title'=>'Murid Binaan','count'=>0,'icon'=>'fa-users','color'=>'green'],
            ];
        @endphp

        @foreach ($cards as $c)

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl hover:shadow-2xl 
                    transform hover:-translate-y-1 transition-all duration-300 
                    overflow-hidden group border border-gray-100 dark:border-gray-700">

            <div class="h-2 bg-gradient-to-r from-{{ $c['color'] }}-500 to-{{ $c['color'] }}-600"></div>

            <div class="p-6">

                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center 
                                bg-{{ $c['color'] }}-100 dark:bg-{{ $c['color'] }}-900/30 
                                group-hover:scale-110 transition-transform duration-300">
                        <i class="fas {{ $c['icon'] }} text-{{ $c['color'] }}-600 
                                   dark:text-{{ $c['color'] }}-400 text-xl"></i>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total</span>
                </div>

                <h3 class="font-semibold text-lg dark:text-white mb-1">{{ $c['title'] }}</h3>

                <p class="text-4xl font-extrabold text-{{ $c['color'] }}-600 dark:text-{{ $c['color'] }}-400">
                    {{ $c['count'] }}
                </p>

                <div class="mt-4 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-{{ $c['color'] }}-500 rounded-full"
                         style="width: {{ $c['count'] == 0 ? 10 : 60 }}%">
                    </div>
                </div>

            </div>
        </div>

        @endforeach

    </div>


    {{-- ================================ --}}
    {{-- QUICK ACTIONS --}}
    {{-- ================================ --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border dark:border-gray-700">
        <h2 class="text-xl font-bold dark:text-white mb-5">Aksi Cepat</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            {{-- ADD MODULE --}}
            <a href="{{ route('guru.modul.create') }}"
               class="group flex items-center gap-4 p-5 rounded-xl bg-indigo-50 dark:bg-indigo-900/20 
                      hover:bg-indigo-100 dark:hover:bg-indigo-900/40 border border-indigo-200/40 
                      dark:border-indigo-800/40 transition-all">
                <div class="w-12 h-12 rounded-xl bg-indigo-600 flex items-center justify-center 
                            text-white shadow-md group-hover:scale-110 transition">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <p class="font-semibold dark:text-white">Tambah Modul</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Buat materi baru</p>
                </div>
            </a>

            {{-- MANAGE MODULE --}}
            <a href="{{ route('guru.modul.index') }}"
               class="group flex items-center gap-4 p-5 rounded-xl bg-purple-50 dark:bg-purple-900/20 
                      hover:bg-purple-100 dark:hover:bg-purple-900/40 border border-purple-200/40 
                      dark:border-purple-800/40 transition-all">
                <div class="w-12 h-12 rounded-xl bg-purple-600 flex items-center justify-center 
                            text-white shadow-md group-hover:scale-110 transition">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <p class="font-semibold dark:text-white">Kelola Modul</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Lihat semua modul</p>
                </div>
            </a>

            {{-- PROFILE --}}
            <a href="{{ route('guru.profile.edit') }}"
               class="group flex items-center gap-4 p-5 rounded-xl bg-green-50 dark:bg-green-900/20 
                      hover:bg-green-100 dark:hover:bg-green-900/40 border border-green-200/40 
                      dark:border-green-800/40 transition-all">
                <div class="w-12 h-12 rounded-xl bg-green-600 flex items-center justify-center 
                            text-white shadow-md group-hover:scale-110 transition">
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

<script src="//unpkg.com/alpinejs" defer></script>


@endsection
