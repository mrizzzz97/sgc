@extends('layouts.dashboard')

@section('title', 'Detail Modul')

@section('content')
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 dark:text-white">
        {{ $module->title }}
    </h1>

    <p class="text-gray-600 dark:text-gray-300 mb-6">
        {{ $module->description }}
    </p>

    <h2 class="text-xl font-semibold mb-4 dark:text-white">
        Daftar Chapter
    </h2>

    <div class="space-y-3">
        @forelse ($module->chapters as $c)
            <a href="{{ route('murid.modules.page', ['chapter' => $c->id, 'page' => 1]) }}"
               class="block p-4 rounded-lg bg-white dark:bg-gray-800 shadow hover:bg-gray-50 dark:hover:bg-gray-700">
                <p class="font-semibold dark:text-white">{{ $c->title }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $c->description }}</p>
            </a>
        @empty
            <p class="text-gray-500 dark:text-gray-300">Belum ada chapter.</p>
        @endforelse
    </div>

</div>
@endsection
