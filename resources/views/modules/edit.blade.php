@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Modul</h1>

                <form action="{{ route('modules.update', $module) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Modul</label>
                        <input type="text" name="title" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('title', $module->title) }}">
                        @error('title')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" required rows="4"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $module->description) }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Icon (Emoji)</label>
                        <input type="text" name="icon" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('icon', $module->icon) }}">
                        @error('icon')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <input type="number" name="order" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('order', $module->order) }}" min="1">
                        @error('order')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Update Modul
                        </button>
                        <a href="{{ route('modules.teach') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                            Batal
                        </a>
                    </div>
                </form>

                <!-- Chapters Section -->
                <div class="mt-12 border-t pt-12">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Daftar Chapter</h2>
                        <a href="{{ route('chapters.create', $module) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            + Tambah Chapter
                        </a>
                    </div>

                    @if ($module->chapters->count() > 0)
                        <div class="space-y-4">
                            @foreach ($module->chapters as $chapter)
                                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $chapter->title }}</h3>
                                            <p class="text-gray-600 text-sm mt-1">{{ $chapter->description }}</p>
                                            <p class="text-gray-500 text-xs mt-2">🎥 {{ $chapter->youtube_url }}</p>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('chapters.edit', $chapter) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold">
                                                Edit
                                            </a>
                                            <form action="{{ route('chapters.destroy', $chapter) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus chapter ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-semibold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Questions list -->
                                    <div class="mt-4 bg-white p-4 rounded border border-gray-300">
                                        <div class="flex justify-between items-center mb-3">
                                            <p class="font-semibold text-gray-700">Soal ({{ $chapter->questions->count() }})</p>
                                            <a href="{{ route('questions.create', $chapter) }}" class="text-green-600 hover:text-green-900 text-sm font-semibold">
                                                + Tambah Soal
                                            </a>
                                        </div>

                                        @if ($chapter->questions->count() > 0)
                                            <div class="space-y-2">
                                                @foreach ($chapter->questions as $question)
                                                    <div class="flex justify-between items-start text-sm">
                                                        <div>
                                                            <p class="font-medium text-gray-800">{{ $question->question_text }}</p>
                                                            <p class="text-gray-500">Tipe: {{ ucfirst(str_replace('_', ' ', $question->type)) }} | {{ $question->points }} poin</p>
                                                        </div>
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('questions.edit', $question) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                            <form action="{{ route('questions.destroy', $question) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus soal ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-gray-500 text-sm">Belum ada soal di chapter ini</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada chapter di modul ini</p>
                    @endif
                </div>

                <!-- Delete Module -->
                <div class="mt-12 border-t pt-8">
                    <form action="{{ route('modules.destroy', $module) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus modul ini? Data chapter dan soal akan dihapus!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            Hapus Modul
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
