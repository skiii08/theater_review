<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie['title'] }} - 映画詳細</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #007bff;
        }
        p {
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .button-secondary {
            background-color: #6c757d;
        }
        .button-secondary:hover {
            background-color: #545b62;
        }
        .movie-poster {
            max-width: 300px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>{{ $movie['title'] }}</h1>
    
    @if(isset($movie['poster_url']))
        <img src="{{ $movie['poster_url'] }}" alt="{{ $movie['title'] }} ポスター" class="movie-poster">
    @endif

    <p><strong>ID:</strong> {{ $movie['id'] }}</p>
    <p><strong>公開日:</strong> {{ $movie['release_date'] }}</p>
    <p><strong>上映時間:</strong> {{ $movie['runtime'] ?? 'N/A' }}分</p>
    <p><strong>ジャンル:</strong> {{ $movie['genres_string'] ?? 'N/A' }}</p>
    <p><strong>監督:</strong> {{ $movie['director'] ?? 'N/A' }}</p>
    <p><strong>主要出演者:</strong> {{ $movie['cast'] ?? 'N/A' }}</p>
    <p><strong>概要:</strong> {{ $movie['overview'] }}</p>
    <p><strong>ポスターURI:</strong> {{ $movie['poster_path'] ?? 'N/A' }}</p>
    
    @if(isset($movie['vote_average']))
        <p><strong>評価:</strong> {{ $movie['vote_average'] }} / 10</p>
    @endif

    <br>
    <a href="{{ url()->previous() }}" class="button button-secondary">戻る</a>
    
    <form action="{{ route('movies.save') }}" method="POST" style="display: inline;">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
        <button type="submit" class="button">決定する</button>
    </form>
    
    <a href="{{ route('movies.search') }}" class="button">新しい検索を行う</a>
</body>
</html>