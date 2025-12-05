@extends('layouts.guru')

@section('title', 'Kelola Modul')

@section('content')

<div class="max-w-6xl mx-auto p-4 sm:p-8 md:p-10 animate-fade-in">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-indigo-500 to-purple-500 text-transparent bg-clip-text">
                Kelola Modul Pembelajaran
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm sm:text-base">
                Atur modul, chapter, dan komentar dalam satu tempat.
            </p>
        </div>

        <a href="{{ route('guru.modul.create') }}"
           class="px-5 py-3 text-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:opacity-90 
                  text-white rounded-xl font-semibold shadow-lg hover:shadow-2xl transition duration-300
                  text-sm sm:text-base">
            + Tambah Modul
        </a>
    </div>

    <!-- LIST MODUL -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-8">

        @forelse($modules as $m)

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 sm:p-7 shadow-xl hover:shadow-2xl
                    border border-gray-200 dark:border-gray-700 transition transform hover:-translate-y-1">

            <!-- HEADER CARD -->
            <div class="flex items-start justify-between mb-4">
                <div class="w-4/6">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                        Modul #{{ $m->order }}
                    </p>

                    <h2 class="text-xl sm:text-2xl font-bold dark:text-white leading-tight">
                        {{ $m->title }}
                    </h2>
                </div>

                <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-xl 
                            bg-indigo-100 dark:bg-indigo-900/40 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="h-6 w-6 sm:h-7 sm:w-7 text-indigo-600 dark:text-indigo-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 20l9-5-9-5-9 5 9 5zm0 0v-6m0 0L3 9l9-5 9 5-9 5z" />
                    </svg>
                </div>
            </div>

            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-4">
                {{ $m->description }}
            </p>

            <!-- ACTION BUTTONS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">

                <a href="{{ route('guru.modul.chapter.index', $m->id) }}"
                   class="flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 
                          text-white rounded-lg text-sm shadow transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 8h10M7 12h5m5 8H7a2 2 0 01-2-2V6a2 2 0 012-2h8l4 4v12a2 2 0 01-2 2z" />
                    </svg>
                    Kelola Chapter
                </a>

                <a href="{{ route('guru.modul.edit', $m->id) }}"
                   class="flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-600 hover:bg-gray-700 
                          text-white rounded-lg text-sm shadow transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M11 5l6 6M11 5v6h6" />
                    </svg>
                    Edit Modul
                </a>

                <a href="{{ route('guru.modul.comments', $m->id) }}"
                   class="flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 
                          text-white rounded-lg text-sm shadow transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 8h2a2 2 0 012 2v9l-4-4H7a2 2 0 01-2-2V6a2 2 0 012-2h11a2 2 0 012 2v2z" />
                    </svg>
                    Komentar
                </a>

                <form action="{{ route('guru.modul.destroy', $m->id) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini?');">
                    @csrf
                    @method('DELETE')

                    <button
                        class="flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 
                               text-white rounded-lg text-sm shadow transition w-full">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0a2 2 0 012-2h4a2 2 0 012 2" />
                        </svg>
                        Hapus
                    </button>
                </form>

            </div>

        </div>

        @empty

        <div class="col-span-1 sm:col-span-2 xl:col-span-3 text-center py-14 text-gray-500 dark:text-gray-300 text-lg">
            Belum ada modul. Tambahkan modul baru dulu ya.
        </div>

        @endforelse

    </div>

</div>

@endsection
