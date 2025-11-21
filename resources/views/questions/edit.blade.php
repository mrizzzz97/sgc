@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Soal</h1>
                <p class="text-gray-600 mb-6">Chapter: {{ $chapter->title }}</p>

                <form action="{{ route('questions.update', $question) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teks Soal</label>
                        <textarea name="question_text" required rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('question_text', $question->question_text) }}</textarea>
                        @error('question_text')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Soal</label>
                        <select name="type" id="questionType" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                onchange="toggleQuestionType()">
                            <option value="multiple_choice" {{ old('type', $question->type) === 'multiple_choice' ? 'selected' : '' }}>Pilihan Ganda</option>
                            <option value="essay" {{ old('type', $question->type) === 'essay' ? 'selected' : '' }}>Essay</option>
                        </select>
                        @error('type')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Multiple Choice Section -->
                    <div id="multipleChoiceSection" class="hidden mb-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban</label>
                            <div id="choicesContainer" class="space-y-3">
                                @foreach ($choices as $idx => $choice)
                                    <div class="flex gap-2">
                                        <input type="text" name="choices[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2"
                                               value="{{ $choice }}" placeholder="Pilihan {{ $idx + 1 }}">
                                        <input type="radio" name="correct_answer" value="{{ $choice }}" class="mt-3" 
                                               {{ $question->correct_answer === $choice ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-600 mt-3">Benar</span>
                                    </div>
                                @endforeach
                            </div>
                            @error('correct_answer')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                        <input type="number" name="points" required min="1" max="100"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('points', $question->points) }}">
                        @error('points')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <input type="number" name="order" required min="1"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('order', $question->order) }}">
                        @error('order')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Update Soal
                        </button>
                        <a href="{{ route('modules.edit', $module) }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                            Batal
                        </a>
                    </div>
                </form>

                <!-- Delete Question -->
                <div class="mt-12 border-t pt-8">
                    <form action="{{ route('questions.destroy', $question) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus soal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            Hapus Soal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleQuestionType() {
    const type = document.getElementById('questionType').value;
    const mcSection = document.getElementById('multipleChoiceSection');
    if (type === 'multiple_choice') {
        mcSection.classList.remove('hidden');
    } else {
        mcSection.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleQuestionType();
    const choiceInputs = document.querySelectorAll('#choicesContainer input[type="text"]');
    const radios = document.querySelectorAll('#choicesContainer input[type="radio"]');
    choiceInputs.forEach((input, idx) => {
        input.addEventListener('input', () => {
            radios[idx].value = input.value;
        });
    });
});
</script>
@endsection
