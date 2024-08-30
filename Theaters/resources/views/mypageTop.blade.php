<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <style>
        .status-message {
            width: 100%;
            max-width: 500px;
        }
        .review-container {
            display: flex;
            justify-content: space-between;
        }
        .review-box {
            width: 30%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>マイページ</h1>

    <section>
        <h2>ユーザー情報</h2>
        <p>ユーザーネーム: <span id="username">ここにユーザーネームが入ります</span></p>
        
        <label for="status-message">ステータスメッセージ:</label>
        <textarea id="status-message" class="status-message" rows="3"></textarea>
    </section>

    <section>
        <h2>Keeps</h2>
        <button>すべて見る</button>
        
        <div class="review-container">
            <div class="review-box">
                <h3>レビュー1</h3>
                <p>レビュー内容の一部...</p>
            </div>
            <div class="review-box">
                <h3>レビュー2</h3>
                <p>レビュー内容の一部...</p>
            </div>
            <div class="review-box">
                <h3>レビュー3</h3>
                <p>レビュー内容の一部...</p>
            </div>
        </div>
    </section>

    <section>
        <h2>映画館を探す</h2>
        <button>映画館を探す</button>
    </section>
</body>
</html>