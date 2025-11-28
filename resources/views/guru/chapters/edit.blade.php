@extends('layouts.guru')

@section('title', 'Edit Chapter')

@section('content')

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-3xl font-bold text-white mb-6">
        Edit Chapter : {{ $chapter->title }}
    </h1>

    <form action="{{ route('guru.modul.chapter.update', $chapter->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="text-white">Judul Chapter</label>
            <input type="text" name="title"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   value="{{ $chapter->title }}" required>
        </div>

        <div class="mb-4">
            <label class="text-white">Deskripsi</label>
            <textarea name="description"
                      class="w-full p-2 rounded bg-gray-700 text-white"
                      rows="3">{{ $chapter->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="text-white">Konten</label>
            <textarea name="content"
                      class="w-full p-3 rounded bg-gray-700 text-white"
                      rows="4">{{ $chapter->content }}</textarea>
        </div>

        <div class="mb-4">
            <label class="text-white">URL Video (opsional)</label>
            <input type="text" name="video_url"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   value="{{ $chapter->video_url }}">
        </div>

        <div class="mb-4">
            <label class="text-white">Urutan Chapter</label>
            <input type="number" name="order"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   value="{{ $chapter->order }}" required>
        </div>

        <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg">
            Simpan Perubahan
        </button>

    </form>

</div>

@endsection
