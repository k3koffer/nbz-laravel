<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::domain(env('MAIN_DOMAIN'))->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/about', [HomeController::class, 'about']);
    Route::get('/reviews', [HomeController::class, 'reviews']);
    Route::get('/policy', [HomeController::class, 'policy']);
    Route::get('/blog', function () {
        return redirect()->away('http://' . env('BLOG_DOMAIN'));
    });
    Route::post('/reviews', [HomeController::class, 'storeReview']);
});

Route::domain(env('BLOG_DOMAIN'))->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/main', function () {
        return redirect()->away('http://' . env('MAIN_DOMAIN'));
    });
    Route::get('/posts/{post:link}', [BlogController::class, 'show'])->name('posts.show');
});

// Route::domain('edu.nbzhub.org')->group(function () {
//     Route::get('/', function () {
//         return Inertia::render('Platform/Dashboard');
//     });
// });
require __DIR__.'/auth.php';
