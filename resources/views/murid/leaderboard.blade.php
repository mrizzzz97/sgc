@extends('layouts.dashboard')

@section('title', 'Leaderboard XP')

@section('content')
<div class="max-w-5xl mx-auto">

    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 
                transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
        <h1 class="text-3xl font-bold dark:text-white mb-2">Leaderboard XP</h1>
        <p class="text-gray-600 dark:text-gray-300">
            Peringkat murid berdasarkan total XP.
        </p>
    </div>

    <!-- Rank User -->
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white p-6 rounded-2xl shadow-lg mb-10
                transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
        <p class="text-lg opacity-90">Peringkat Kamu</p>

        <div class="mt-3 flex items-end gap-3">
            <p class="text-5xl font-extrabold tracking-tight drop-shadow-sm">
                #{{ $userRank }}
            </p>
            <span class="text-sm bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">
                Kamu: {{ $user->name }}
            </span>
        </div>
    </div>

    <!-- Table Leaderboard -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow border border-gray-200/50 dark:border-gray-700/50
                transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

        <h2 class="text-xl font-bold dark:text-white mb-6">Top Murid</h2>

        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
            <table class="w-full text-left">
                <thead class="bg-gray-100/70 dark:bg-gray-700/60 backdrop-blur">
                    <tr class="text-gray-600 dark:text-gray-300 border-b dark:border-gray-600">
                        <th class="py-3 px-4">Rank</th>
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Level</th>
                        <th class="py-3 px-4">XP</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($leaderboard as $index => $murid)
                    <tr class="border-b dark:border-gray-700 transition-all duration-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/40 hover:translate-x-1">
                        <td class="py-3 px-4 font-semibold text-indigo-600 dark:text-indigo-400">
                            #{{ $index + 1 }}
                        </td>

                        <td class="py-3 px-4 dark:text-white font-medium">
                            {{ $murid->name }}
                        </td>

                        <td class="py-3 px-4 dark:text-white">
                            <span class="px-3 py-1 rounded-full text-sm bg-indigo-100 dark:bg-indigo-800 text-indigo-600 dark:text-indigo-200 font-semibold">
                                Level {{ $murid->level }}
                            </span>
                        </td>

                        <td class="py-3 px-4 dark:text-white font-semibold">
                            {{ $murid->xp_total }} XP
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
