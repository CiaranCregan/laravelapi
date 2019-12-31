<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// general
Route::post('/login', 'AuthController@login')->name('login');

// admin endpoints
Route::get('/users', 'AdminController@index')->name('admin.users');
Route::post('/bookings', 'BookingsController@createNewBooking')->name('bookings.create');
Route::get('/todaysbookings', 'BookingsController@getTodaysBookings');
Route::get('/bookings', 'BookingsController@getAllBookings');

// user endpoints
Route::get('/bookings/{id}', 'BookingsController@getBookingsByUserId')->name('allbookings');
