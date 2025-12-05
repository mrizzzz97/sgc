@extends('layouts.guru')

@section('title', 'Notifikasi')

@section('content')

<div class="max-w-4xl mx-auto mt-10 animate-fade-in">

    {{-- TITLE --}}
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-indigo-500 to-purple-500 text-transparent bg-clip-text">
            Notifikasi Modul
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Semua aktivitas dan pemberitahuan terbaru akan muncul di sini.
        </p>
    </div>

    {{-- CLEAR ALL --}}
    @if($notifs->count() > 0)
    <div class="flex justify-end mb-5">
        <form action="{{ route('guru.notif.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button 
                class="px-4 py-2 text-sm font-semibold text-white rounded-lg 
                       bg-red-600 hover:bg-red-700 shadow-md hover:shadow-lg
                       transition-all duration-200">
                Hapus Semua Notifikasi
            </button>
        </form>
    </div>
    @endif

    {{-- LIST NOTIFICATIONS --}}
    <div class="space-y-4">

        @forelse ($notifs as $n)

        <div 
            class="
                p-5 rounded-xl shadow-md border transition-all duration-200 hover:-translate-y-1 
                {{ $n->read 
                    ? 'bg-gray-100 dark:bg-gray-800 border-gray-300 dark:border-gray-700' 
                    : 'bg-indigo-600 border-indigo-700 text-white shadow-lg hover:shadow-2xl' 
                }}
            ">

            <div class="flex justify-between items-start">

                {{-- MESSAGE --}}
                <div class="max-w-[75%]">
                    <p class="font-semibold text-lg 
                        {{ $n->read ? 'text-gray-900 dark:text-gray-100' : 'text-white' }}">
                        {{ $n->message }}
                    </p>

                    <p class="text-xs mt-2 
                        {{ $n->read ? 'text-gray-500 dark:text-gray-400' : 'text-indigo-200' }}">
                        {{ $n->created_at->diffForHumans() }}
                    </p>
                </div>

                {{-- BUTTON READ --}}
                @if(!$n->read)
                <form action="{{ route('guru.notif.read', $n->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button 
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold 
                               bg-white text-indigo-600 hover:bg-gray-100
                               shadow hover:shadow-md transition-all duration-200">
                        Tandai Dibaca
                    </button>
                </form>
                @endif

            </div>

        </div>

        @empty

        {{-- IF EMPTY --}}
        <div class="text-center py-20">
            <div 
                class="w-16 h-16 mx-auto rounded-full bg-gray-200 dark:bg-gray-700 
                       flex items-center justify-center mb-4">
                <i class="fas fa-bell-slash text-gray-500 dark:text-gray-300 text-2xl"></i>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">
                Belum ada notifikasi.
            </p>
        </div>

        @endforelse

    </div>

</div>

@endsection
