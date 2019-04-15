<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'SiteController@index');
Route::get('nearby', 'APIController@searchNearby');
Route::get('book/{property}', 'BookingController@create');

Route::get('users/{user}/bookings', 'APIController@userBookings');
Route::get('properties/{property}/bookings', 'APIController@propertyBookings');

Route::group(['middleware' => 'auth'], function() {
    Route::post('book/{property}', 'BookingController@store');
    Route::get('history', 'SiteController@bookingHistory');
});
