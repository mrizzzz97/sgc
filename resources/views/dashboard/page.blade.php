@extends('layouts.dashboard')

@section('title', $chapter->title . ' — Halaman ' . $page->page_number)

@section('content')

@if(session('error'))
    <div class="mb-4 p-4 bg-red-600/90 text-white rounded-xl shadow">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="mb-4 p-4 bg-green-600/90 text-white rounded-xl shadow">
        {{ session('success') }}
    </div>
@endif

@php
    $totalPages  = $pages->count();
    $current     = $page->page_number;
    $percent     = $totalPages > 0 ? round(($current / $totalPages) * 100) : 0;

    // Halaman sebelumnya (1 langkah)
    $previous = $pages->where('page_number', $current - 1)->first();
@endphp

<div class="max-w-4xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                p-6 rounded-2xl shadow-sm mb-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold dark:text-white">{{ $chapter->title }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-300">Modul: {{ $chapter->module->title }}</p>
            </div>

            <div class="text-right">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Halaman {{ $current }} dari {{ $totalPages }}
                </p>
                <p class="text-xs text-indigo-600 font-semibold">
                    {{ $percent }}% selesai
                </p>
            </div>
        </div>

        <div class="mt-4">
            <div class="w-full h-2.5 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-600"
                     style="width: {{ $percent }}%"></div>
            </div>
        </div>
    </div>

    {{-- VIDEO --}}
    @if ($page->type === 'video')
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    p-6 rounded-2xl shadow mb-6">

            <h2 class="font-semibold mb-3 dark:text-white">Video Pembelajaran</h2>

            <div class="aspect-video rounded-xl overflow-hidden bg-black">
                <iframe src="{{ str_replace('watch?v=', 'embed/', $page->video_url) }}"
                        allowfullscreen class="w-full h-full"></iframe>
            </div>
        </div>
    @endif

    {{-- CONTENT --}}
    @if ($page->type === 'content')
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    p-6 rounded-2xl shadow mb-6">

            <h2 class="font-semibold mb-3 dark:text-white">Materi</h2>

            <div class="prose dark:prose-invert max-w-none">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>
    @endif

    {{-- QUESTION --}}
    @if ($page->type === 'question')

        @php
            $saved = \App\Models\ChapterPageProgress::where('user_id', auth()->id())
                        ->where('chapter_id', $chapter->id)
                        ->where('page_id', $page->id)
                        ->first();

            $savedAnswer = $saved->answer ?? null;
            $options     = is_array($page->options) ? $page->options : json_decode($page->options, true);
        @endphp

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    p-6 rounded-2xl shadow mb-6">

            <h2 class="font-semibold mb-3 dark:text-white">Pertanyaan</h2>

            <p class="text-gray-900 dark:text-gray-100 mb-4">
                {{ $page->question_text }}
            </p>

            <form 
                action="{{ route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $current]) }}"
                method="POST"
                class="confirm-submit"
                data-is-last="{{ $current == $totalPages ? '1' : '0' }}"
            >
                @csrf

                {{-- OPTIONS --}}
                <div class="space-y-3">
                    @foreach($options as $key => $value)
                        <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer
                                      bg-gray-100 hover:bg-gray-200
                                      dark:bg-gray-700 dark:hover:bg-gray-600 transition">
                            <input type="radio"
                                   name="answer"
                                   class="answer-radio accent-indigo-600"
                                   value="{{ $key }}"
                                   {{ $savedAnswer == $key ? 'checked' : '' }}>
                            <span class="text-gray-900 dark:text-gray-100">
                                <strong>{{ strtoupper($key) }}.</strong> {{ $value }}
                            </span>
                        </label>
                    @endforeach
                </div>

                {{-- NAVIGATION --}}
                <div class="mt-6 bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700
                            rounded-2xl px-4 py-3 flex justify-between">

                    {{-- PREVIOUS --}}
                    @if ($previous)
                        <a href="{{ route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $previous->page_number]) }}"
                           class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            <i class="fas fa-arrow-left text-xs"></i> Sebelumnya
                        </a>
                    @else
                        <span></span>
                    @endif

                    {{-- NEXT --}}
                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">
                        Jawab & Lanjut
                        <i class="fas fa-arrow-right text-xs"></i>
                    </button>

                </div>
            </form>

        </div>

    @endif

    {{-- NEXT BUTTON UNTUK CONTENT & VIDEO --}}
    @if ($page->type !== 'question')

        <div class="mt-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    px-4 py-3 rounded-2xl shadow-sm flex justify-between">

            {{-- PREVIOUS --}}
            @if ($previous)
                <a href="{{ route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $previous->page_number]) }}"
                   class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left text-xs"></i> Sebelumnya
                </a>
            @else
                <span></span>
            @endif

            {{-- NEXT --}}
            <form 
                action="{{ route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $current]) }}"
                method="POST"
                class="confirm-submit"
                data-is-last="{{ $current == $totalPages ? '1' : '0' }}">
                @csrf

                <button type="submit"
                        class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">
                    Lanjut <i class="fas fa-arrow-right text-xs"></i>
                </button>
            </form>

        </div>

    @endif

</div>

@push('scripts')
<script>
    // ============ AUTOSAVE ============
    document.querySelectorAll('.answer-radio').forEach(radio => {
        radio.addEventListener('change', function () {
            fetch("{{ route('murid.modules.page.autosave') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    chapter_id: {{ $chapter->id }},
                    page_id: {{ $page->id }},
                    answer: this.value
                })
            });
        });
    });

    // ============ KONFIRMASI HANYA DI HALAMAN TERAKHIR ============
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.confirm-submit');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                const isLast = form.dataset.isLast === '1';

                // Jika bukan halaman terakhir → langsung submit tanpa notifikasi
                if (!isLast) {
                    return; // biarkan form submit normal
                }

                // Jika halaman terakhir → tampilkan konfirmasi
                e.preventDefault();

                Swal.fire({
                    title: 'Selesaikan chapter?',
                    text: 'Ini adalah halaman terakhir. Menandai selesai akan mengakhiri chapter ini. Apakah Anda yakin ingin melanjutkan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, selesai',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
