@extends('layouts.dashboard')

@section('title', $chapter->title . ' — Halaman ' . $page->page_number)

@section('content')

@php
    $totalPages = $pages->count();
    $current = $page->page_number;

    $saved = \App\Models\ChapterPageProgress::where('user_id', auth()->id())
                ->where('chapter_id', $chapter->id)
                ->where('page_id', $page->id)
                ->first();

    // Jawaban tersimpan sebelumnya
    $savedAnswer = $saved->answer ?? null;

    $previous = $pages->where('page_number', $page->page_number - 1)->first();
    $next = $pages->where('page_number', $page->page_number + 1)->first();
@endphp

<div class="max-w-4xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 rounded-2xl shadow-sm mb-5">
        <h1 class="text-2xl md:text-3xl font-bold dark:text-white">{{ $chapter->title }}</h1>
        <p class="text-sm text-gray-500 dark:text-gray-300">Halaman {{ $current }} dari {{ $totalPages }}</p>

        <div class="mt-3 w-full h-2.5 bg-gray-200 dark:bg-gray-700 rounded-full">
            <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full"
                style="width: {{ round(($current / $totalPages) * 100) }}%">
            </div>
        </div>
    </div>

    {{-- ======================= VIDEO ======================= --}}
    @if ($page->type === 'video')
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Video Pembelajaran</h2>
            <div class="aspect-video rounded-xl overflow-hidden">
                <iframe src="{{ str_replace('watch?v=', 'embed/', $page->video_url) }}"
                        class="w-full h-full" allowfullscreen></iframe>
            </div>
        </div>
    @endif

    {{-- ======================= CONTENT ======================= --}}
    @if ($page->type === 'content')
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Materi</h2>
            <div class="prose dark:prose-invert max-w-none leading-relaxed">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>
    @endif

    {{-- ======================= QUESTION ======================= --}}
    @if ($page->type === 'question')
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow mb-6">

            <input type="hidden" id="page_id" value="{{ $page->id }}">
            <input type="hidden" id="chapter_id" value="{{ $chapter->id }}">

            <h2 class="font-semibold mb-3 dark:text-white">Pertanyaan</h2>

            <p class="text-gray-800 dark:text-gray-100 mb-4">{{ $page->question_text }}</p>

            @php
                // Perbaikan utama — memastikan data options selalu berbentuk array
                $options = is_array($page->options)
                    ? $page->options
                    : json_decode($page->options, true);
            @endphp

            @foreach($options as $key => $value)
                <label class="flex items-center gap-3 px-4 py-3 rounded-xl 
                            bg-gray-100 dark:bg-gray-700 cursor-pointer mb-2 hover:bg-gray-200 
                            dark:hover:bg-gray-600 transition">
                    <input type="radio"
                           name="answer"
                           class="answer-radio accent-indigo-600"
                           value="{{ $key }}"
                           {{ $savedAnswer == $key ? 'checked' : '' }}>
                    <span class="text-gray-900 dark:text-gray-100 text-sm">
                        <strong>{{ strtoupper($key) }}.</strong> {{ $value }}
                    </span>
                </label>
            @endforeach

        </div>
    @endif

    {{-- ======================= NAVIGATION ======================= --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 
                px-4 py-3 rounded-2xl shadow-sm flex justify-between">

        {{-- SEBELUMNYA --}}
        @if ($previous)
            <a href="{{ route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $previous->page_number]) }}"
               class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 
                      dark:hover:bg-gray-600 text-sm font-medium flex items-center gap-2">
                <i class="fas fa-arrow-left text-xs"></i> Sebelumnya
            </a>
        @else
            <span></span>
        @endif

        {{-- LANJUT --}}
        <button id="btnNext"
            class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium flex items-center gap-2">
            Lanjut <i class="fas fa-arrow-right text-xs"></i>
        </button>
    </div>

</div>

{{-- ======================= SCRIPT AUTOSAVE + NEXT ======================= --}}
<script>
document.querySelectorAll('.answer-radio').forEach(radio => {
    radio.addEventListener('change', function () {

        fetch("{{ route('murid.modules.page.autosave') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                chapter_id: document.getElementById("chapter_id").value,
                page_id: document.getElementById("page_id").value,
                answer: this.value
            })
        });
    });
});

document.getElementById("btnNext").addEventListener("click", function () {

    const isLast = {{ $current == $totalPages ? 'true' : 'false' }};

    Swal.fire({
        title: isLast ? 'Selesaikan chapter?' : 'Lanjut ke halaman berikutnya?',
        text: isLast
            ? 'Ini halaman terakhir. Menyelesaikan chapter sekarang?'
            : 'Pastikan jawaban atau materi sudah dipahami.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: isLast ? 'Selesai' : 'Lanjut',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((res) => {
        if (res.isConfirmed) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $page->page_number]) }}";

            let csrf = document.createElement('input');
            csrf.type = "hidden";
            csrf.name = "_token";
            csrf.value = "{{ csrf_token() }}";
            form.appendChild(csrf);

            document.body.appendChild(form);
            form.submit();
        }
    });
});
</script>

@endsection
