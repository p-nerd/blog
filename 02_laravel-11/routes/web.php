<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('posts');
Route::get('/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{post}/comments', [PostController::class, 'commentsStore'])->name('posts.comments.store');

Route::get('/login', fn () => 'login')->name('login');
Route::get('/register', fn () => 'register')->name('register');
Route::post('/logout', fn () => 'lgoout')->name('logout');
Route::post('/newsletters', fn () => 'newsletters')->name('newsletters.store');
