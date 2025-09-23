<?php

use Illuminate\Support\Facades\App;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

if (App::environment('production')) {
    $mainDomain = 'neboisyaznat.ru';
    $blogDomain = 'blog.neboisyaznat.ru';
} else {
    $mainDomain = config('app.main_domain');
    $blogDomain = config('app.blog_domain');
}

Route::domain($mainDomain)->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/about', [HomeController::class, 'about']);
    Route::get('/reviews', [HomeController::class, 'reviews']);
    Route::get('/policy', [HomeController::class, 'policy']);
    Route::get('/blog', function () {
        return redirect()->away('http://' . config('app.blog_domain'));
    });
    Route::post('/reviews', [HomeController::class, 'storeReview']);
});

Route::domain($blogDomain)->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/main', function () {
        return redirect()->away('http://' . config('app.main_domain'));
    });
    Route::get('/posts/{post:link}', [BlogController::class, 'show'])->name('posts.show');
});

// Route::domain('edu.nbzhub.org')->group(function () {
//     Route::get('/', function () {
//         return Inertia::render('Platform/Dashboard');
//     });
// });
require __DIR__.'/auth.php';
