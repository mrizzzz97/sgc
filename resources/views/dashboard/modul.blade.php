@extends('layouts.dashboard')

@section('content')
<div class="px-6 py-10 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 dark:text-white">📚 Modul Pembelajaran</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($modules as $m)
            <a href="{{ route('murid.modules.show', $m->id) }}"
               class="p-5 rounded-xl bg-white dark:bg-gray-800 shadow hover:shadow-lg transition">

                <h2 class="text-xl font-semibold dark:text-white">{{ $m->title }}</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">{{ $m->description }}</p>

            </a>
        @endforeach
    </div>
</div>
@endsection
