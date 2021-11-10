<?php


Route::group(['prefix' => 'tourist', 'as' => 'api.', 'namespace' => 'Api\Tourist', 'middleware' => 'ChangeLanguage'], function () {

    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');

    Route::group(['middleware' => 'auth:sanctum'],function () {

        Route::post('book_trip','BookingController@BookTrip');    

    
});
});

//genral
Route::group(['prefix' => 'general', 'as' => 'api.', 'namespace' => 'Api', 'middleware' => ['ChangeLanguage','auth:sanctum']], function () {

    Route::get('all_Categories','TripCategoryController@index');

});

