<?php

// ENABLE VUE ROUTING
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Route::get('/', 'SpaController@index')->where('any', '.*');

// ENABLE LARAVEL AUTHENTICATION ROUTES
Auth::routes();

// PROFILE SETTING
Route::post('profile/save', 'UserProfileController@saveProfile')->middleware('auth');
Route::post('profile/get-profile', 'UserProfileController@getProfile')->middleware('auth');


// GET SHIPMENT DATA
Route::post('get-shipment', 'AdvertisementController@getShipment')->middleware('auth');
Route::post('get-step-one', 'AdvertisementController@getStepOne')->middleware('auth');

// SAVE SHIPMENT
Route::post('become-a-shipper/save/0', 'AdvertisementController@saveStepOne')->middleware('auth');      // SAVE SHIPMENT STEP 1
Route::post('become-a-shipper/save/1', 'AdvertisementController@saveStepTwo')->middleware('auth');      // SAVE SHIPMENT STEP 2
Route::post('become-a-shipper/save/2', 'AdvertisementController@saveStepThree')->middleware('auth');    // SAVE SHIPMENT STEP 3
Route::post('become-a-shipper/publish', 'AdvertisementController@publish')->middleware('auth');         // PUBLISH SHIPMENT
