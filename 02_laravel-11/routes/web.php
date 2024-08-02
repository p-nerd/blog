<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// auths routes
Route::get('/register', [AuthController::class, 'register'])
    ->name('register');
Route::post('/register', [AuthController::class, 'store'])
    ->name('register.store');

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('logout');

// email verification routes
Route::get('/email/verify', [AuthController::class, 'verificationEmailShow'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificationEmail'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'verificationEmailSend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// public routes
Route::post('/newsletters', [NewslettersController::class, 'store'])
    ->name('newsletters.store');

Route::get('/', [PostController::class, 'index'])
    ->name('posts');
Route::get('/{post:slug}', [PostController::class, 'show'])
    ->name('posts.show');
Route::post('/{post}/comments', [PostController::class, 'commentsStore'])
    ->name('posts.comments.store');
