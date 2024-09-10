<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\ScreenNumber;
use App\Models\TheaterReview;
use App\Models\MovieReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ReviewController extends Controller
{
   public function create(Request $request)
{
    $theaters = Theater::all();
    $selectedMovie = session('selected_movie');
    $oldImage = session('old_image');
    session()->forget(['selected_movie', 'old_image']);

    return view('reviews.create', compact('theaters', 'selectedMovie', 'oldImage'));
}

    public function getScreenNumbers($theaterId)
    {
        $screenNumbers = ScreenNumber::where('theater_id', $theaterId)->count();
        return response()->json(range(1, $screenNumbers));
    }

    public function store(Request $request)
{
    \Log::info('Review store method called');
    \Log::info('Request data: ' . json_encode($request->all()));

    try {
       $validatedData = $request->validate([
    'theater_id' => 'required|exists:theaters,id',
    'viewing_date' => 'nullable|date',
    'screen_number' => 'nullable|integer',
    'seat_number' => 'nullable|string',
    'review' => 'nullable|string|max:500',
    'movie_id' => 'required|exists:movies,id',
    'movie_rating' => 'nullable|numeric|min:0|max:5',
    'movie_review' => 'nullable|string',
    'image' => 'nullable|image|max:2048',
]);

        \Log::info('Validation passed');

        // 画像のアップロード処理
        

        $theaterReview = new TheaterReview([
    'theater_id' => $validatedData['theater_id'],
    'user_id' => auth()->id(),
    'screen_number' => $validatedData['screen_number'],
    'seat_number' => $validatedData['seat_number'],
    'viewing_date' => $validatedData['viewing_date'],
    'review' => $validatedData['review'],  // 'theater_review' から 'review' に変更
]);
        
        \Log::info('Theater Review object:', ['theaterReview' => $theaterReview]);
        
        if ($request->hasFile('image')) {
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        
                if ($theaterReview !== null) {
            $theaterReview->image_url = $uploadedFileUrl;
        } else {
            \Log::error('Theater Review object is null');
            return back()->with('error', 'レビューの作成に失敗しました。');
        }
    }



        if ($theaterReview->save()) {
            \Log::info('Theater Review saved successfully');

            $movieReview = new MovieReview([
    'movie_id' => $validatedData['movie_id'],
    'user_id' => auth()->id(),
    'movie_rating' => $validatedData['movie_rating'],
    'movie_review' => $validatedData['movie_review'],
]);

            if ($movieReview->save()) {
                \Log::info('Movie Review saved successfully');
                return redirect()->route('theater.top')->with('success', 'レビューが投稿されました。');
            } else {
                \Log::error('Failed to save movie review');
                return back()->with('error', '映画レビューの保存に失敗しました。');
            }
        } else {
            \Log::error('Failed to save theater review');
            return back()->with('error', '映画館レビューの保存に失敗しました。');
        }
    } catch (\Exception $e) {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('temp', 'public');
            session(['old_image' => asset('storage/' . $imagePath)]);
        }
        \Log::error('Exception in store method: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return back()->with('error', 'エラーが発生しました: ' . $e->getMessage())->withInput();
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