<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MovieSearchController;


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

Route::get('/posts', [PostController::class, 'index']); 

Route::get('/theaterTop', [PostController::class, 'theaterTop'])->name('theater.top');


Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');

Route::get('/get-screen-numbers/{theaterId}', [ReviewController::class, 'getScreenNumbers'])->name('get.screen.numbers');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::get('movies/search',[MovieSearchController::class, 'search']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

/*


Route::get('/post', function() {
    return view('post');
});


Route::get('/theaterTop', function() {
    return view('theaterTop');
});




Route::get('/theaterTop', [PostController::class, 'theaterTop']);


Route::get('/movieTop', function() {
    return view('theaterTop');
});

Route::get('/movieTop', function() {
    return view('mypageTop');
});

*/



