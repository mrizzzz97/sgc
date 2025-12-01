@extends('layouts.dashboard')

@section('title', $chapter->title . ' — Halaman ' . $page->page_number)

@section('content')

@if(session('error'))
    <div class="mb-4 p-4 bg-red-600 text-white rounded-xl shadow">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="mb-4 p-4 bg-green-600 text-white rounded-xl shadow">
        {{ session('success') }}
    </div>
@endif

<div class="max-w-4xl mx-auto">

    <!-- JUDUL -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
        <h1 class="text-2xl font-bold dark:text-white">
            {{ $chapter->title }} — Halaman {{ $page->page_number }}
        </h1>
        <p class="text-gray-400 dark:text-gray-300 mt-1">
            Modul: {{ $chapter->module->title }}
        </p>
    </div>

    @php
    $totalPages = $pages->count();
    $currentPageNumber = $page->page_number;
    $percent = round(($currentPageNumber / $totalPages) * 100);
@endphp

    <div class="mb-6">
        <p class="text-sm text-gray-400 dark:text-gray-300">
            Halaman {{ $currentPageNumber }} dari {{ $totalPages }}
        </p>

        <div class="w-full h-2 bg-gray-700 rounded mt-1">
            <div class="h-2 bg-indigo-500 rounded"
                style="width: {{ $percent }}%"></div>
        </div>
    </div>



    {{-- ========================================================= --}}
    {{-- TYPE: VIDEO --}}
    {{-- ========================================================= --}}
    @if ($page->type === 'video')
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Video Pembelajaran</h2>

            <div class="aspect-video w-full rounded-xl overflow-hidden bg-black">
                <iframe 
                    src="{{ str_replace('watch?v=', 'embed/', $page->video_url) }}"
                    allowfullscreen
                    class="w-full h-full">
                </iframe>
            </div>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- TYPE: CONTENT --}}
    {{-- ========================================================= --}}
    @if ($page->type === 'content')
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Materi</h2>

            <div class="prose dark:prose-invert max-w-none text-white">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- TYPE: QUESTION --}}
    {{-- ========================================================= --}}
    @if ($page->type === 'question')
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            
            <h2 class="font-semibold mb-3 dark:text-white">Pertanyaan</h2>

            <p class="dark:text-gray-200 mb-3">
                {{ $page->question_text }}
            </p>

            @php
                $options = is_array($page->options)
                    ? $page->options
                    : json_decode($page->options, true);
            @endphp

            <form 
                action="{{ route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $page->page_number]) }}" 
                method="POST"
                class="confirm-submit"
            >
                @csrf

                <div class="mt-4 space-y-3">
                    @foreach($options as $key => $value)
                        <label class="flex items-center space-x-3 bg-gray-700 p-3 rounded-xl cursor-pointer">
                            <input type="radio" name="answer" value="{{ $key }}" required>
                            <span class="text-white">{{ strtoupper($key) }}. {{ $value }}</span>
                        </label>
                    @endforeach
                </div>

                @if (session('error'))
                    <p class="text-red-400 mt-4">{{ session('error') }}</p>
                @endif

                {{-- TOMBOL NAVIGASI --}}
                <div class="flex justify-between mt-6">
                    
                    {{-- TOMBOL SEBELUMNYA --}}
                    @php
                        $prevPage = $pages->where('page_number', $page->page_number - 1)->first();
                    @endphp

                    @if ($prevPage)
                        <a href="{{ route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $prevPage->page_number]) }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                            ← Sebelumnya
                        </a>
                    @else
                        <span></span>
                    @endif


                    {{-- TOMBOL NEXT / JAWAB --}}
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        Jawab & Lanjut →
                    </button>
                </div>

            </form>

        </div>
    @endif



    {{-- ========================================================= --}}
    {{-- NEXT BUTTON untuk VIDEO / CONTENT --}}
    {{-- ========================================================= --}}
    @if ($page->type !== 'question')

        @php
            $prevPage = $pages->where('page_number', $page->page_number - 1)->first();
        @endphp

        <div class="flex justify-between mt-6">

            {{-- Tombol SEBELUMNYA --}}
            @if ($prevPage)
                <a href="{{ route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $prevPage->page_number]) }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                    ← Sebelumnya
                </a>
            @else
                <span></span>
            @endif

            {{-- Tombol LANJUT --}}
            <form 
                action="{{ route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $page->page_number]) }}"
                method="POST" 
                class="confirm-submit">
                @csrf
                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Lanjut →
                </button>
            </form>

        </div>
    @endif

</div>


{{-- SWEETALERT CONFIRM --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.confirm-submit');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Pengiriman',
                text: 'Apakah Anda yakin ingin melanjutkan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, lanjut',
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
