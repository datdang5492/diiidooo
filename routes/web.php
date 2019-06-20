<?php

// enable vue routing
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', 'SpaController@index')->where('any', '.*');

Auth::routes();
