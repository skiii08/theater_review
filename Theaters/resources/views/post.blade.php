<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>映画レビュー投稿</title>
</head>
<body>
    <h1>映画レビュー投稿</h1>

    <form action="#" method="POST">
        @csrf

        <div>
            <label for="cinema">映画館名:</label>
            <select name="cinema" id="cinema">
                <option value="">選択してください</option>
                <!-- ここに映画館のオプションを追加 -->
            </select>
        </div>

        <div>
            <label for="screen">スクリーン番号:</label>
            <select name="screen" id="screen">
                <option value="">選択してください</option>
                <!-- ここにスクリーン番号のオプションを追加 -->
            </select>
        </div>

        <div>
            <label for="seat">座席番号:</label>
            <input type="text" name="seat" id="seat">
        </div>

        <div>
            <label for="date">鑑賞日:</label>
            <input type="date" name="date" id="date">
        </div>

        <div>
            <label for="cinema_review">映画館のレビュー:</label>
            <textarea name="cinema_review" id="cinema_review" rows="4"></textarea>
        </div>

        <div>
            <button type="button">映画を探す</button>
        </div>

        <div>
            <label for="movie_rating">映画評価:</label>
            <input type="number" name="movie_rating" id="movie_rating" min="0" max="5" step="0.1">
        </div>

        <div>
            <label for="movie_review">映画のレビュー:</label>
            <textarea name="movie_review" id="movie_review" rows="4"></textarea>
        </div>

        <div>
            <button type="submit">投稿</button>
            <button type="button">キャンセル</button>
        </div>
    </form>
</body>
</html>