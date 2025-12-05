@extends('layouts.guru')

@section('title', 'Edit Chapter')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 
            dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">

    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

        <!-- HEADER -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8 
                    transform transition-all duration-500 hover:shadow-2xl">

            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Edit Chapter</h1>
                        <p class="text-indigo-100 mt-1">{{ $chapter->title }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden
                    transform transition-all duration-500 hover:shadow-2xl">

            <form action="{{ route('guru.modul.chapter.update', $chapter->id) }}"
                  method="POST" class="p-6 md:p-8">
                @csrf
                @method('PATCH')

                <!-- ========== JUDUL ========== -->
                <div class="mb-6 group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Judul Chapter
                    </label>

                    <div class="relative">
                        <!-- ICON -->
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-5 w-5 text-gray-400"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 5h10l3 3v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z" />
                            </svg>
                        </div>

                        <input type="text" name="title"
                               class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600
                                      rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                                      transition-transform focus:scale-[1.02]"
                               value="{{ $chapter->title }}" required>
                    </div>
                </div>

                <!-- ========== DESKRIPSI ========== -->
                <div class="mb-6 group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi
                    </label>

                    <div class="relative">
                        <!-- ICON -->
                        <div class="absolute top-3 left-3 text-gray-400 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-5 w-5"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>

                        <textarea name="description" rows="4"
                                  class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600
                                         rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                         focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                                         transition-transform focus:scale-[1.02]">{{ $chapter->description }}</textarea>
                    </div>
                </div>

                <!-- ========== ORDER ========== -->
                <div class="mb-8 group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Urutan Chapter
                    </label>

                    <div class="relative">
                        <!-- ICON -->
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-5 w-5 text-gray-400"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                        </div>

                        <input type="number" name="order"
                               class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600
                                      rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                                      transition-transform focus:scale-[1.02]"
                               value="{{ $chapter->order }}" required>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600
                                   text-white font-medium rounded-lg shadow-lg hover:shadow-xl
                                   transform transition-all duration-200 hover:scale-105
                                   flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<style>
    .group { opacity: 0; transform: translateY(20px); }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.group').forEach((g, i) => {
            setTimeout(() => {
                g.style.transition = "all .5s ease";
                g.style.opacity = "1";
                g.style.transform = "translateY(0)";
            }, 100 * i);
        });
    });
</script>
@endsection
