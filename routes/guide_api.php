<?php


Route::group(['prefix' => 'guide', 'as' => 'api.', 'namespace' => 'Api\Guide', 'middleware' => 'ChangeLanguage'], function () {

    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');



Route::group(['middleware' => ['auth:sanctum']],function () {

    Route::post('trip/add','TripController@store');


});

});