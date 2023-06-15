<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/@{username}', [ProfileController::class, 'show'])->name('profile.show');


Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate']);
    Route::get('/github', [LoginController::class, 'redirectToGitHub'])->name('login.github');
    Route::get('/github/callback', [LoginController::class, 'handleGitHubCallback']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
