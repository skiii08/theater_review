<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レビュー詳細</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>レビュー詳細</h1>
    <div>
        <p><strong>映画館名:</strong> {{ $review->theater ? $review->theater->theater_name : 'N/A' }}</p>
        <p><strong>スクリーン番号:</strong> {{ $review->screen_number }}</p>
        <p><strong>座席番号:</strong> {{ $review->seat_number }}</p>
        <p><strong>鑑賞日:</strong> {{ $review->viewing_date }}</p>
        <p><strong>レビュー:</strong></p>
        <p>{{ $review->review }}</p>
        <p><small>投稿日時: {{ $review->created_at }}</small></p>
    </div>

    <div>
        <a href="{{ route('theater.top') }}">トップページに戻る</a>
        @if(auth()->check() && $review->user_id)
            @if(auth()->id() == $review->user_id)
                <a href="{{ route('reviews.edit', $review) }}">編集</a>
                <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                </form>
            @endif
        @else
            <p>編集・削除機能を使用するにはログインが必要です。</p>
        @endif
    </div>

    <!-- デバッグ情報 -->
    @if(config('app.debug'))
        <div style="margin-top: 20px; padding: 10px; background-color: #f0f0f0;">
            <h3>デバッグ情報:</h3>
            <p>ユーザーログイン状態: {{ auth()->check() ? 'ログイン中' : '未ログイン' }}</p>
            <p>現在のユーザーID: {{ auth()->id() ?? 'なし' }}</p>
            <p>レビューのuser_id: {{ $review->user_id ?? 'なし' }}</p>
        </div>
    @endif
</body>
</html>