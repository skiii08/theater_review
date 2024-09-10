<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MovieSearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::get('/get-screen-numbers/{theaterId}', [ReviewController::class, 'getScreenNumbers'])->name('get.screen.numbers');

// ユーザー関連
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/reviews', [UserController::class, 'reviews'])->name('users.reviews.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 映画検索関連
Route::get('/searchTop', [MovieSearchController::class, 'top'])->name('movies.search');
Route::get('/search', [MovieSearchController::class, 'search'])->name('movies.search.get');
Route::get('/movie/{id}', [MovieSearchController::class, 'show'])->name('movies.show');
Route::post('/movie/save', [MovieSearchController::class, 'save'])->name('movies.save');

//映画ページ関連
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movie-reviews/{movie_review}', [MovieController::class, 'show'])->name('movie_reviews.show');
Route::get('/movie-reviews/{movie_review}/edit', [MovieController::class, 'edit'])->name('movie_reviews.edit');
Route::put('/movie-reviews/{movie_review}', [MovieController::class, 'update'])->name('movie_reviews.update');
Route::delete('/movie-reviews/{movie_review}', [MovieController::class, 'destroy'])->name('movie_reviews.destroy');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');

require __DIR__.'/auth.php';