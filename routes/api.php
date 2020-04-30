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
Route::post('/register', 'AuthController@register')->name('register');

// admin endpoints
Route::get('/admin/users', 'AdminController@index')->name('admin.users');
Route::get('/admin/clients', 'AdminController@showDropdownUsers')->name('admin.dropdwnClients');
Route::get('/admin/clients/bookings/{user_id}', 'AdminController@showUserBookings')->name('admin.dropdwnClients');
Route::post('/bookings', 'BookingsController@createNewBooking')->name('bookings.create');
Route::get('/admin/todaysbookings', 'BookingsController@getTodaysBookings');
Route::delete('/admin/remove/{bookingId}', 'BookingsController@destroy');
Route::post('/admin/update/{booking_id}', 'BookingsController@updateBooking');
Route::get('/bookings', 'BookingsController@getAllBookings');
Route::get('/admin/classes', 'ClassesController@index');
Route::get('/admin/classes/today', 'ClassesController@getTodaysClasses');


// user endpoints
Route::get('/user/all/{user_id}', 'GeneralController@getMyBookings');
Route::get('/user/today/{user_id}', 'GeneralController@getTodaysBookings');
Route::get('/user/future/{user_id}', 'GeneralController@getFutureBookings');
Route::get('/qr-code/{id}', function ($id) {
    $image = QrCode::format('png')
    ->size(500)
    ->generate($id);

    return response($image)->header('Content-type','image/png');
});
Route::put('/admin/classes/book/{classId}/{userId}', 'ClassesController@updateGoingAmountForClass');
Route::put('/admin/classes/removebooking/{classId}/{userId}', 'ClassesController@removeBooking');
Route::get('/admin/classes/going/{id}', 'ClassesController@getGoingForSpecificClass');
Route::get('/admin/classes/confirm/{id}', 'ClassesController@showMyClasses');
