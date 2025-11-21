@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @php
        $user = Auth::user();
        $enrollments = $user->enrollments()->with('module')->get();
        $moduleIds = $enrollments->pluck('module_id')->toArray();
        $chapterIds = \App\Models\Chapter::whereIn('module_id', $moduleIds)->pluck('id')->toArray();
        $questionsInModules = \App\Models\Question::whereIn('chapter_id', $chapterIds);
        $totalQuestions = $questionsInModules->count();
        $answeredQuestionIds = $user->answers()->pluck('question_id')->unique()->toArray();
        $answeredInModules = \App\Models\Question::whereIn('id', $answeredQuestionIds)->whereIn('chapter_id', $chapterIds)->pluck('id')->unique()->count();
        // pendingQuestions as a collection of Question models the user hasn't answered yet
        $pendingQuestions = \App\Models\Question::whereIn('chapter_id', $chapterIds)
            ->whereNotIn('id', $answeredQuestionIds)
            ->with('chapter.module')
            ->get();
        $pendingCount = $pendingQuestions->count();
        $avgPoints = round($user->answers()->avg('points_awarded') ?? 0, 1);
        $certificates = $user->certificates()->with('module')->get();
        $recentAnswers = $user->answers()->with('question')->latest()->take(5)->get();
    @endphp
    <!-- Header -->
    <header class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Murid</h1>
                <p class="mt-1 text-sm text-gray-600">Selamat datang kembali, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-3">
                <img src="https://i.pravatar.cc/150?u={{ Auth::user()->email }}" alt="Profile" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                <div class="text-right">
                    <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-500">Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Stats Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card: Mata Pelajaran -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-blue-500 rounded-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Mata Pelajaran</dt>
                                            <dd class="text-lg font-semibold text-gray-900">{{ $enrollments->count() }}</dd>
                                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card: Tugas Tersisa -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-red-500 rounded-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                            <div class="space-y-4">
                                @forelse($pendingQuestions as $pq)
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-gray-700">{{ $pq->question_text ?? 'Soal' }}</p>
                                            <p class="text-xs text-gray-400">{{ optional($pq->chapter->module)->title ?? '' }}</p>
                                        </div>
                                        <div class="ml-auto">
                                            @if(optional($pq->chapter)->module)
                                                <a href="{{ route('modules.show', $pq->chapter->module) }}" class="text-indigo-600 hover:underline text-sm">Buka</a>
                                            @else
                                                <span class="text-sm text-gray-500">Tidak tersedia</span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-sm text-gray-500">Tidak ada tugas mendatang. Bagus!</div>
                                @endforelse
                            </div>
                    <div class="flex-shrink-0 p-3 bg-yellow-500 rounded-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Kehadiran Bulan Ini</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ round($enrollments->avg('progress') ?? 0) }}%</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <main class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kiri: Tugas & Pengumuman -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Tugas Mendatang (Unanswered Questions in Enrolled Modules) -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tugas Mendatang</h3>
                    <div class="flow-root">
                        <ul class="-my-5 divide-y divide-gray-200">
                            @php
                                $unansweredQuestions = \App\Models\Question::whereIn('chapter_id', $chapterIds)
                                    ->whereNotIn('id', $answeredQuestionIds)
                                    ->with('chapter.module')
                                    ->take(6)
                                    ->get();
                            @endphp

                            @forelse($unansweredQuestions as $q)
                                <li class="py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-xs font-medium text-indigo-700">{{ strtoupper(substr($q->chapter->module->title,0,1)) }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">{{ Str::limit($q->question_text, 70) }}</p>
                                                <p class="text-sm text-gray-500">{{ $q->chapter->module->title }} - {{ $q->chapter->title }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('modules.show', $q->chapter->module) }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Buka Modul</a>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-sm text-gray-500">Tidak ada tugas tertunda. Kerja bagus!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pengumuman Terbaru / Sertifikat -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Sertifikat & Pengumuman</h3>
                    <div class="space-y-4">
                        @if($certificates->count() > 0)
                            @foreach($certificates as $cert)
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="h-8 w-8 rounded-full bg-amber-100 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zM12 8v13"></path></svg>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Sertifikat: {{ $cert->module->title }}</p>
                                            <p class="text-sm text-gray-500">Nomor: {{ $cert->certificate_number }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('certificates.show', $cert) }}" class="text-indigo-600 hover:underline text-sm">Lihat</a>
                                </div>
                            @endforeach
                        @else
                            <div class="text-sm text-gray-500">Belum ada sertifikat. Selesaikan modul untuk mendapatkan sertifikat.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Jadwal & Aksi Cepat -->
        <aside class="space-y-6">
            <!-- Jadwal / Next Chapters -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Lanjutkan Pembelajaran</h3>
                    <div class="space-y-3">
                        @php
                            $nextChapters = [];
                            foreach($enrollments as $en) {
                                $chapters = $en->module->chapters()->orderBy('order')->get();
                                foreach($chapters as $ch) {
                                    $done = \App\Models\ChapterCompletion::where('user_id', $user->id)->where('chapter_id', $ch->id)->exists();
                                    if (!$done) {
                                        $nextChapters[] = ['module' => $en->module, 'chapter' => $ch];
                                        break;
                                    }
                                }
                            }
                        @endphp

                        @forelse($nextChapters as $item)
                            <div class="flex items-center justify-between text-sm">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $item['chapter']->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $item['module']->title }}</div>
                                </div>
                                <a href="{{ route('modules.show', $item['module']) }}" class="text-indigo-600 hover:underline text-sm">Lanjutkan</a>
                            </div>
                        @empty
                            <div class="text-sm text-gray-500">Semua chapter selesai atau belum ada chapter tersedia.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Aksi Cepat -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="#" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Lihat Semua Tugas</a>
                        <a href="#" class="block w-full text-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Lihat Nilai</a>
                        <a href="#" class="block w-full text-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Materi Pelajaran</a>
                    </div>
                </div>
            </div>
        </aside>
    </main>
</div>
@endsection