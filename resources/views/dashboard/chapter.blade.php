@extends('layouts.dashboard')

@section('title', $chapter->title)

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Title -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
        <h1 class="text-2xl font-bold dark:text-white">{{ $chapter->title }}</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">
            Modul: {{ $chapter->module->title }}
        </p>
    </div>

    <!-- VIDEO -->
    @if ($chapter->video_url)
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Video Pembelajaran</h2>

            <div class="aspect-video w-full rounded-xl overflow-hidden bg-black">
                <iframe 
                    src="{{ str_replace('watch?v=', 'embed/', $chapter->video_url) }}"
                    class="w-full h-full"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    @endif

    <!-- CONTENT -->
    @if ($chapter->content)
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Materi</h2>
            <div class="prose dark:prose-invert max-w-none">
                {!! nl2br(e($chapter->content)) !!}
            </div>
        </div>
    @endif

    <!-- BUTTON NEXT -->
    <div class="flex justify-end mt-6">
        <form 
            action="{{ route('murid.modules.page.complete', [
                'chapter' => $chapter->id, 
                'page' => $page->page_number
            ]) }}" 
            method="POST"
        >
            @csrf
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                Tandai Selesai & Lanjut
            </button>
        </form>
    </div>

</div>

@endsection
