<div style="margin-top: 10px; margin-left: 20px; border-left: 2px solid #ccc; padding-left: 10px;">
    
    <p style="margin: 0; font-weight: bold;">
        {{ $comment->body }} 
        <small style="font-weight: normal; color: #666;">({{ $comment->created_at }})</small>
    </p>

    <div style="margin-top: 4px; display: flex; gap: 6px;">
        <button type="button" onclick="location.href='{{ route('comments.edit', $comment->id) }}'" style="font-size: 11px;">編集</button>

        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('本当にこのコメントを削除しますか？')" style="font-size: 11px;">削除</button>
        </form>
    </div>

    <form action="{{ route('comments.store', $post->id) }}" method="POST" style="margin-top: 6px; margin-bottom: 10px;">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <input type="text" name="body" required style="font-size: 12px;">
        <button type="submit" style="font-size: 12px;">返信</button>
    </form>

    @foreach ($comment->replies as $reply)
        @include('posts.comment', ['comment' => $reply, 'post' => $post])
    @endforeach

</div>