@php
    $isGuru = $comment->user->role === 'guru';
    $auth = auth()->user();
    $replyCount = $comment->replies->count();
@endphp

<div class="flex {{ $isGuru ? 'justify-end' : '' }}">

    <div class="flex gap-3 max-w-xl {{ $isGuru ? 'flex-row-reverse' : '' }}">

        {{-- FOTO PROFIL --}}
        <img src="{{ $comment->user->profile_photo 
            ? asset('storage/' . $comment->user->profile_photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
            class="w-10 h-10 rounded-full object-cover">

        {{-- BUBBLE --}}
        <div class="p-4 rounded-2xl shadow
            {{ $isGuru ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-white' }}"
            style="max-width: 80%;">

            {{-- Nama + Badge Guru --}}
            <div class="flex items-center gap-2 mb-1">
                <p class="font-semibold text-sm">{{ $comment->user->name }}</p>

                @if ($isGuru)
                    <span class="px-2 py-0.5 bg-white text-indigo-600 text-[10px] rounded">
                        Guru
                    </span>
                @endif
            </div>

            {{-- Isi Komentar --}}
            <p class="text-sm leading-relaxed">
                {{ $comment->comment }}
            </p>

            {{-- Waktu --}}
            <div class="text-[10px] text-gray-300 mt-1">
                {{ $comment->created_at->diffForHumans() }}
            </div>

            {{-- TOMBOL BALAS --}}
            <button onclick="openReplyForm({{ $comment->id }})"
                class="text-xs text-blue-300 hover:text-blue-400 mt-2">
                Balas
            </button>

            {{-- TOMBOL HAPUS --}}
            @if ($auth->id === $comment->user_id || $auth->role === 'guru')
                <form action="{{ route('modules.comment.delete', $comment->id) }}"
                      method="POST"
                      class="inline-block ml-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-xs text-red-300 hover:text-red-500"
                        onclick="return confirm('Hapus komentar ini?')">
                        Hapus
                    </button>
                </form>
            @endif

            {{-- FORM BALAS --}}
            <div id="reply-form-{{ $comment->id }}" class="hidden mt-3">
                <form action="{{ route('modules.comment', $module->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                    <textarea name="comment"
                        class="w-full p-2 bg-gray-600 text-sm text-white rounded"
                        rows="2"
                        placeholder="Balas komentar..."></textarea>

                    <button
                        class="mt-2 px-3 py-1 bg-blue-500 hover:bg-blue-600 rounded text-xs text-white">
                        Kirim
                    </button>
                </form>
            </div>

            {{-- TOGGLE REPLIES (DEFAULT HIDDEN) --}}
            @if ($replyCount > 0)
                <button onclick="toggleReplies({{ $comment->id }})"
                    class="text-xs text-gray-300 hover:text-white mt-3 block">
                    <span id="toggle-reply-text-{{ $comment->id }}">
                        Tampilkan balasan ({{ $replyCount }})
                    </span>
                </button>
            @endif

            {{-- WRAPPER REPLIES --}}
            <div id="reply-wrapper-{{ $comment->id }}" class="mt-4 space-y-4 hidden">

                @foreach ($comment->replies as $reply)
                    <div class="ml-6">
                        @include('components.comment-bubble', [
                            'comment' => $reply,
                            'module' => $module
                        ])
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</div>
