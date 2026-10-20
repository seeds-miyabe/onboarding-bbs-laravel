<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
</head>
<body>
    <h1>投稿一覧</h1>
    @if (session('success'))
        <div style="color: green; background-color: #e6ffe6; padding: 10px; border: 1px solid green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif
    <button type="button" onclick="location.href='{{ route('posts.create') }}'">新規投稿</button>
    <hr>
    @foreach ($posts as $post)
        <div>
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>
            <small>{{ $post->created_at }}</small>

            <div style="margin-top: 15px; background-color: #f9f9f9; padding: 10px;">
                <h4>コメント ({{ $post->comments->count() }}件)</h4>

                @foreach ($post->comments->whereNull('parent_id') as $comment)
                    @include('posts.comment', ['comment' => $comment, 'post' => $post])
                @endforeach

                <hr>
                <!-- 投稿そのものへの通常のコメント投稿フォーム -->
                <form action="{{ route('comments.store', $post->id) }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <input type="text" name="body" placeholder="新しいコメントを入力..." required>
                    <button type="submit">送信</button>
                </form>
            </div>
        </div>
        <hr>
    @endforeach
</body>
</html>