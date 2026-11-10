<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        $post->comments()->create([
            'user_id'   => auth()->id(),
            'parent_id' => $request->validated('parent_id'),
            'body'      => $request->validated('body'),
        ]);

        return redirect()->back()->with('success', 'コメントを投稿しました');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'コメントを更新しました！');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back()->with('success', 'コメントを削除しました！');
    }
}
