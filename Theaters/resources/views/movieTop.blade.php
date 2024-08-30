<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>映画トップページ</title>
    <style>
        .review-container {
            display: flex;
            justify-content: space-between;
        }
        .review-box {
            width: 22%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>映画トップページ</h1>

    <section>
        <h2>最近のレビュー</h2>
        <button>新しいレビューを投稿する</button>

        <div class="review-container">
            <div class="review-box">
                <h3>レビュータイトル1</h3>
                <p>レビュー内容の一部...</p>
            </div>
            <div class="review-box">
                <h3>レビュータイトル2</h3>
                <p>レビュー内容の一部...</p>
            </div>
            <div class="review-box">
                <h3>レビュータイトル3</h3>
                <p>レビュー内容の一部...</p>
            </div>
            <div class="review-box">
                <h3>レビュータイトル4</h3>
                <p>レビュー内容の一部...</p>
            </div>
        </div>
    </section>

    <section>
        <h2>映画を探す</h2>
        <button>映画を探す</button>
    </section>
</body>
</html>