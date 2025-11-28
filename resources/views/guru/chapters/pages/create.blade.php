@extends('layouts.guru')

@section('title', 'Tambah Halaman')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-indigo-900 transition-colors duration-300">
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-6 transform transition-all duration-500 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Tambah Halaman</h1>
                        <p class="text-indigo-100 mt-1">Chapter: {{ $chapter->title }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
            <form action="{{ route('guru.modul.chapter.pages.store', $chapter->id) }}" method="POST" class="p-6 md:p-8">
                @csrf

                <!-- Page Number Field -->
                <div class="mb-6 group">
                    <label for="page_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-200 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400">
                        Nomor Halaman
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="number"
                               id="page_number"
                               name="page_number"
                               class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                               placeholder="1"
                               required>
                    </div>
                </div>

                <!-- Page Type Field -->
                <div class="mb-6 group">
                    <label for="pageType" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-200 group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400">
                        Tipe Halaman
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <select name="type" id="pageType"
                                class="appearance-none w-full pl-10 pr-10 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                                required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="video">Video</option>
                            <option value="question">Soal</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Video Form -->
                <div id="videoForm" class="hidden mb-6 transform transition-all duration-500 opacity-0 max-h-0 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 p-4 rounded-lg border border-red-200 dark:border-red-800">
                        <div class="flex items-center mb-3">
                            <div class="bg-red-500 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Konten Video</h3>
                        </div>
                        <div class="group">
                            <label for="video_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                URL Video YouTube
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </div>
                                <input type="text"
                                       id="video_url"
                                       name="video_url"
                                       class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                                       placeholder="https://youtube.com/...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question Form -->
                <div id="questionForm" class="hidden transform transition-all duration-500 opacity-0 max-h-0 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-500 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Konten Soal</h3>
                        </div>

                        <!-- Question Text -->
                        <div class="mb-4 group">
                            <label for="question_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Teks Soal
                            </label>
                            <textarea id="question_text"
                                      name="question_text"
                                      class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                                      rows="3"
                                      placeholder="Tuliskan soal di sini..."></textarea>
                        </div>

                        <!-- Answer Options -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Opsi Jawaban
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400 font-medium">A</span>
                                    </div>
                                    <input type="text" name="options[a]"
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                                           placeholder="Opsi A">
                                </div>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400 font-medium">B</span>
                                    </div>
                                    <input type="text" name="options[b]"
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                                           placeholder="Opsi B">
                                </div>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400 font-medium">C</span>
                                    </div>
                                    <input type="text" name="options[c]"
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                                           placeholder="Opsi C">
                                </div>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400 font-medium">D</span>
                                    </div>
                                    <input type="text" name="options[d]"
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]"
                                           placeholder="Opsi D">
                                </div>
                            </div>
                        </div>

                        <!-- Correct Answer -->
                        <div class="group">
                            <label for="correct_answer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Jawaban Benar
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <select name="correct_answer"
                                        id="correct_answer"
                                        class="appearance-none w-full pl-10 pr-10 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 transform focus:scale-[1.02]">
                                    <option value="">-- Pilih Jawaban --</option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Halaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript for animations -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('pageType');
        const videoForm = document.getElementById('videoForm');
        const questionForm = document.getElementById('questionForm');

        typeSelect.addEventListener('change', function () {
            // Reset both forms
            videoForm.classList.add('hidden');
            questionForm.classList.add('hidden');
            
            // Add transition classes
            videoForm.classList.add('opacity-0', 'max-h-0');
            questionForm.classList.add('opacity-0', 'max-h-0');
            
            // Show the appropriate form with animation
            if (this.value === 'video') {
                setTimeout(() => {
                    videoForm.classList.remove('hidden');
                    // Trigger reflow to ensure transition works
                    void videoForm.offsetWidth;
                    videoForm.classList.remove('opacity-0', 'max-h-0');
                    videoForm.classList.add('opacity-100');
                }, 10);
            } else if (this.value === 'question') {
                setTimeout(() => {
                    questionForm.classList.remove('hidden');
                    // Trigger reflow to ensure transition works
                    void questionForm.offsetWidth;
                    questionForm.classList.remove('opacity-0', 'max-h-0');
                    questionForm.classList.add('opacity-100');
                }, 10);
            }
        });

        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('absolute', 'bg-white', 'opacity-30', 'rounded-full', 'animate-ping');
                ripple.style.width = ripple.style.height = '40px';
                ripple.style.left = `${e.offsetX - 20}px`;
                ripple.style.top = `${e.offsetY - 20}px`;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });
</script>

<style>
    /* Custom animations and transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .transform {
        transform-origin: center;
    }
    
    /* Focus ring animation */
    .focus\\:ring-2:focus {
        animation: pulse-ring 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse-ring {
        0% {
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
        }
    }
    
    /* Smooth height transition for form sections */
    #videoForm, #questionForm {
        transition: max-height 0.5s ease-in-out, opacity 0.3s ease-in-out, padding 0.3s ease-in-out;
        overflow: hidden;
    }
    
    #videoForm.opacity-100, #questionForm.opacity-100 {
        max-height: 1000px;
        padding: 1rem;
    }
    
    /* Input field focus animation */
    input:focus, textarea:focus, select:focus {
        animation: input-focus 0.3s ease-in-out;
    }
    
    @keyframes input-focus {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.02);
        }
        100% {
            transform: scale(1.02);
        }
    }
</style>
@endsection