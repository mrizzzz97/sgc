<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterPage;
use Illuminate\Http\Request;

class ChapterPageController extends Controller
{
    // LIST PAGE
    public function index(Chapter $chapter)
    {
        $pages = $chapter->pages()->orderBy('page_number')->get();
        return view('guru.chapters.pages.index', compact('chapter', 'pages'));
    }

    // FORM CREATE PAGE
    public function create(Chapter $chapter)
    {
        return view('guru.chapters.pages.create', compact('chapter'));
    }

    // STORE PAGE
    public function store(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'page_number'   => 'required|integer|min:1',
            'type'          => 'required|in:video,question',
            'video_url'     => 'nullable|string',
            'question_text' => 'nullable|string',
            'options'       => 'nullable',
            'correct_answer'=> 'nullable|string',
        ]);

        $validated['chapter_id'] = $chapter->id;

        ChapterPage::create($validated);

        return redirect()
            ->route('guru.modul.chapter.pages.index', $chapter->id)
            ->with('success', 'Halaman berhasil ditambahkan.');
    }

    // EDIT PAGE
    public function edit(Chapter $chapter, ChapterPage $page)
    {
        return view('guru.chapters.pages.edit', [
            'chapter' => $chapter,
            'page' => $page
        ]);
    }

    // UPDATE PAGE
    public function update(Request $request, Chapter $chapter, ChapterPage $page)
    {
        $data = $request->validate([
            'page_number'   => 'required|integer|min:1',
            'type'          => 'required|in:video,question',
            'video_url'     => 'nullable|string',
            'question_text' => 'nullable|string',
            'options'       => 'nullable',
            'correct_answer'=> 'nullable|string',
        ]);

        $page->update($data);

        return redirect()
            ->route('guru.modul.chapter.pages.index', $chapter->id)
            ->with('success', 'Halaman berhasil diperbarui!');
    }

    // DELETE PAGE
    public function destroy(Chapter $chapter, ChapterPage $page)
    {
        $page->delete();

        return redirect()
            ->route('guru.modul.chapter.pages.index', $chapter->id)
            ->with('success', 'Halaman berhasil dihapus.');
    }
}
