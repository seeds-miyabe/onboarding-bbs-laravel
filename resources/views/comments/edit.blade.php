<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>コメント編集</title>
</head>
<body>
    <h1>コメント編集</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>コメント本文</label><br>
            <textarea name="body" rows="4" cols="50">{{ old('body', $comment->body) }}</textarea>
        </div>

        <div style="margin-top: 10px; display: flex; gap: 8px;">
            <button type="button" onclick="location.href='{{ route('posts.index') }}'">一覧へ戻る</button>
            <button type="submit">更新する</button>
        </div>
    </form>
</body>
</html>