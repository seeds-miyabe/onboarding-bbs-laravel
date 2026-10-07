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

            <div style="margin-top: 10px;">
            <button type="button" onclick="location.href='{{ route('posts.edit', $post->id) }}'">編集</button>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
        </form>
        </div>
        <hr>
    @endforeach
</body>
</html>