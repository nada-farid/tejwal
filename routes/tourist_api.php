<?php


Route::group(['prefix' => 'tourist', 'as' => 'api.', 'namespace' => 'Api\Tourist', 'middleware' => 'ChangeLanguage'], function () {

    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');

    Route::group(['middleware' => 'auth:sanctum'],function () {

        Route::post('book_trip','BookingController@BookTrip'); 
        Route::get('all_guide','TouristController@AllGuides'); 
        Route::get('guide_details/{guide_id}','TouristController@ShowGuideProfile'); 
        Route::Post('rate','TouristController@RateGuide'); 
        Route::Post('unrate','TouristController@UnRateGuide'); 
        


    
});
});

//genral
Route::group(['prefix' => 'general', 'as' => 'api.', 'namespace' => 'Api', 'middleware' => ['ChangeLanguage','auth:sanctum']], function () {

    Route::get('all_Categories','TripCategoryController@index');

});

