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

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])
        ->name('logout');
});

// email verification routes
Route::middleware(['auth', 'unverified'])->group(function () {
    Route::get('/email/verify', [AuthController::class, 'verificationEmailShow'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificationEmail'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'verificationEmailSend'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});

// public routes
Route::post('/newsletters', [NewslettersController::class, 'store'])
    ->name('newsletters.store');

Route::get('/', [PostController::class, 'index'])
    ->name('posts');
Route::get('/{post:slug}', [PostController::class, 'show'])
    ->name('posts.show');
Route::post('/{post}/comments', [PostController::class, 'commentsStore'])
    ->middleware(['auth', 'verified'])
    ->name('posts.comments.store');
