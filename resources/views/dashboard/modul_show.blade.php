    @extends('layouts.dashboard')

    @section('title', 'Detail Modul')

    @section('leaderboard_button')
    <a href="{{ route('murid.modules.leaderboard', $module->id) }}"
    class="flex items-center gap-3 px-4 py-3 rounded-xl text-yellow-500 font-semibold hover:bg-yellow-100 dark:hover:bg-gray-700">
        <i class="fas fa-trophy w-5"></i> Leaderboard
    </a>
    @endsection


    @section('content')
    <div class="max-w-4xl mx-auto">

        {{-- TITLE --}}
        <h1 class="text-2xl font-bold mb-6 dark:text-white">
            {{ $module->title }}
        </h1>

        <p class="text-gray-600 dark:text-gray-300 mb-6">
            {{ $module->description }}
        </p>

        {{-- LIST CHAPTER --}}
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Daftar Chapter
        </h2>

        <div class="space-y-3">
            @forelse ($module->chapters as $c)

                @php
                    // Ambil chapter sebelumnya
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
                class="flex justify-between items-center p-4 rounded-lg shadow 
                        {{ $canOpen 
                                ? 'bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700' 
                                : 'bg-gray-300 dark:bg-gray-700 opacity-50 cursor-not-allowed' 
                        }}">

                    <div>
                        <p class="font-semibold dark:text-white">{{ $c->title }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ $c->description }}</p>
                    </div>

                    {{-- CHECKLIST --}}
                    @if($result && $result->passed)
                        <span class="text-green-500 font-bold text-xl">✔</span>
                    @else
                        <span class="text-gray-400 font-bold text-xl">✖</span>
                    @endif

                </a>

            @empty
                <p class="text-gray-500 dark:text-gray-300">Belum ada chapter.</p>
            @endforelse
        </div>


        {{-- FORM TAMBAH KOMENTAR --}}
        <div class="bg-gray-800 p-6 rounded-xl mt-10">
            <h3 class="text-xl font-semibold mb-4 text-white">Tambahkan Komentar</h3>

            <form action="{{ route('modules.comment', $module->id) }}" method="POST">
                @csrf

                <textarea name="comment"
                    class="w-full p-3 rounded-lg bg-gray-700 text-white"
                    rows="3"
                    placeholder="Tulis komentar..."></textarea>

                <button class="mt-3 px-4 py-2 bg-indigo-600 rounded-lg text-white hover:bg-indigo-700">
                    Kirim Komentar
                </button>
            </form>
        </div>


        {{-- LIST KOMENTAR CHAT BUBBLE --}}
        <div class="bg-gray-800 p-6 rounded-xl mt-10">
            <h3 class="text-xl font-semibold mb-6 text-white">Komentar</h3>

            {{-- Komentar utama (parent_id null) --}}
            <div class="space-y-6">
                @foreach ($module->comments->where('parent_id', null)->sortBy('created_at') as $comment)
                    @include('components.comment-bubble', [
                        'comment' => $comment,
                        'module' => $module
                    ])
                @endforeach
            </div>
        </div>

    </div>

    

    {{-- JS untuk reply --}}
    <script>
        function openReplyForm(id) {
            document.getElementById('reply-form-' + id).classList.toggle('hidden');
        }

        function toggleReplies(id) {
            const wrapper = document.getElementById('reply-wrapper-' + id);
            const text = document.getElementById('toggle-reply-text-' + id);
            const count = text.textContent.match(/\((\d+)\)/)[1]; // ambil angka dalam ()

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
