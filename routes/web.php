<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.blog_domain'))->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/admin', action: [BlogController::class, 'admin']);
    Route::get('/posts/{post:link}', [BlogController::class, 'show'])->name('posts.show');

    Route::redirect('/main', 'http://' . config('app.main_domain')); 
});

Route::domain(config('app.main_domain'))->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/about', [HomeController::class, 'about']);
    Route::get('/reviews', [HomeController::class, 'reviews']);
    Route::get('/policy', [HomeController::class, 'policy']);
    Route::post('/reviews', [HomeController::class, 'storeReview']);

    Route::redirect('/blog', 'http://' . config('app.blog_domain'));
});

Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::post('posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
    Route::resource('posts', AdminPostController::class)->only(['destroy', 'store']);
});

// Route::domain('edu.nbzhub.org')->group(function () {
//     Route::get('/', function () {
//         return Inertia::render('Platform/Dashboard');
//     });
// });
require __DIR__.'/auth.php';
