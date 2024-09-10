<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レビュー編集</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>レビュー編集</h1>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="theater_id">映画館名:</label>
            <select name="theater_id" id="theater_id" required>
                <option value="">選択してください</option>
                @foreach($theaters as $theater)
                    <option value="{{ $theater->id }}" {{ $review->theater_id == $theater->id ? 'selected' : '' }}>
                        {{ $theater->theater_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="screen_number">スクリーン番号:</label>
            <select name="screen_number" id="screen_number" required>
                <option value="{{ $review->screen_number }}">{{ $review->screen_number }}</option>
            </select>
        </div>
        <div>
            <label for="seat_number">座席番号:</label>
            <input type="text" name="seat_number" id="seat_number" value="{{ $review->seat_number }}" required>
        </div>
       <div>
    <label for="viewing_date">鑑賞日:</label>
    <input type="date" name="viewing_date" id="viewing_date" value="{{ $review->viewing_date instanceof \Carbon\Carbon ? $review->viewing_date->format('Y-m-d') : $review->viewing_date }}" required>
</div>
        <div>
            <label for="review">レビュー:</label>
            <textarea name="review" id="review" maxlength="500" placeholder="500字以内で入力してください" required>{{ $review->review }}</textarea>
        </div>
        <button type="submit">更新する</button>
    </form>

    <script>
        // スクリーン番号を動的に更新するJavaScriptコードをここに追加
    </script>
</body>
</html>