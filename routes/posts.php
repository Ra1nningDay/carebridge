<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Route::get('/', [PostController::class, 'welcome'])->name('welcome');

Route::get('/posts', function () {
    return view('posts.index');
})->name('posts');

Route::resource('posts', PostController::class);

Route::resource('posts.comments', CommentController::class);