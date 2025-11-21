<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Guru: Form create question
    public function create(Chapter $chapter)
    {
        return view('questions.create', compact('chapter'));
    }

    // Guru: Save question
    public function store(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:multiple_choice,essay',
            'choices' => $request->input('type') === 'multiple_choice' ? 'required|array|min:2' : 'nullable',
            'correct_answer' => $request->input('type') === 'multiple_choice' ? 'required|string' : 'nullable',
            'points' => 'required|integer|min:1|max:100',
            'order' => 'required|integer|min:1',
        ]);

        // For multiple choice, validate choices
        if ($validated['type'] === 'multiple_choice') {
            if (!in_array($validated['correct_answer'], (array)$validated['choices'])) {
                return back()->withErrors(['correct_answer' => 'Jawaban yang benar harus ada di pilihan'])->withInput();
            }
            $validated['choices'] = json_encode($validated['choices']);
        } else {
            $validated['choices'] = null;
            $validated['correct_answer'] = null;
        }

        $chapter->questions()->create($validated);
        return redirect()->route('modules.edit', $chapter->module)->with('success', 'Soal berhasil ditambahkan');
    }

    // Guru: Form edit question
    public function edit(Question $question)
    {
        $chapter = $question->chapter;
        $module = $chapter->module;
        $choices = $question->type === 'multiple_choice' ? json_decode($question->choices, true) : [];

        return view('questions.edit', compact('question', 'chapter', 'module', 'choices'));
    }

    // Guru: Update question
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:multiple_choice,essay',
            'choices' => $request->input('type') === 'multiple_choice' ? 'required|array|min:2' : 'nullable',
            'correct_answer' => $request->input('type') === 'multiple_choice' ? 'required|string' : 'nullable',
            'points' => 'required|integer|min:1|max:100',
            'order' => 'required|integer|min:1',
        ]);

        if ($validated['type'] === 'multiple_choice') {
            if (!in_array($validated['correct_answer'], (array)$validated['choices'])) {
                return back()->withErrors(['correct_answer' => 'Jawaban yang benar harus ada di pilihan'])->withInput();
            }
            $validated['choices'] = json_encode($validated['choices']);
        } else {
            $validated['choices'] = null;
            $validated['correct_answer'] = null;
        }

        $question->update($validated);
        return redirect()->route('modules.edit', $question->chapter->module)->with('success', 'Soal berhasil diubah');
    }

    // Guru: Delete question
    public function destroy(Question $question)
    {
        $chapter = $question->chapter;
        $question->delete();
        return redirect()->route('modules.edit', $chapter->module)->with('success', 'Soal berhasil dihapus');
    }
}
