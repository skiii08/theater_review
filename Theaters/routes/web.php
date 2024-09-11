<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MovieSearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheaterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 映画館一覧表示関連
Route::get('/posts', [PostController::class, 'index']);
Route::get('/theaterTop', [PostController::class, 'theaterTop'])->name('theater.top');

// レビュー関連
Route::middleware('auth')->group(function () {
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
    // 他のレビュー関連のルート
});
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::get('/get-screen-numbers/{theaterId}', [ReviewController::class, 'getScreenNumbers'])->name('get.screen.numbers');

//映画館詳細
Route::get('/theaters/{theater}', [TheaterController::class, 'show'])->name('theaters.show');


// ユーザー関連
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/reviews', [UserController::class, 'reviews'])->name('users.reviews.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 映画検索関連
Route::get('/movies/search', [MovieSearchController::class, 'top'])->name('movies.search');
Route::get('/movies/search/result', [MovieSearchController::class, 'search'])->name('movies.search.get');
Route::get('/movies/{id}', [MovieSearchController::class, 'show'])->name('movies.show');
Route::post('/movies/save', [MovieSearchController::class, 'save'])->name('movies.save');

// 映画ページ関連
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::resource('movie_reviews', MovieController::class)->except(['index', 'create', 'store']);

require __DIR__.'/auth.php';