@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Siswa</h1>
                        <p class="text-gray-600 mt-2">Modul: {{ $module->icon }} {{ $module->title }}</p>
                    </div>
                    <a href="{{ route('enrollments.students', $module) }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition">← Kembali ke List</a>
                </div>

                <!-- Student Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column: Student Data -->
                    <div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Siswa</h2>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-600">Nama</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $enrollment->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $enrollment->user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status Enrollment</p>
                                    <p class="mt-1">
                                        @if ($enrollment->status === 'completed')
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✓ Selesai</span>
                                        @elseif ($enrollment->status === 'active')
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">⏳ Aktif</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">✗ Berhenti</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total XP</p>
                                    <p class="text-lg font-semibold text-indigo-600">{{ $enrollment->user->dailyXps->sum('points') }} XP</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Progress -->
                    <div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Progress Pembelajaran</h2>
                            <div class="space-y-6">
                                <div>
                                    <p class="text-sm text-gray-600 mb-2">Overall Progress</p>
                                    <div class="w-full bg-gray-200 rounded-full h-4">
                                        <div class="bg-indigo-600 h-4 rounded-full" style="width: {{ $enrollment->progress }}%"></div>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-1 font-semibold">{{ $enrollment->progress }}% Selesai</p>
                                </div>

                                <!-- Chapter Progress -->
                                <div>
                                    <p class="text-sm text-gray-600 mb-3">Progress Per Chapter</p>
                                    <div class="space-y-2">
                                        @foreach ($chapters as $chapter)
                                            @php
                                                $completedQuestions = $enrollment->user->answers()
                                                    ->where('chapter_id', $chapter->id)
                                                    ->where('is_correct', true)
                                                    ->count();
                                                $totalQuestions = $chapter->questions->count();
                                                $chapterProgress = $totalQuestions > 0 ? ($completedQuestions / $totalQuestions) * 100 : 0;
                                            @endphp
                                            <div>
                                                <div class="flex justify-between items-center mb-1">
                                                    <p class="text-xs font-semibold text-gray-700">{{ $chapter->title }}</p>
                                                    <p class="text-xs text-gray-600">{{ $completedQuestions }}/{{ $totalQuestions }}</p>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $chapterProgress }}%"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Answers Review -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-8 border-b-2 border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900">Review Pembelajaran Siswa</h2>
                </div>

                <div class="p-8">
                    @forelse ($chapters as $chapter)
                        <div class="mb-12 pb-8 border-b border-gray-200">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $chapter->title }}</h3>
                                
                                <!-- Video Section -->
                                @if ($chapter->video_url)
                                    <div class="mb-6">
                                        <div class="mb-3">
                                            <span class="inline-flex items-center bg-indigo-600 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-5.197-3.028A1 1 0 008 9.028v5.944a1 1 0 001.555.832l5.197-3.028a1 1 0 000-1.664z" />
                                                </svg>
                                                <span class="ml-2">Video Pembelajaran</span>
                                            </span>
                                        </div>

                                        <div class="relative w-full rounded-lg overflow-hidden bg-gray-900 shadow" style="padding-bottom: 56.25%;">
                                            @php
                                                // Extract YouTube video ID from URL
                                                $videoId = '';
                                                if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $chapter->video_url, $matches)) {
                                                    $videoId = $matches[1];
                                                }
                                            @endphp
                                            @if ($videoId)
                                                <iframe class="absolute top-0 left-0 w-full h-full" 
                                                        src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&showinfo=0" 
                                                        frameborder="0" 
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                        allowfullscreen></iframe>
                                                <!-- subtle play overlay for clarity on small screens -->
                                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                                    <div class="bg-black bg-opacity-30 rounded-full p-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-5.197-3.028A1 1 0 008 9.028v5.944a1 1 0 001.555.832l5.197-3.028a1 1 0 000-1.664z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800">
                                                    <p class="text-white text-center">Video tidak dapat dimuat</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Chapter Description -->
                                @if ($chapter->description)
                                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                        <p class="text-sm text-gray-700">{{ $chapter->description }}</p>
                                    </div>
                                @endif
                            </div>

                            @php
                                $chapterAnswers = $enrollment->user->answers()
                                    ->whereIn('question_id', $chapter->questions->pluck('id'))
                                    ->get();
                            @endphp

                            @if ($chapter->questions->count() > 0)
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-gray-600 mb-3">📝 Pertanyaan & Jawaban</p>
                                </div>
                                <div class="space-y-4">
                                    @foreach ($chapter->questions as $question)
                                        @php
                                            $answer = $chapterAnswers->where('question_id', $question->id)->first();
                                        @endphp
                                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-500">
                                            <div class="flex items-start justify-between mb-2">
                                                <h4 class="font-semibold text-gray-900 flex-1">{{ $question->question_text }}</h4>
                                                @if ($answer)
                                                    @if ($question->type === 'multiple_choice')
                                                        @if ($answer->is_correct)
                                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✓ Benar</span>
                                                        @else
                                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✗ Salah</span>
                                                        @endif
                                                    @else
                                                        @if ($answer->is_correct === null)
                                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">⏳ Pending</span>
                                                        @elseif ($answer->is_correct)
                                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✓ Disetujui</span>
                                                        @else
                                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✗ Ditolak</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                            @if ($answer)
                                                <div class="mt-3 space-y-2">
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-semibold">Jawaban Siswa:</span>
                                                        {{ $answer->answer_text }}
                                                    </p>
                                                    @if ($question->type === 'multiple_choice')
                                                        <p class="text-sm text-gray-600">
                                                            <span class="font-semibold">Jawaban Benar:</span>
                                                            {{ $question->correct_answer }}
                                                        </p>
                                                    @endif
                                                    @if ($answer->points_awarded)
                                                        <p class="text-sm text-indigo-600 font-semibold">
                                                            +{{ $answer->points_awarded }} XP
                                                        </p>
                                                    @endif
                                                </div>
                                            @else
                                                <p class="text-sm text-gray-500 italic">Siswa belum menjawab pertanyaan ini</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 italic text-sm">Belum ada pertanyaan di chapter ini</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">Modul ini belum memiliki chapter</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
