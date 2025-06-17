<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WatchlaterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    
    Route::get("/movies/{movie}", [MovieController::class, 'show'])->name('movies.show');
    Route::post('/movies/store', [MovieController::class, 'store'])->name('movies.store');
   
    Route::post("/", [CommentController::class, 'store'])->name('comments.store');
    
    Route::post("/movies", [RatingController::class, 'store'])->name('ratings.store');
    
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::post('/watchlaters', [WatchlaterController::class, 'store'])->name('watchlaters.store');
    
    Route::get('/watchlater', [WatchlaterController::class, 'index'])->name('watchlaters.index');

    Route::delete("/comments/{comment}", [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';
