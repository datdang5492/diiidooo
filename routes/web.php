<?php

// enable vue routing
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', 'SpaController@index')->where('any', '.*');

// enable default laravel authentication routes
Auth::routes();

// save user profile
Route::post('profile/save', 'UserProfileController@saveProfile')->middleware('auth');
