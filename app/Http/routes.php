<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Dashboard
Route::get('dashboard', 'DashboardController@index');
Route::get('/', 'DashboardController@index');

// API
Route::controller('nordnet', '\App\Nordnet\Controllers\NordnetController');

// Auth @todo: Find a better way of setting the basic auth routes
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Instrument
Route::resource('instrument', 'InstrumentController');