@extends('layouts.guru')

@section('title', 'Tambah Chapter Baru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-all duration-300">
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

        <!-- HEADER -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8 transform transition duration-500 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Tambah Chapter Baru</h1>
                        <p class="text-indigo-100 mt-1">Modul: {{ $module->title }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform transition duration-500 hover:shadow-2xl">
            <form action="{{ route('guru.modul.chapter.store', $module->id) }}" method="POST" class="p-6 md:p-8 space-y-6">
                @csrf

                <!-- Title -->
                <div class="group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-indigo-500">
                        Judul Chapter
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6M7 5h10l3 3v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z" />
                            </svg>
                        </div>

                        <input type="text" name="title" required
                            class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                   focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>

                <!-- Description -->
                <div class="group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi
                    </label>

                    <div class="relative">
                        <div class="absolute left-3 top-3 text-gray-400 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>

                        <textarea name="description" rows="4"
                            class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 dark:border-gray-600
                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                   focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                            placeholder="Isi deskripsi singkat..."></textarea>
                    </div>
                </div>

                <!-- Order -->
                <div class="group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Urutan Chapter
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h4" />
                            </svg>
                        </div>

                        <input type="number" name="order" required
                            class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 dark:border-gray-600
                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                   focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium 
                               rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Chapter
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Fade-in Animation -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.group').forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(15px)';
            setTimeout(() => {
                el.style.transition = '0.4s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 120 * i);
        });
    });
</script>
@endsection
