<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// auths routes
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'register'])
        ->name('register');
    Route::post('/register', [AuthController::class, 'store'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('login.store');
});

Route::prefix('/email')->middleware(['auth', 'unverified'])->group(function () {
    Route::get('/verify', [AuthController::class, 'verificationEmailShow'])
        ->name('verification.notice');
    Route::get('/verify/{id}/{hash}', [AuthController::class, 'verificationEmail'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/verification-notification', [AuthController::class, 'verificationEmailSend'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])
        ->name('logout');
});

// public routes
Route::prefix('/newsletters')->group(function () {
    Route::post('/', [NewslettersController::class, 'store'])
        ->name('newsletters.store');
});

Route::prefix('/')->group(function () {
    Route::get('/', [PostController::class, 'index'])
        ->name('posts');
    Route::get('/{post:slug}', [PostController::class, 'show'])
        ->name('posts.show');
});

Route::prefix('/')->middleware(['auth', 'verified'])->group(function () {
    Route::post('/{post}/comments', [PostController::class, 'commentsStore'])
        ->name('posts.comments.store');
});
