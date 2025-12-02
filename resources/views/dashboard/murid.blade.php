@extends('layouts.dashboard')

@section('title', 'Dashboard Murid')

@section('content')
@php
    $modul_selesai = $modul_selesai ?? 0;
    $rank = $rank ?? '-';
    $xp_total = $xp_total ?? 0;
    $level = $level ?? 1;
    $xp_progress = $xp_progress ?? 0;
@endphp

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold dark:text-white">Progress Belajar Kamu 🎓</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Lihat perkembangan belajar kamu.</p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-500">Member</p>
                    <p class="font-semibold dark:text-white">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">Joined {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Stats -->
    <div class="grid lg:grid-cols-3 gap-6 mb-6">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
            <p class="text-sm text-gray-500">Modul Selesai</p>
            <p class="text-3xl font-extrabold text-indigo-600 mt-3">{{ $modul_selesai }}</p>
        </div>

        <!-- Tugas Pending DIHAPUS -->

        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
            <p class="text-sm text-gray-500">Rank Kelas</p>
            <p class="text-3xl font-extrabold text-green-400 mt-3">Top {{ $rank }}</p>
        </div>
    </div>

    <!-- XP -->
    <div data-aos="fade-up" class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold dark:text-white">Level & XP</h3>
                <p class="text-sm text-gray-500 dark:text-gray-300">Level {{ $level }} — {{ $xp_total }} XP</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Next: {{ $xp_for_next ?? ($level * 100) }} XP</p>
            </div>
        </div>

        <div class="mt-4">
            <div class="w-full bg-gray-200 dark:bg-gray-700 h-3 rounded-full overflow-hidden">
                <div class="h-3 bg-indigo-500" style="width: {{ $xp_progress }}%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2">
                {{ $xp_total }} / {{ $xp_for_next ?? ($level * 100) }} XP ({{ $xp_progress }}%)
            </p>
        </div>
    </div>

    <!-- Modul yang sedang dikerjakan -->
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold dark:text-white">Modul yang sedang kamu kerjakan</h3>
                    <a href="{{route('murid.modul')}}" class="text-sm text-indigo-600">Lihat semua</a>
                </div>

                <div class="space-y-3">
                    @forelse ($modules_progress as $m)
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold dark:text-white">{{ $m['title'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-300">
                                        {{ $m['completed'] }} / {{ $m['total_chapters'] }} chapter
                                    </p>
                                </div>
                                <div class="text-sm text-gray-500">{{ $m['percent'] }}%</div>
                            </div>

                            <div class="w-full mt-3 h-2 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500" style="width: {{ $m['percent'] }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada modul yang aktif.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Profile -->
        <aside class="space-y-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-indigo-600 text-white text-2xl font-bold flex items-center justify-center">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <h4 class="mt-4 font-semibold dark:text-white">{{ $user->name }}</h4>
                <p class="text-xs text-gray-400">Murid • Joined {{ $user->created_at->format('M Y') }}</p>

                <div class="mt-4 text-left">
                    <p class="text-xs text-gray-400">Progress level</p>
                    <div class="w-full h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden mt-2">
                        <div class="h-full bg-gradient-to-r from-indigo-500 to-pink-500" style="width: {{ $xp_progress }}%"></div>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Level {{ $level }} • {{ $xp_total }} XP</p>
                </div>
            </div>

        </aside>
    </div>
</div>

<script>
    (function() {
        const percent = {{ isset($modules_progress) && count($modules_progress)
            ? json_encode((int) round(array_sum(array_column($modules_progress, 'percent')) / max(1, count($modules_progress))))
            : 0 }};
        if (window.setSidebarProgress) window.setSidebarProgress(percent);
    })();
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init()</script>
@endsection
