<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.home');
});

Route::get('about-us', function () {
    return view('guest.about');
})->name('about-us');

Route::get('accomodation', function () {
    return view('guest.accomodation');
})->name('accomodation');

Route::get('dining', function () {
    return view('guest.dining');
})->name('dining');

Route::get('event', function () {
    return view('guest.event');
})->name('event');

Route::get('terms', function () {
    return view('guest.terms');
})->name('terms');

Route::get('privacy', function () {
    return view('guest.privacy');
})->name('privacy');

Route::get('refund', function () {
    return view('guest.refund');
})->name('refund');
