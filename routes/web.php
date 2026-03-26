<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
// use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('guest.home');
});

Route::get('about-us', function () {
    return view('guest.about');
})->name('about-us');

Route::get('accommodation', function () {
    return view('guest.accommodation');
})->name('accommodation');

Route::get('dining', function () {
    return view('guest.dining');
})->name('dining');

Route::get('event', function () {
    return view('guest.event');
})->name('event');

Route::get('contact', function () {
    return view('guest.contact');
})->name('contact');

Route::get('terms', function () {
    return view('guest.terms');
})->name('terms');

Route::get('privacy', function () {
    return view('guest.privacy');
})->name('privacy');

Route::get('refund', function () {
    return view('guest.refund');
})->name('refund');

// Admin Route

Route::get('Dashboard Admin', [AdminController::class, 'Dashboard'])->name('dashboard-admin');

// Auth
Route::get('Login Admin', [AuthController::class, 'showLoginSAdmin'])->name('login-admin');
Route::post('Proccess Login Admin', [AuthController::class, 'loginSAdmin'])->name('proccess-login-admin');
Route::post('Logout Admin', [AuthController::class, 'LogoutSAdmin'])->name('logout-admin');