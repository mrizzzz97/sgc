@extends('layouts.dashboard')

@section('title', 'Chapter')

@section('content')
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-4 dark:text-white">
        {{ $chapter->title }}
    </h1>

    <p class="text-gray-600 dark:text-gray-300 mb-4">
        {{ $chapter->description }}
    </p>

    {{-- VIDEO (opsional) --}}
    @if ($chapter->video_url)
        <div class="mb-6">
            <iframe width="100%" height="350"
                    src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($chapter->video_url, 'v=') }}"
                    class="rounded-xl shadow">
            </iframe>
        </div>
    @endif

    {{-- CONTENT --}}
    <div class="prose dark:prose-invert mb-10">
        {!! nl2br(e($chapter->content)) !!}
    </div>

    {{-- TOMBOL COMPLETE --}}
    <form action="{{ route('modules.chapter.complete', $chapter->id) }}" method="POST">
        @csrf
        <button class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
            Tandai Selesai
        </button>
    </form>

</div>
@endsection
