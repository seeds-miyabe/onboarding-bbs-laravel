<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0;">投稿一覧</h1>

        <div>
            @auth
                <span>ようこそ、<strong>{{ Auth::user()->name }}</strong> さん</span>

                <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 10px;">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" style="margin-right: 10px;">ログイン</a>
                <a href="{{ route('register') }}">会員登録</a>
            @endguest
        </div>
    </div>

    @if (session('success'))
        <div style="color: green; background-color: #e6ffe6; padding: 10px; border: 1px solid green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    @auth
        <button type="button" onclick="location.href='{{ route('posts.create') }}'">新規投稿</button>
    @endauth

    <hr>

    @foreach ($posts as $post)
        <div>
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>

            <small>投稿者: {{ $post->user->name ?? '名無し' }} ｜ {{ $post->created_at }}</small>
            @auth
                @if (Auth::id() === $post->user_id)
                    <div style="margin-top: 10px;">
                        <button type="button" onclick="location.href='{{ route('posts.edit', $post->id) }}'">編集</button>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </div>
                @endif
            @endauth
            <div style="margin-top: 15px; background-color: #f9f9f9; padding: 10px;">
                <h4>コメント ({{ $post->comments->count() }}件)</h4>

                @foreach ($post->comments->whereNull('parent_id') as $comment)
                    @include('posts.comment', ['comment' => $comment, 'post' => $post])
                @endforeach

                <hr>

                @auth
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <input type="text" name="body" placeholder="新しいコメントを入力..." required>
                        <button type="submit">送信</button>
                    </form>
                @endauth

                @guest
                    <p style="font-size: 13px; color: #666; margin-top: 10px;">
                        コメントを投稿するには <a href="{{ route('login') }}">ログイン</a> してください。
                    </p>
                @endguest
            </div>
        </div>
        <hr>
    @endforeach
</body>
</html>