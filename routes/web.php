<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::resource('posts', PostController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])
    ->name('comments.edit')
    ->middleware('auth');

Route::put('/comments/{comment}', [CommentController::class, 'update'])
    ->name('comments.update')
    ->middleware('auth');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')
    ->middleware('auth');

Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::resource('posts', PostController::class)->except(['index', 'show'])->middleware('auth');

require __DIR__.'/auth.php';
