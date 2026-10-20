<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $post->comments()->create([
            'body' => $request->body,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'コメントを投稿しました');
    }
}
