@extends('layouts.guru')

@section('title', 'Daftar Chapter')

@section('content')

<div class="max-w-5xl mx-auto p-10">

    <h1 class="text-3xl font-bold dark:text-white mb-6">
        Chapter Modul: {{ $module->title }}
    </h1>

    <a href="{{ route('guru.modul.chapter.create', $module->id) }}"
       class="px-5 py-3 bg-indigo-600 text-white rounded-lg mb-6 inline-block">
        + Tambah Chapter
    </a>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        @if($module->chapters->isEmpty())
            <p class="text-gray-500 dark:text-gray-300">Belum terdapat chapter.</p>
        @else
            <div class="space-y-4">
                @foreach($module->chapters as $c)
                    <div class="p-4 border dark:border-gray-700 rounded-lg flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-bold dark:text-white">
                                {{ $c->order }}. {{ $c->title }}
                            </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                {{ Str::limit(strip_tags($c->description), 100) }}
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('guru.modul.chapter.edit', $c->id) }}"
                               class="px-3 py-2 bg-gray-600 text-white rounded-lg text-sm">
                                Edit
                            </a>

                            <a href="{{ route('guru.modul.chapter.pages.index', $c->id) }}"
                               class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">
                                Kelola Halaman
                            </a>

                            <form action="{{ route('guru.modul.chapter.delete', $c->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus chapter ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@endsection
