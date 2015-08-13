<?php

// Frontpage
Route::get('/', 'HomeController@index');

// Market
Route::get('market', 'Market\MarketController@index');
Route::resource('market/instruments', 'Market\InstrumentController');
Route::resource('market/news', 'Market\NewsController');

// Settings
Route::resource('account', 'Account\AccountController');
Route::resource('account/portfolio', 'Account\PortfolioController');

// API
Route::controller('nordnet', '\App\Nordnet\Controllers\NordnetController');

// Auth @todo: Find a better way of setting the basic auth routes
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');