@extends('layouts.guru')

@section('title', 'Notifikasi')

@section('content')

<div class="max-w-3xl mx-auto mt-10">

    <h1 class="text-2xl font-bold mb-6 dark:text-white">
        Notifikasi Modul
    </h1>

    {{-- CLEAR ALL --}}
    <div class="flex justify-end mb-4">
        @if($notifs->count() > 0)
            <form action="{{ route('guru.notif.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg">
                    Hapus Semua Notifikasi
                </button>
            </form>
        @endif
    </div>

    <div class="space-y-4">

        @forelse($notifs as $n)
            <div class="p-4 rounded-lg 
                {{ $n->read ? 'bg-gray-700' : 'bg-indigo-600' }}
                text-white flex justify-between items-center">

                <div>
                    <p class="font-semibold">{{ $n->message }}</p>
                    <p class="text-xs text-gray-200 mt-1">
                        {{ $n->created_at->diffForHumans() }}
                    </p>
                </div>

                @if(!$n->read)
                    <form action="{{ route('guru.notif.read', $n->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="px-3 py-1 bg-white text-indigo-600 rounded text-xs">
                            Tandai Dibaca
                        </button>
                    </form>
                @endif

            </div>

        @empty
            <p class="text-gray-400 text-center py-10">
                Belum ada notifikasi.
            </p>
        @endforelse

    </div>

</div>

@endsection
