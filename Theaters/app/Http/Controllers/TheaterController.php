<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\ScreenNumber;
use App\Models\TheaterReview;

class TheaterController extends Controller
{
    public function show(Theater $theater)
    {
        $screens = ScreenNumber::where('theater_id', $theater->id)->get();
        $reviews = TheaterReview::where('theater_id', $theater->id)
                                ->with('user')
                                ->latest()
                                ->take(3)
                                ->get();
        return view('theaters.details', compact('theater', 'screens', 'reviews'));
    }
}