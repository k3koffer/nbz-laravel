<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::domain('blog.neboisyaznat.ru')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/posts/{post:link}', [BlogController::class, 'show'])->name('posts.show');

    Route::redirect('/main', 'https://neboisyaznat.ru'); 
});

Route::domain('neboisyaznat.ru')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/about', [HomeController::class, 'about']);
    Route::get('/reviews', [HomeController::class, 'reviews']);
    Route::get('/policy', [HomeController::class, 'policy']);
    Route::post('/reviews', [HomeController::class, 'storeReview']);

    Route::redirect('/blog', 'https://blog.neboisyaznat.ru');
});

// Route::domain('edu.nbzhub.org')->group(function () {
//     Route::get('/', function () {
//         return Inertia::render('Platform/Dashboard');
//     });
// });
require __DIR__.'/auth.php';
