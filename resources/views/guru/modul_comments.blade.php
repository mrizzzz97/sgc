@extends('layouts.guru')

@section('title', 'Komentar Modul')

@section('content')

<div class="max-w-5xl mx-auto p-10">

    <h1 class="text-3xl font-bold text-white mb-6">
        Komentar Modul: {{ $module->title }}
    </h1>

    {{-- FORM TAMBAH KOMENTAR (GURU) --}}
    <div class="bg-gray-800 p-6 rounded-xl mb-10 shadow">
        <h3 class="text-xl font-semibold text-white mb-4">Tambahkan Komentar</h3>

        <form action="{{ route('modules.comment', $module->id) }}" method="POST">
            @csrf

            <textarea name="comment"
                class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-indigo-500 focus:outline-none"
                rows="3"
                placeholder="Tulis komentar sebagai Guru..."></textarea>

            <button class="mt-3 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                Kirim Komentar
            </button>
        </form>
    </div>

    {{-- LIST KOMENTAR --}}
    <div class="bg-gray-900 p-6 rounded-xl shadow-lg">

        <h2 class="text-xl font-semibold text-white mb-6">Semua Komentar</h2>

        <div class="space-y-6">
            @foreach ($module->comments->where('parent_id', null) as $comment)
                @include('components.comment-bubble', [
                    'comment' => $comment,
                    'module'  => $module
                ])
            @endforeach
        </div>

        @if ($module->comments->where('parent_id', null)->count() === 0)
            <div class="text-center py-10 text-gray-400">
                Belum ada komentar untuk modul ini.
            </div>
        @endif

    </div>

</div>

{{-- JS reply & toggle --}}
<script>
    function openReplyForm(id) {
        document.getElementById('reply-form-' + id).classList.toggle('hidden');
    }
    function toggleReplies(id) {
        const wrapper = document.getElementById('reply-wrapper-' + id);
        const text = document.getElementById('toggle-reply-text-' + id);
        const count = text.textContent.match(/\((\d+)\)/)[1];

        if (wrapper.classList.contains('hidden')) {
            wrapper.classList.remove('hidden');
            text.textContent = `Sembunyikan balasan (${count})`;
        } else {
            wrapper.classList.add('hidden');
            text.textContent = `Tampilkan balasan (${count})`;
        }
    }
</script>

@endsection
