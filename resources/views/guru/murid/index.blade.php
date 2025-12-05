@extends('layouts.guru')

@section('title', 'Murid Binaan')

@section('content')

<div class="max-w-6xl mx-auto p-10 animate-fade-in">

    <!-- HEADER -->
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-indigo-500 to-purple-500 
                   text-transparent bg-clip-text">
            Murid Binaan
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Lihat perkembangan ranking & XP murid.
        </p>
    </div>


    <!-- WRAPPER -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">

        {{-- ================================ --}}
        {{-- MODE TABEL (HANYA DI DESKTOP) --}}
        {{-- ================================ --}}
        <div class="hidden md:block">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-600 dark:text-gray-300 text-sm border-b dark:border-gray-700">
                        <th class="py-3">Nama Murid</th>
                        <th class="text-center">Ranking</th>
                        <th>Total XP</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($students as $s)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/40 
                                   transition-all duration-200">

                            <!-- Nama Murid -->
                            <td class="py-3 font-semibold dark:text-white flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/40 
                                            flex items-center justify-center">
                                    <i class="fas fa-user text-indigo-600 dark:text-indigo-300"></i>
                                </div>
                                {{ $s->name }}
                            </td>

                            <!-- Ranking -->
                            <td class="text-center">
                                <span class="px-3 py-1 bg-purple-700 text-white rounded-lg text-sm">
                                    {{ $s->rank }}
                                </span>
                            </td>

                            <!-- XP -->
                            <td class="text-indigo-600 dark:text-indigo-400 font-bold text-lg">
                                {{ $s->xp }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3"
                                class="py-10 text-center text-gray-500 dark:text-gray-400">
                                Belum ada murid.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>


        {{-- ================================ --}}
        {{-- MODE CARD (HP & TABLET) --}}
        {{-- ================================ --}}
        <div class="grid grid-cols-1 gap-5 md:hidden">

            @forelse ($students as $s)
                <div class="p-5 rounded-xl bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 shadow hover:shadow-lg transition cursor-pointer">

                    <!-- Top row -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-200 dark:bg-indigo-900/40 flex items-center justify-center">
                            <i class="fas fa-user text-indigo-700 dark:text-indigo-300 text-xl"></i>
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold dark:text-white">{{ $s->name }}</h3>
                        </div>
                    </div>

                    <!-- Info row -->
                    <div class="mt-4 flex justify-between items-center">

                        <!-- Ranking -->
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 dark:text-gray-300">Ranking</span>
                            <span class="px-3 py-1 bg-purple-700 text-white rounded-lg text-sm text-center">
                                {{ $s->rank }}
                            </span>
                        </div>

                        <!-- XP -->
                        <div class="flex flex-col text-right">
                            <span class="text-xs text-gray-500 dark:text-gray-300">Total XP</span>
                            <span class="text-indigo-600 dark:text-indigo-400 font-bold text-xl">
                                {{ $s->xp }}
                            </span>
                        </div>

                    </div>

                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400">
                    Belum ada murid.
                </p>
            @endforelse

        </div>

    </div>

</div>

@endsection
