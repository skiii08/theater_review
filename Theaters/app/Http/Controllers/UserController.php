<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('users.userTop');
    }

    public function reviews()
    {
        $user = Auth::user();
        $theaterReviews = $user->theaterReviews()->with('theater')->get();
        $movieReviews = $user->movieReviews()->with('movie')->get();
        return view('users.reviewsIndex', compact('theaterReviews', 'movieReviews'));
    }
}