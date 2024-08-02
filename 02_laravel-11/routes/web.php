<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\ProfileController;
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
Route::prefix('/profile')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ProfileController::class, 'show'])
        ->name('profile');

    Route::get('/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/posts/create', [ProfileController::class, 'postsCreate'])
        ->name('profile.posts.create');
    Route::post('/posts', [ProfileController::class, 'postsStore'])
        ->name('profile.posts.store');

    Route::get('/posts/{post}/edit', [ProfileController::class, 'postsEdit'])
        ->name('profile.posts.edit');
    Route::patch('/posts/{post}', [ProfileController::class, 'postsUpdate'])
        ->name('profile.posts.update');

    Route::delete('/posts/{post}', [ProfileController::class, 'postsDestroy'])
        ->name('profile.posts.destroy');
});

Route::prefix('/newsletters')->group(function () {
    Route::post('/', [NewslettersController::class, 'store'])
        ->name('newsletters.store');
});

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');
    Route::get('/{post:slug}', [HomeController::class, 'show'])
        ->name('home.show');
});

Route::prefix('/')->middleware(['auth', 'verified'])->group(function () {
    Route::post('/{post}/comments', [HomeController::class, 'commentsStore'])
        ->name('home.comments.store');
});
