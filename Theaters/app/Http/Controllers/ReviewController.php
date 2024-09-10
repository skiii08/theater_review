<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\ScreenNumber;
use App\Models\TheaterReview;
use App\Models\MovieReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create()
    {
        $theaters = Theater::all();
        $selectedMovie = session('selected_movie');
        session()->forget('selected_movie'); // セッションから削除

        return view('reviews.create', compact('theaters', 'selectedMovie'));
    }

    public function getScreenNumbers($theaterId)
    {
        $screenNumbers = ScreenNumber::where('theater_id', $theaterId)->count();
        return response()->json(range(1, $screenNumbers));
    }

    public function store(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'theater_id' => 'required|exists:theaters,id',
            'screen_number' => 'required|integer',
            'seat_number' => 'required|string',
            'viewing_date' => 'required|date',
            'theater_review' => 'required|string|max:500',
            'movie_id' => 'required|exists:movies,id',
            'movie_rating' => 'required|numeric|min:0|max:5',
            'movie_review' => 'required|string',
        ]);

        // ログインユーザーのIDを追加
        $userId = auth()->id();
        
        \Log::info('Validated Data:', $validatedData);
        \Log::info('User ID:', ['user_id' => $userId]);


        // MovieReviewの作成
        $movieReview = MovieReview::create([
            'movie_id' => $validatedData['movie_id'],
            'movie_rating' => $validatedData['movie_rating'],
            'movie_review' => $validatedData['movie_review'],
            'user_id' => $userId,
        ]);

        // TheaterReviewの作成
        $theaterReview = TheaterReview::create([
            'theater_id' => $validatedData['theater_id'],
            'user_id' => $userId,
            'viewing_date' => $validatedData['viewing_date'],
            'screen_number' => $validatedData['screen_number'],
            'seat_number' => $validatedData['seat_number'],
            'review' => $validatedData['theater_review'],
        ]);
        
        \Log::info('Theater Review Created:', $theaterReview->toArray());

        return redirect()->route('reviews.show', $theaterReview->id)->with('success', 'レビューが投稿されました。');
    
        } catch (\Exception $e) {
        \Log::error('Error in store method: ' . $e->getMessage());
        return back()->with('error', 'レビューの投稿中にエラーが発生しました。');
    }
        }

    public function show(TheaterReview $review)
    {
        $review->load('theater');
        $movieReview = MovieReview::where('user_id', $review->user_id)
                                  ->where('created_at', '>=', $review->created_at)
                                  ->first();
        return view('reviews.show', compact('review', 'movieReview'));
    }

    public function edit(TheaterReview $review)
{
    $theaters = Theater::all();
    $movieReview = MovieReview::where('user_id', $review->user_id)
                              ->where('created_at', '>=', $review->created_at)
                              ->first();
    
    // viewing_dateが文字列の場合、Carbonオブジェクトに変換
    if (is_string($review->viewing_date)) {
        $review->viewing_date = \Carbon\Carbon::parse($review->viewing_date);
    }
    
    // デバッグ用のログ
    \Log::info('Editing review:', ['viewing_date' => $review->viewing_date]);
    
    return view('reviews.edit', compact('review', 'theaters', 'movieReview'));
}

   public function update(Request $request, TheaterReview $review)
{
    \Log::info('Update method called', ['review_id' => $review->id, 'request_data' => $request->all()]);

    try {
        $validatedData = $request->validate([
            'theater_id' => 'required|exists:theaters,id',
            'screen_number' => 'required|integer',
            'seat_number' => 'required|string',
            'viewing_date' => 'required|date',
            'review' => 'required|string|max:500',
        ]);

        \Log::info('Validated data', $validatedData);

        $review->update($validatedData);

        \Log::info('Review updated', ['review' => $review->fresh()->toArray()]);

        return redirect()->route('reviews.show', $review->id)->with('success', 'レビューが更新されました。');
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed', ['errors' => $e->errors()]);
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        \Log::error('Error updating review', ['error' => $e->getMessage()]);
        return back()->with('error', 'レビューの更新中にエラーが発生しました。')->withInput();
    }
}


    public function destroy(TheaterReview $review)
    {
        $movieReview = MovieReview::where('user_id', $review->user_id)
                                  ->where('created_at', '>=', $review->created_at)
                                  ->first();
        if ($movieReview) {
            $movieReview->delete();
        }
        $review->delete();
        return redirect()->route('theater.top')->with('success', 'レビューが削除されました。');
    }
}