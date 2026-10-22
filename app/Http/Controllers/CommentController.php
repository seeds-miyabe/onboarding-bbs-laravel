<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body'      => 'required|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $post->comments()->create([
            'user_id'   => auth()->id(),
            'parent_id' => $request->parent_id,
            'body'      => $request->body,
        ]);

        return redirect()->back()->with('success', 'コメントを投稿しました');
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required|max:1000',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index')->with('success', 'コメントを更新しました！');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'コメントを削除しました！');
    }
}
