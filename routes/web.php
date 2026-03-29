<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;


Route::get('/', [GuestController::class, 'Home'])->name('home');
Route::get('/room/{slug}', [GuestController::class, 'RoomDetail'])->name('room.detail');

// Booking Flow
Route::get('/booking/{slug}', [BookingController::class, 'showForm'])->name('booking.form');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{transaction_id}', [BookingController::class, 'successPage'])->name('booking.success');
Route::get('/booking/download/{transactionId}', [BookingController::class, 'downloadContract'])->name('booking.download');

Route::get('about-us', function () {
    return view('guest.about');
})->name('about-us');


Route::get('accommodation', [GuestController::class, 'Accommodation'])->name('accommodation');

Route::get('dining', [GuestController::class, 'Dining'])->name('dining');                                                               

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

// Rooms
Route::get('Rooms Admin', [AdminController::class, 'Rooms'])->name('rooms-admin');
Route::post('room-types/store', [AdminController::class, 'storeType'])->name('types.store');
Route::post('room-types/update/{id}', [AdminController::class, 'updateType'])->name('types.update');
Route::delete('room-types/delete/{id}', [AdminController::class, 'deleteType'])->name('types.delete');

Route::post('rooms/store', [AdminController::class, 'storeRoom'])->name('rooms.store');
Route::post('rooms/update/{id}', [AdminController::class, 'updateRoom'])->name('rooms.update');
Route::delete('rooms/delete/{id}', [AdminController::class, 'deleteRoom'])->name('rooms.delete');

// Reservation
Route::get('Reservations Admin', [AdminController::class, 'Reservations'])->name('reservations-admin');
Route::patch('/reservations/{id}/complete', [AdminController::class, 'completeBooking'])->name('reservations.complete');
Route::delete('/reservations/{id}', [AdminController::class, 'deleteBooking'])->name('reservations.delete');

Route::get('Dining Admin', [AdminController::class, 'Dining'])->name('dining-admin');
Route::post('/admin/dining/store', [AdminController::class, 'StoreDining'])->name('dining.store');
Route::put('/admin/dining/update/{id}', [AdminController::class, 'UpdateDining'])->name('dining.update');
Route::delete('/admin/dining/delete/{id}', [AdminController::class, 'DeleteDining'])->name('dining.delete');

// Gateways
Route::delete('/delete-gateway/{id}', [PaymentController::class, 'deleteGateway'])->name('delete-gateway');
Route::post('/edit-payment-gateway/{id}', [PaymentController::class, 'editGateway'])->name('edit-payment-gateway');
Route::post('/gateway-toggle-status/{id}', [PaymentController::class, 'toggleStatus'])->name('gateway-toggle-status');

// Auth
Route::get('Login Admin', [AuthController::class, 'showLoginSAdmin'])->name('login-admin');
Route::post('Proccess Login Admin', [AuthController::class, 'loginSAdmin'])->name('proccess-login-admin');
Route::post('Logout Admin', [AuthController::class, 'LogoutSAdmin'])->name('logout-admin');