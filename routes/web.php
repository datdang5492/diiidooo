<?php

// ENABLE VUE ROUTING
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', 'SpaController@index')->where('any', '.*');

// ENABLE LARAVEL AUTHENTICATION ROUTES
Auth::routes();

// PROFILE SETTING
Route::post('profile/save', 'UserProfileController@saveProfile')->middleware('auth');
Route::post('profile/get-profile', 'UserProfileController@getProfile')->middleware('auth');


// ADD SHIPMENT
Route::post('get-shipment/stepone', 'AdvertisementController@getStepOne')->middleware('auth');
Route::post('get-shipment/steptwo', 'AdvertisementController@getStepX')->middleware('auth');
Route::post('get-shipment/stepthree', 'AdvertisementController@getStepX')->middleware('auth');
Route::post('get-shipment/stepfive', 'AdvertisementController@getStepX')->middleware('auth');
Route::post('get-shipment/publish', 'AdvertisementController@publish')->middleware('auth');

// SAVE SHIPMENT
Route::post('become-a-shipper/stepone', 'AdvertisementController@saveStepOne')->middleware('auth');        // SAVE SHIPMENT STEP 1
Route::post('become-a-shipper/steptwo', 'AdvertisementController@saveStepTwo')->middleware('auth');        // SAVE SHIPMENT STEP 2
Route::post('become-a-shipper/stepthree', 'AdvertisementController@saveStepThree')->middleware('auth');    // SAVE SHIPMENT STEP 3
Route::post('become-a-shipper/publish', 'AdvertisementController@publish')->middleware('auth');           // SAVE SHIPMENT FINAL STEP
