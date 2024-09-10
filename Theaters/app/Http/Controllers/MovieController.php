<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieReview;
use Illuminate\Http\Request;

class MovieController extends Controller
{
   public function index()
{
    $movie_reviews = MovieReview::with(['movie', 'user'])
                                ->latest()
                                ->take(6)
                                ->get();
    return view('movies.movieTop', compact('movie_reviews'));
}
   public function show(MovieReview $movie_review)
{
    $movie_review->load('movie', 'user');
    return view('movies.show', compact('movie_review'));
}

    
    
    public function edit(MovieReview $movie_review)
{
    return view('movies.edit', compact('movie_review'));
}

public function update(Request $request, MovieReview $movie_review)
{
    $validatedData = $request->validate([
        'movie_rating' => 'required|numeric|min:0|max:5',
        'movie_review' => 'required|string',
    ]);

    $movie_review->update($validatedData);

    return redirect()->route('movie_reviews.show', $movie_review)->with('success', 'レビューが更新されました。');
}

public function destroy(MovieReview $movie_review)
{
    $movie_review->delete();
    return redirect()->route('movies.index')->with('success', 'レビューが削除されました。');
}

}