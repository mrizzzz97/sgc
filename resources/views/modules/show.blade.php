@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Module Header -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $module->icon }} {{ $module->title }}</h1>
                        <p class="text-gray-600 text-lg">{{ $module->description }}</p>
                    </div>
                    <a href="{{ route('modules.index') }}" class="text-indigo-600 hover:underline">← Kembali</a>
                </div>
            </div>

            <!-- Chapters Tabs -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Chapters List -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-20">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-4 py-3">
                            <h3 class="text-white font-bold">Daftar Bab</h3>
                        </div>
                        <div class="divide-y max-h-96 overflow-y-auto">
                            @foreach ($module->chapters as $index => $chapter)
                                <a href="#chapter-{{ $chapter->id }}" class="block px-4 py-3 hover:bg-indigo-50 transition border-l-4 border-transparent hover:border-indigo-600">
                                    <div class="text-sm font-medium text-gray-900">Bab {{ $index + 1 }}: {{ $chapter->title }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Guru Info -->
                    @if ($enrollment && $enrollment->teacher)
                        <div class="bg-white rounded-lg shadow-md p-4 mt-6">
                            <h4 class="font-bold text-gray-900 mb-2">Guru Pembimbing</h4>
                            <div class="text-sm text-gray-600">{{ $enrollment->teacher->name }}</div>
                            <div class="text-xs text-gray-500">{{ $enrollment->teacher->email }}</div>
                        </div>
                    @endif
                </div>

                <!-- Chapters Content -->
                <div class="lg:col-span-3 space-y-8">
                    @foreach ($module->chapters as $chapter)
                        <div id="chapter-{{ $chapter->id }}" class="bg-white rounded-lg shadow-md p-8 scroll-mt-20">
                            <!-- Chapter Header -->
                            <div class="mb-6">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $chapter->title }}</h2>
                                <p class="text-gray-600">{{ $chapter->description }}</p>
                            </div>

                            <!-- YouTube Video -->
                            <div class="mb-8">
                                <h3 class="text-lg font-bold text-gray-900 mb-3">📹 Video Pembelajaran</h3>
                                <div class="relative pb-56.25% h-0 overflow-hidden bg-gray-900 rounded-lg">
                                    <iframe class="absolute top-0 left-0 w-full h-96 rounded-lg" 
                                            src="{{ $chapter->youtube_url }}" 
                                            frameborder="0" 
                                            allowfullscreen>
                                    </iframe>
                                </div>
                            </div>

                            <!-- Questions -->
                            @if ($chapter->questions->count() > 0)
                                <div class="mb-8">
                                    <h3 class="text-lg font-bold text-gray-900 mb-4">📝 Soal Latihan (KKM: 75)</h3>
                                    <div class="space-y-6">
                                        @foreach ($chapter->questions as $questionIndex => $question)
                                            <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-indigo-600">
                                                <div class="flex justify-between items-start mb-3">
                                                    <h4 class="font-semibold text-gray-900">Soal {{ $questionIndex + 1 }}</h4>
                                                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $question->points }} XP</span>
                                                </div>
                                                
                                                <p class="text-gray-700 mb-4">{{ $question->question_text }}</p>

                                                @if ($question->type === 'multiple_choice')
                                                    <div class="space-y-2">
                                                        @php
                                                            $choices = is_string($question->choices) ? json_decode($question->choices, true) : $question->choices;
                                                        @endphp
                                                        @foreach ($choices ?? [] as $choice)
                                                            <label class="flex items-center cursor-pointer">
                                                                <input type="radio" name="answer[{{ $question->id }}]" value="{{ $choice }}" class="mr-3">
                                                                <span class="text-gray-700">{{ $choice }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <textarea name="answer[{{ $question->id }}]" 
                                                              placeholder="Jawab dengan jelas..."
                                                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                              rows="4"></textarea>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <button onclick="submitAnswers({{ $chapter->id }})" class="mt-6 w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 font-semibold transition">
                                        Kirim Jawaban
                                    </button>
                                </div>
                            @endif

                            <!-- Comments Section -->
                            <div class="border-t pt-8">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">💬 Diskusi</h3>
                                
                                <!-- Post Comment Form -->
                                <form action="{{ route('comments.store', $chapter) }}" method="POST" class="mb-6">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="content" 
                                                  placeholder="Tulis pertanyaan atau komentar Anda..." 
                                                  required
                                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                  rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                                        Kirim Komentar
                                    </button>
                                </form>

                                <!-- Comments List -->
                                <div class="space-y-4">
                                    @forelse ($chapter->comments->where('parent_id', null) as $comment)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex justify-between items-start mb-2">
                                                <div class="font-semibold text-gray-900">{{ $comment->user->name }}</div>
                                                <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="text-gray-700 mb-3">{{ $comment->content }}</p>

                                            <!-- Replies -->
                                            @if ($comment->replies->count() > 0)
                                                <div class="ml-6 mt-4 space-y-3 border-l-2 border-gray-300 pl-4">
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="bg-white p-3 rounded">
                                                            <div class="flex justify-between items-start mb-1">
                                                                <div class="font-semibold text-sm text-gray-900">{{ $reply->user->name }}</div>
                                                                <small class="text-gray-500 text-xs">{{ $reply->created_at->diffForHumans() }}</small>
                                                            </div>
                                                            <p class="text-sm text-gray-700">{{ $reply->content }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if (Auth::id() === $comment->user_id)
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                                                </form>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama!</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Certificate Button -->
                    <div class="bg-white rounded-lg shadow-md p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">🎓 Selesaikan Modul</h3>
                        <p class="text-gray-600 mb-6">Apakah Anda sudah menyelesaikan semua materi dan soal? Dapatkan sertifikat Anda sekarang!</p>
                        <button onclick="openCertificateModal({{ $module->id }})" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-3 rounded-lg hover:from-green-600 hover:to-emerald-700 font-bold text-lg transition">
                            Ambil Sertifikat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Certificate Modal -->
<div id="certificateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold mb-4">🎓 Ambil Sertifikat</h3>
        
        <form id="certificateForm" method="POST" action="">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap (untuk sertifikat):</label>
                <input type="text" name="full_name" required 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                       placeholder="Masukkan nama lengkap Anda">
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeCertificateModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Ambil Sertifikat
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCertificateModal(moduleId) {
    document.getElementById('certificateForm').action = `/modules/${moduleId}/certificate`;
    document.getElementById('certificateModal').classList.remove('hidden');
}

function closeCertificateModal() {
    document.getElementById('certificateModal').classList.add('hidden');
}

function submitAnswers(chapterId) {
    const answers = {};
    let hasAnswers = false;
    
    document.querySelectorAll(`input[name^="answer"], textarea[name^="answer"]`).forEach(input => {
        const key = input.name.replace('answer[', '').replace(']', '');
        if (input.type === 'radio') {
            if (input.checked) {
                answers[key] = input.value;
                hasAnswers = true;
            }
        } else if (input.value.trim()) {
            answers[key] = input.value;
            hasAnswers = true;
        }
    });

    if (!hasAnswers) {
        alert('⚠️ Silakan jawab minimal satu soal');
        return;
    }

    fetch(`/chapters/${chapterId}/answer`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ answers })
    })
    .then(async res => {
        const text = await res.text();
        try {
            return JSON.parse(text);
        } catch (e) {
            console.error('Response text:', text);
            throw new Error('Invalid JSON response: ' + text.substring(0, 200));
        }
    })
    .then(data => {
        if (data.success) {
            alert(`✅ Jawaban disimpan!\n+${data.xp} XP\nTotal XP: ${data.totalXp}`);
        } else if (data.error) {
            alert('❌ Error: ' + data.error);
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('❌ Error: ' + err.message);
    });
}

document.getElementById('certificateModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCertificateModal();
    }
});
</script>
@endsection
