<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Movie;

class MovieSearchController extends Controller
{
    private $apiKey = '2545c279a8a3bb9b601db0f8a532c7c0';
    private $baseUrl = 'https://api.themoviedb.org/3';

  public function top()
{
    return view('search.search');
}

    public function search(Request $request)
{
    $query = $request->input('query');
    
    \Log::info('Search query: ' . $query); // ログに検索クエリを記録

    if (empty($query)) {
        \Log::warning('Empty search query'); // 空のクエリの場合、警告をログに記録
        return redirect()->route('movies.search')->with('error', '検索キーワードを入力してください。');
    }

    $response = Http::get("{$this->baseUrl}/search/movie", [
        'api_key' => $this->apiKey,
        'query' => $query,
        'language' => 'ja-JP',
        'include_adult' => false,
    ]);

    \Log::info('API Response: ' . $response->body()); // APIレスポンスをログに記録

    if ($response->successful()) {
        $results = $response->json()['results'];
        return view('search.result', compact('results'));
    } else {
        \Log::error('API Error: ' . $response->status()); // APIエラーをログに記録
        return back()->with('error', '映画の検索中にエラーが発生しました。');
    }
}

    public function show($id)
{
    // 映画の基本情報を取得
    $movieResponse = Http::get("{$this->baseUrl}/movie/{$id}", [
        'api_key' => $this->apiKey,
        'language' => 'ja-JP',
    ]);

    // クレジット情報（監督と出演者）を取得
    $creditsResponse = Http::get("{$this->baseUrl}/movie/{$id}/credits", [
        'api_key' => $this->apiKey,
        'language' => 'ja-JP',
    ]);

    if ($movieResponse->successful() && $creditsResponse->successful()) {
        $movie = $movieResponse->json();
        $credits = $creditsResponse->json();

        // 監督を抽出（通常、監督は'job'が'Director'の人物です）
        $director = collect($credits['crew'])->firstWhere('job', 'Director');
        $movie['director'] = $director ? $director['name'] : 'N/A';

        // 主要な出演者を抽出（例：上位5名）
        $cast = collect($credits['cast'])->take(5)->pluck('name')->implode(', ');
        $movie['cast'] = $cast;

        // ジャンルを文字列に変換
        $movie['genres_string'] = collect($movie['genres'])->pluck('name')->implode(', ');

        // ポスターの完全なURLを構築
        $movie['poster_url'] = isset($movie['poster_path']) 
            ? "https://image.tmdb.org/t/p/w500" . $movie['poster_path']
            : null;

        return view('search.details', compact('movie'));
    } else {
        return back()->with('error', '映画の詳細情報の取得中にエラーが発生しました。');
    }
}

 public function save(Request $request)
{
    $movieId = $request->input('movie_id');
    
    // APIから映画の詳細情報を再取得
    $response = Http::get("{$this->baseUrl}/movie/{$movieId}", [
        'api_key' => $this->apiKey,
        'language' => 'ja-JP',
        'append_to_response' => 'credits'
    ]);

    if ($response->successful()) {
        $movieData = $response->json();

        // 既存の映画レコードを検索または新しいインスタンスを作成
        $movie = Movie::firstOrNew(['id' => $movieData['id']]);

        // データを更新
        $movie->title = $movieData['title'];
        $movie->date = $movieData['release_date'];
        $movie->time = $movieData['runtime'];
        $movie->genre = implode(', ', array_column($movieData['genres'], 'name'));
        $movie->director = collect($movieData['credits']['crew'])
            ->firstWhere('job', 'Director')['name'] ?? null;
        $movie->cast = implode(', ', array_column(array_slice($movieData['credits']['cast'], 0, 5), 'name'));
        $movie->story = $movieData['overview'];
        $movie->poster_uri = $movieData['poster_path'] 
            ? "https://image.tmdb.org/t/p/w500" . $movieData['poster_path']
            : null;

        // データを保存
        if ($movie->save()) {
            // 映画情報をセッションに保存
            session(['selected_movie' => [
                'id' => $movie->id,
                'title' => $movie->title
            ]]);

            return redirect()->route('reviews.create')
                ->with('success', '映画の情報を保存しました');
        } else {
            return back()->with('error', '映画情報の保存に失敗しました');
        }
    } else {
        return back()->with('error', '映画情報の取得に失敗しました');
    }
}

}