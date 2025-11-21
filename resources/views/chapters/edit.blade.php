@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Chapter</h1>
                <p class="text-gray-600">{{ $module->title }}</p>
            </div>

            <!-- Form Edit Chapter -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <form action="{{ route('chapters.update', $chapter) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Chapter</label>
                        <input type="text" name="title" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('title', $chapter->title) }}">
                        @error('title')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" required rows="4"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $chapter->description) }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Video YouTube</label>
                        <input type="text" name="youtube_url" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('youtube_url', $chapter->youtube_url) }}">
                        @error('youtube_url')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <input type="number" name="order" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('order', $chapter->order) }}" min="1">
                        @error('order')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Update Chapter
                        </button>
                        <a href="{{ route('modules.edit', $module) }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Daftar Soal -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">📝 Soal Chapter</h2>
                    <a href="{{ route('questions.create', $chapter) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        + Tambah Soal
                    </a>
                </div>

                @if ($chapter->questions->count() > 0)
                    <div class="space-y-4">
                        @foreach ($chapter->questions as $index => $question)
                            <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-600">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Soal {{ $index + 1 }}. {{ $question->question_text }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">
                                            Tipe: <span class="font-semibold">{{ $question->type === 'multiple_choice' ? 'Pilihan Ganda' : 'Essay' }}</span> | 
                                            Poin: <span class="font-semibold">{{ $question->points }}</span>
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('questions.edit', $question) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('questions.destroy', $question) }}" method="POST" class="inline" onsubmit="return confirm('Hapus soal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                @if ($question->type === 'multiple_choice')
                                    <div class="text-sm text-gray-700 mt-3">
                                        <p class="font-semibold mb-2">Pilihan:</p>
                                        <ul class="list-disc list-inside space-y-1">
                                            @foreach ($question->choices as $choice)
                                                <li>{{ $choice }} {{ $choice === $question->correct_answer ? '✓ (Jawaban Benar)' : '' }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="text-sm text-gray-600 mt-2">Essay - Guru akan menilai jawaban siswa</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada soal di chapter ini. <a href="{{ route('questions.create', $chapter) }}" class="text-indigo-600 hover:underline">Tambahkan sekarang</a></p>
                @endif
            </div>

            <!-- Delete Chapter -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <p class="text-gray-700 mb-4">Hapus chapter ini beserta semua soal?</p>
                <form action="{{ route('chapters.destroy', $chapter) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus chapter ini? Semua soal akan dihapus!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Hapus Chapter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
