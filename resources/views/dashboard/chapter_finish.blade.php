@extends('layouts.dashboard')

@section('title', 'Chapter Selesai')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-4 dark:text-white">
        Chapter Selesai 🎉
    </h1>

    <p class="mb-2 dark:text-gray-300 text-gray-700">
        <strong>Chapter:</strong> {{ $chapter->title }}
    </p>

    <p class="mb-6 dark:text-gray-300 text-gray-700">
        <strong>Modul:</strong> {{ $module->title }}
    </p>

    <a href="{{ route('murid.modules.show', $module->id) }}"
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Kembali ke Modul
    </a>

</div>
@endsection
