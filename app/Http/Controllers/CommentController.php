<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'chapter_id' => $chapter->id,
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $chapter = $comment->chapter;
        $comment->delete();

        return back()->with('success', 'Komentar dihapus!');
    }
}
