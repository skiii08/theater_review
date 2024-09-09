<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\ScreenNumber;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create()
    {
        $theaters = Theater::all();
        return view('reviews.create', compact('theaters'));
    }

    public function getScreenNumbers($theaterId)
    {
        $screenNumbers = ScreenNumber::where('theater_id', $theaterId)->count();
        return response()->json(range(1, $screenNumbers));
    }

   public function store(Request $request)
{
    $validatedData = $request->validate([
        'theater_id' => 'required|exists:theaters,id',
        'screen_number' => 'required|integer',
        'seat_number' => 'required|string',
        'viewing_date' => 'required|date',
        'review' => 'required|string|max:500',
    ]);

    // ログインユーザーのIDを追加
    $validatedData['user_id'] = auth()->id();

    $review = Review::create($validatedData);

    return redirect()->route('reviews.show', $review->id)->with('success', 'レビューが投稿されました。');
}
    
   public function show(Review $review)
{
    $review->load('theater');
    return view('reviews.show', compact('review'));
}

public function edit(Review $review)
{
    $theaters = Theater::all();
    return view('reviews.edit', compact('review', 'theaters'));
}

public function update(Request $request, Review $review)
{
    $validatedData = $request->validate([
        'theater_id' => 'required|exists:theaters,id',
        'screen_number' => 'required|integer',
        'seat_number' => 'required|string',
        'viewing_date' => 'required|date',
        'review' => 'required|string|max:500',
    ]);

    $review->update($validatedData);

    return redirect()->route('reviews.show', $review->id)->with('success', 'レビューが更新されました。');
}

public function destroy(Review $review)
{
    $review->delete();
    return redirect()->route('theater.top')->with('success', 'レビューが削除されました。');
}


}