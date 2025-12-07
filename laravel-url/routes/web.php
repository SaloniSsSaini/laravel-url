<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShortUrlController;


// --------------------
// AUTH ROUTES
// --------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'register']);


// --------------------
// DASHBOARD
// --------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


// --------------------
// PROTECTED ROUTES
// --------------------
Route::middleware('auth')->group(function () {

    // Companies
    Route::get('/companies', [CompanyController::class, 'index'])
        ->name('companies.index');

    // Users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    // Short URLs
    Route::get('/urls', [ShortUrlController::class, 'index'])
        ->name('urls.index');
});


// --------------------
// HOME REDIRECT
// --------------------
Route::get('/', function () {
    return redirect('/login');
});
