<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規投稿</title>
</head>
<body>
    <h1>新規投稿</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label>タイトル</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label>本文</label><br>
            <textarea name="body">{{ old('body') }}</textarea>
        </div>
        <button type="button" onclick="location.href='{{ route('posts.index') }}'">戻る</button>
        <button type="submit">投稿する</button>
    </form>
</body>
</html>