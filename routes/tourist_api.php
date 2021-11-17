
<?php


Route::group(['prefix' => 'tourist', 'as' => 'api.', 'namespace' => 'Api\Tourist', 'middleware' => 'ChangeLanguage'], function () {
               
          //Auth Routes
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');

Route::group(['middleware' => 'auth:sanctum'],function () {

                //guides_info Routes
        Route::group(['prefix' => 'guide'],function(){
                Route::get('all_guide','GuideController@AllGuides'); 
                Route::get('guide_details/{guide_id}','GuideController@ShowGuideProfile'); 
                Route::Post('rate','GuideController@RateGuide'); 
                Route::Post('unrate','GuideController@UnRateGuide'); 
                Route::get('guide_trips/{guide_id}','GuideController@GuideTrips'); 
        });

               //trip Routes
        Route::group(['prefix' => 'trip'],function(){  
                Route::get('index','TripController@index');
                Route::get('show/{trip_id}','TripController@Show');
                Route::get('filter','TripController@filter');
                Route::post('book_trip','BookingController@BookTrip'); 

        });

               //post Routes
        Route::group(['prefix' => 'post'],function(){
                 Route::Post('add_post','PostController@store');
                 Route::get('My_posts','PostController@MyPosts');
                   
        });

         //Settings Routes
        Route::group(['prefix' => 'settings'],function(){
            Route::get('MyProfile','SettingsController@Profile');
          
              
   });

              //general routes
        Route::group(['prefix' => 'general'],function(){    
                 Route::get('all_Categories','TripCategoryController@index');

        });


});
});