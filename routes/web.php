<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Public Routes (Login + Register)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Routes (User Must Be Logged In)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', DashboardController::class)->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Companies (SuperAdmin only in UI, but no middleware restriction needed)
    |--------------------------------------------------------------------------
    */
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');


    /*
    |--------------------------------------------------------------------------
    | Users List (SuperAdmin only visible in UI)
    |--------------------------------------------------------------------------
    */
    Route::get('/users', [UserController::class, 'index'])->name('users.index');


    /*
    |--------------------------------------------------------------------------
    | Invitations
    |--------------------------------------------------------------------------
    */
    Route::get('/invite', [InvitationController::class, 'create'])->name('invite.create');
    Route::post('/invite', [InvitationController::class, 'store'])->name('invite.store');

    // Accept invitation (token middleware used)
    Route::get('/invite/accept', function () {
        return view('invitations.accept');
    })->middleware('invitation_token');


    /*
    |--------------------------------------------------------------------------
    | Short URL (No one can create, only list)
    |--------------------------------------------------------------------------
    */
    Route::get('/urls', [ShortUrlController::class, 'index'])->name('urls.index');
});


/*
|--------------------------------------------------------------------------
| Fallback redirect
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return redirect('/dashboard');
});
