@extends('layouts.dashboard')

@section('title', 'Detail Modul')

{{-- Tombol leaderboard khusus modul ini di sidebar --}}
@section('leaderboard_button')
    <a href="{{ route('murid.modules.leaderboard', $module->id) }}"
       class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl
              {{ request()->routeIs('murid.modules.leaderboard') ? 'nav-active' : '' }}">
        <i class="fas fa-trophy w-5"></i>
        <span>Leaderboard Modul</span>
    </a>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8 space-y-8">

    {{-- HEADER MODUL --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                rounded-2xl p-6 md:p-7 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $module->title }}
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                {{ $module->description }}
            </p>
        </div>

        <div class="flex flex-col items-start md:items-end gap-2 text-sm">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                        bg-indigo-50 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-300">
                <i class="fas fa-layer-group text-xs"></i>
                <span>{{ $module->chapters->count() }} Chapter</span>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Terakhir diperbarui: {{ $module->updated_at->format('d M Y') }}
            </p>
        </div>
    </div>

    {{-- DAFTAR CHAPTER --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Daftar Chapter
            </h2>
        </div>

        <div class="space-y-3">
            @forelse ($module->chapters as $c)

                @php
                    // Chapter sebelumnya
                    $prev = $module->chapters
                        ->where('order', '<', $c->order)
                        ->sortByDesc('order')
                        ->first();

                    $canOpen = true;

                    if ($prev) {
                        $canOpen = \App\Models\ChapterResult::where('chapter_id', $prev->id)
                            ->where('user_id', auth()->id())
                            ->where('passed', true)
                            ->exists();
                    }

                    $result = \App\Models\ChapterResult::where('chapter_id', $c->id)
                        ->where('user_id', auth()->id())
                        ->first();
                @endphp

                <a href="{{ $canOpen ? route('murid.modules.chapter', $c->id) : '#' }}"
                   class="flex items-center justify-between gap-4 p-4 rounded-xl border
                          transition-all duration-200
                          {{ $canOpen
                                ? 'bg-gray-50 border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700'
                                : 'bg-gray-100/80 border-gray-200 dark:bg-gray-800/70 dark:border-gray-700 opacity-60 cursor-not-allowed pointer-events-none'
                          }}">

                    {{-- Kiri: judul + deskripsi --}}
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $c->title }}
                        </p>
                        @if($c->description)
                            <p class="mt-1 text-xs text-gray-600 dark:text-gray-300">
                                {{ $c->description }}
                            </p>
                        @endif
                    </div>

                    {{-- Kanan: status --}}
                    <div class="flex items-center gap-3">

                        {{-- Status lulus / belum --}}
                        @if($result && $result->passed)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                                         bg-green-100 text-green-700 text-xs font-medium
                                         dark:bg-green-900/30 dark:text-green-300">
                                <i class="fas fa-circle-check text-xs"></i>
                                Selesai
                            </span>
                        @elseif($canOpen)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                                         bg-blue-100 text-blue-700 text-xs font-medium
                                         dark:bg-blue-900/30 dark:text-blue-300">
                                <i class="fas fa-play text-xs"></i>
                                Siap dikerjakan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                                         bg-gray-200 text-gray-600 text-xs font-medium
                                         dark:bg-gray-700 dark:text-gray-300">
                                <i class="fas fa-lock text-xs"></i>
                                Terkunci
                            </span>
                        @endif>

                    </div>
                </a>

            @empty
                <p class="text-sm text-gray-500 dark:text-gray-300">
                    Belum ada chapter pada modul ini.
                </p>
            @endforelse
        </div>
    </div>

    {{-- FORM KOMENTAR --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                rounded-2xl p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
            Tambahkan Komentar
        </h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
            Komentar Anda akan terlihat oleh guru dan murid lain yang mengikuti modul ini.
        </p>

        <form action="{{ route('modules.comment', $module->id) }}" method="POST" class="space-y-3">
            @csrf

            <textarea name="comment"
                      class="w-full p-3 rounded-xl bg-gray-50 dark:bg-gray-900
                             border border-gray-200 dark:border-gray-700
                             text-sm text-gray-900 dark:text-white
                             focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      rows="3"
                      placeholder="Tulis komentar Anda di sini..."></textarea>

            <button type="submit"
                    class="inline-flex items-center justify-center px-4 py-2.5
                           rounded-xl bg-indigo-600 text-white text-sm font-medium
                           hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Kirim
            </button>
        </form>
    </div>

    {{-- LIST KOMENTAR --}}
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                rounded-2xl p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
            Komentar
        </h3>

        <div class="space-y-5">
            @forelse ($module->comments->where('parent_id', null)->sortBy('created_at') as $comment)
                @include('components.comment-bubble', [
                    'comment' => $comment,
                    'module'  => $module
                ])
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Belum ada komentar pada modul ini.
                </p>
            @endforelse
        </div>
    </div>

</div>

{{-- JS untuk reply dan toggle balasan --}}
<script>
    function openReplyForm(id) {
        const el = document.getElementById('reply-form-' + id);
        if (el) el.classList.toggle('hidden');
    }

    function toggleReplies(id) {
        const wrapper = document.getElementById('reply-wrapper-' + id);
        const text = document.getElementById('toggle-reply-text-' + id);

        if (!wrapper || !text) return;

        const match = text.textContent.match(/\((\d+)\)/);
        const count = match ? match[1] : '';

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
