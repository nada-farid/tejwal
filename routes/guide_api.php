<?php


Route::group(['prefix' => 'guide', 'as' => 'api.', 'namespace' => 'Api\Guide', 'middleware' => 'ChangeLanguage'], function () {

      Route::post('register','AuthController@register');
      Route::post('login','AuthController@login');

 Route::group(['middleware' => ['auth:sanctum']],function () {

        
    Route::group(['prefix' => 'post'],function(){

         Route::Post('Apply_trip/{post_id}','PostController@Apply');
         Route::get('all_posts','PostController@index');
         Route::get('show/{post_id}','PostController@show');
         


    });

    Route::group(['prefix' => 'trip'],function(){
              
        Route::post('add','TripController@store');
        Route::post('update/{trip_id}','TripController@update');
        Route::delete('delete/{trip_id}','TripController@delete');



               });

               });

               });




