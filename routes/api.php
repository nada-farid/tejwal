<?php

//guides
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
        Route::get('MyTrips','TripController@MyTrips');
        



               });

               });

               });
//-------------------------------------------------------------------- tourists

               Route::group(['prefix' => 'tourist', 'as' => 'api.', 'namespace' => 'Api\Tourist', 'middleware' => 'ChangeLanguage'], function () {
               
                //Auth Routes
                     Route::post('register','AuthController@register');
                     Route::post('login','AuthController@login');
      
      Route::group(['middleware' => 'auth:sanctum'],function () {
      
                    //guides_info 
              Route::group(['prefix' => 'guide'],function(){
                      Route::get('all_guide','GuideController@AllGuides'); 
                      Route::get('HighestRating','GuideController@HighestRating'); 
                      Route::get('Following','GuideController@Following'); 
                      Route::get('search','GuideController@search'); 
                      Route::get('guide_details/{guide_id}','GuideController@ShowGuideProfile'); 
                      Route::Post('rate','GuideController@RateGuide'); 
                      Route::Post('unrate','GuideController@UnRateGuide'); 
                      Route::Post('follow','GuideController@follow'); 
                      Route::Post('unfollow','GuideController@unfollow');
                        
                      Route::get('guide_trips/{guide_id}','GuideController@GuideTrips'); 
              });
      
              //trip Routes
              Route::group(['prefix' => 'trip'],function(){  
                      Route::get('index','TripController@index');
                      Route::get('show/{trip_id}','TripController@Show');
                      Route::get('filter','TripController@filter');
                      Route::get('new','TripController@new');
                      Route::get('cheapest','TripController@cheapest');
                      Route::get('pupular','TripController@pupular');
                      Route::Post('favorite','TripController@favorite');
                      Route::get('unfavorite','TripController@unfavorite');
                      Route::get('search','TripController@search');
                      
                       
                       
                       //booking
                      
             Route::group(['prefix' => 'booking'],function(){  
                              Route::post('add','BookingController@store');
                              Route::post('update/{booking_id}','BookingController@update');
                              Route::delete('delete/{booking_id}','BookingController@delete');
             });
      
             });
      
                     //post Routes
              Route::group(['prefix' => 'post'],function(){
                       Route::Post('add','PostController@store');
                       Route::get('My_posts','PostController@MyPosts');
                       Route::post('update/{post_id}','PostController@update');
                       Route::delete('delete/{post_id}','PostController@delete');
                         
              });
      
               //Settings Routes
              Route::group(['prefix' => 'settings'],function(){
                  Route::get('MyProfile','SettingsController@Profile');
                  Route::Post('update_profile','SettingsController@UpdateProfile');
                
                    
              });
      
                    //general routes
              Route::group(['prefix' => 'general'],function(){    
                       Route::get('all_Categories','TripCategoryController@index');
                       Route::get('all_languages','LanguageController@index');
      
              });
      
      
              });
              });