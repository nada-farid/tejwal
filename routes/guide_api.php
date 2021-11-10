<?php


Route::group(['prefix' => 'guide', 'as' => 'api.', 'namespace' => 'Api\Guide', 'middleware' => 'ChangeLanguage'], function () {

    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');

});

Route::group(['prefix' => 'trip','as' => 'api.', 'namespace' => 'Api','middleware' =>['auth:sanctum','ChangeLanguage']],function () {

    Route::post('add','TripController@store');
    Route::get('index','TripController@index');
    Route::get('show/{trip_id}','TripController@Show');


});

