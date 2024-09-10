<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>検索結果</h1>
    @if(count($results) > 0)
        <ul>
            @foreach($results as $movie)
                <li>
                    <a href="{{ route('movies.show', $movie['id']) }}">
                        {{ $movie['title'] }} ({{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }})
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>検索結果が見つかりませんでした。</p>
    @endif
    <a href="{{ route('movies.search') }}" class="back-link">新しい検索を行う</a>
</body>
</html>