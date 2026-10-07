<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿編集</title>
</head>
<body>
    <h1>投稿編集</h1>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label>タイトル</label><br>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
        </div>
        <div>
            <label>本文</label><br>
            <textarea name="body">{{ old('body', $post->body) }}</textarea>
        </div>
        
        <button type="submit">更新する</button>
    </form>
    
    <button type="button" onclick="location.href='{{ route('posts.index') }}'">戻る</button>
</body>
</html>