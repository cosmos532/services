<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'message'])->name('contact');

Route::get('lang/{lang}', [App\Http\Controllers\LanguageController::class, 'swap'])->name('lang.swap');

Auth::routes(['verify' => true]);

// --------------------------------------------------------------
// DASHBOARD
// --------------------------------------------------------------

Route::middleware(['auth'])->middleware('verified')->group(function () {

    Route::group(['prefix' => 'home'], function() {

        //---HOME---//

        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        //---USERS---//

        Route::resource('users', App\Http\Controllers\UserController::class);

        //---SERVICES---//

        Route::resource('services', App\Http\Controllers\ServiceController::class);

       
        //---BOOKINGS---//

        Route::get('/bookings/search', [App\Http\Controllers\BookingController::class, 'search'])->name('bookings.search');

        Route::get('/bookings/pay', function () {
            return view('bookings.pay');
        })->name('bookings.pay');

        Route::post('/booking/select', [App\Http\Controllers\BookingController::class, 'select'])->name('select');

        Route::post('/booking/prices', [App\Http\Controllers\BookingController::class, 'prices'])->name('prices');

        Route::post('/booking/check-date', [App\Http\Controllers\BookingController::class, 'checkDate'])->name('check.date');

        Route::post('booking/status', [App\Http\Controllers\BookingController::class, 'status'])->name('booking.status');

        Route::get('/booking/{id}/', [App\Http\Controllers\BookingController::class, 'create']);

        Route::resource('/bookings', App\Http\Controllers\BookingController::class);

    });

});