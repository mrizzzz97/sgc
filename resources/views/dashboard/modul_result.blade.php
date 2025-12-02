@extends('layouts.dashboard')

@section('title', 'Hasil Modul')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow">

        {{-- JUDUL --}}
        <h1 class="text-3xl font-bold dark:text-white mb-6">
            Hasil Modul: {{ $module->title }}
        </h1>

        {{-- STATUS RATA-RATA --}}
        <div class="mb-6 p-4 rounded-xl bg-indigo-600 text-white">
            <p class="text-lg">
                Nilai Rata-rata Modul:
                <span class="font-bold text-2xl">{{ request()->avg ?? '0' }}%</span>
            </p>
        </div>

        {{-- LIST CHAPTER --}}
        <h2 class="text-xl font-semibold dark:text-white mb-4">Ringkasan Per Chapter</h2>

        <ul class="space-y-4 mb-8">
            @foreach($module->chapters as $chap)
                @php
                    $result = \App\Models\ChapterResult::where('chapter_id', $chap->id)
                        ->where('user_id', auth()->id())
                        ->first();
                @endphp

                <li class="p-4 bg-gray-700 rounded-xl text-white">
                    <div class="flex justify-between">
                        <span class="font-semibold">{{ $chap->title }}</span>

                        <span>
                            @if($result)
                                <span class="font-bold">{{ $result->score }}%</span>
                                —
                                <span class="{{ $result->passed ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $result->passed ? 'Lulus' : 'Tidak Lulus' }}
                                </span>
                            @else
                                <span class="text-gray-300">Belum Dikerjakan</span>
                            @endif
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- CEK APAKAH SEMUA LULUS --}}
        @php
            $chapterIds = $module->chapters->pluck('id');
            $allPassed = \App\Models\ChapterResult::whereIn('chapter_id', $chapterIds)
                ->where('user_id', auth()->id())
                ->where('passed', true)
                ->count() == $module->chapters->count();
        @endphp

        {{-- INFORMASI KELULUSAN --}}
        @if($allPassed)
            <div class="mb-6 p-4 bg-green-600 text-white rounded-xl">
                Semua chapter telah diselesaikan dengan nilai minimal 75%.
                Anda berhak mendapatkan sertifikat penyelesaian modul.
            </div>

            <a href="{{ route('murid.modules.certificate', $module->id) }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                Unduh Sertifikat (PDF)
            </a>
        @else
            <div class="mb-6 p-4 bg-red-600 text-white rounded-xl">
                Anda belum menyelesaikan seluruh chapter dengan nilai minimal 75%.
                Silakan ulangi chapter yang belum lulus.
            </div>
        @endif

    </div>

</div>

@endsection
