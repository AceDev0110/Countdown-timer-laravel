
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
Route::get('/', function () {
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/login/guest', function () {
    return view('dashboard');
});
Route::get('login/{provider}/redirect', [SocialLoginController::class , 'redirect'])->name('auth.socialite.redirect');
Route::get('login/{provider}/callback', [SocialLoginController::class , 'callback'])->name('auth.socialite.callback');