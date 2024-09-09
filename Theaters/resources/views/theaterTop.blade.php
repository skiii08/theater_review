<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>映画館トップページ</title>
    <style>
        .review-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .theater_review {
            width: 22%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
        }
        .detail-button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>映画館トップページ</h1>

    <section>
        <h2>最近のレビュー</h2>
        <a href="{{ route('reviews.create') }}" class="detail-button">新しいレビューを投稿する</a>

        <div class="review-container">
            @foreach ($theater_reviews as $theater_review)
                <div class='theater_review'>
                    <h2 class='theater_name'>{{ $theater_review->theater->theater_name }}</h2>
                    <p class='adress'>{{ $theater_review->theater->adress }}</p>
                    <p class='body'>{{ Str::limit($theater_review->review, 100) }}</p>
                    <a href="{{ route('reviews.show', $theater_review->id) }}" class="detail-button">詳細を見る</a>
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <h2>映画館を探す</h2>
        <button>映画館を探す</button>
    </section>
</body>
</html>