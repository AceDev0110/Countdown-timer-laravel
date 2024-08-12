<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $data = ['signin' => '0'];
    return view('dashboard', $data);
});


Route::get('/dashboard', [DashboardController::class, 'showDashboard']);

// Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->name('dashboard');

Route::get('/login/guest', function () {
    $data = ['signin' => '1'];
    return view('dashboard', $data);
});

Route::get('login/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.socialite.redirect');
Route::get('login/{provider}/callback', [SocialLoginController::class, 'callback'])->name('auth.socialite.callback');
