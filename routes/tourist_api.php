<?php


Route::group(['prefix' => 'tourist', 'as' => 'api.', 'namespace' => 'Api\Tourist', 'middleware' => 'ChangeLanguage'], function () {

    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
});