<?php

//guides

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'guide', 'as' => 'api.', 'namespace' => 'Api\Guide', 'middleware' => ['ChangeLanguage','guide_approved']], function () {

      Route::post('register', 'AuthController@register');
      Route::post('login', 'AuthController@login');
      //reset password
      Route::post('forgetpassword', 'ForgetPasswordController@create_token');
      Route::post('forgetpassword/reset', 'ForgetPasswordController@reset');
      Route::group(['middleware' => ['auth:sanctum']], function () {


            Route::group(['prefix' => 'post', 'middleware' => 'ChangeCurrency'], function () {

                  Route::Post('Apply_trip/{post_id}', 'PostController@Apply');
                  Route::get('all_posts', 'PostController@index');
                  Route::get('show/{post_id}', 'PostController@show');
                  Route::get('search', 'PostController@search');
            });

            Route::group(['prefix' => 'trip'], function () {

                  Route::post('add', 'TripController@store');
                  Route::post('update/{trip_id}', 'TripController@update');
                  Route::delete('delete/{trip_id}', 'TripController@delete');
                  Route::get('MyTrips', 'TripController@MyTrips');
            });

            //Settings Routes
            Route::group(['prefix' => 'settings'], function () { 
                  Route::get('MyProfile', 'SettingsController@Profile');
                  Route::Post('update_profile', 'SettingsController@UpdateProfile');
                  Route::Post('update_guide_trip_categories', 'SettingsController@update_guide_trip_categories');
                  Route::Post('update_guide_languages', 'SettingsController@update_guide_languages');
            });
      });
});
//-------------------------------------------------------------------- tourists

Route::group(['prefix' => 'tourist', 'as' => 'api.', 'namespace' => 'Api\Tourist', 'middleware' => 'ChangeLanguage'], function () {

      //Auth Routes
      Route::post('register', 'AuthController@register');
      Route::post('login', 'AuthController@login');

      Route::group(['middleware' => 'auth:sanctum'], function () {

            //guides_info 
            Route::group(['prefix' => 'guide'], function () {
                  Route::get('all_guide', 'GuideController@AllGuides');
                  Route::get('HighestRating', 'GuideController@HighestRating');
                  Route::get('Following', 'GuideController@Following');
                  Route::get('search', 'GuideController@search');
                  Route::get('guide_details/{guide_id}', 'GuideController@ShowGuideProfile');
                  Route::Post('rate', 'GuideController@RateGuide');
                  Route::Post('unrate', 'GuideController@UnRateGuide');
                  Route::Post('follow', 'GuideController@follow');
                  Route::Post('unfollow', 'GuideController@unfollow');

                  Route::get('guide_trips/{guide_id}', 'GuideController@GuideTrips');
            });

            //trip Routes
            Route::group(['prefix' => 'trip', 'middleware' => 'ChangeCurrency'], function () {
                  Route::get('index', 'TripController@index');
                  Route::get('show/{trip_id}', 'TripController@Show');
                  Route::get('filter', 'TripController@filter');
                  Route::get('new', 'TripController@new');
                  Route::get('cheapest', 'TripController@cheapest');
                  Route::get('pupular', 'TripController@pupular');
                  Route::Post('favorite', 'TripController@favorite');
                  Route::get('unfavorite', 'TripController@unfavorite');
                  Route::get('search', 'TripController@search');
                  Route::get('Myfavorites', 'TripController@MyFavoriteTrips');
                  Route::get('near', 'TripController@NearestTrips');



                  //booking

                  Route::group(['prefix' => 'booking'], function () {
                        Route::get('BookedAppointments', 'BookingController@BookedAppointments');
                        Route::post('add', 'BookingController@store');
                        Route::post('update/{booking_id}', 'BookingController@update');
                        Route::delete('delete/{booking_id}', 'BookingController@delete');
                  });
            });

            //post Routes
            Route::group(['prefix' => 'post', 'middleware' => 'ChangeCurrency'], function () {
                  Route::Post('add', 'PostController@store');
                  Route::get('My_posts', 'PostController@MyPosts');
                  Route::post('update/{post_id}', 'PostController@update');
                  Route::delete('delete/{post_id}', 'PostController@delete');
            });

            //Settings Routes
            Route::group(['prefix' => 'settings'], function () {
                  Route::get('MyProfile', 'SettingsController@Profile');
                  Route::Post('UpdateProfile', 'SettingsController@UpdateProfile');
            });
      });
});

// notifications
Route::group(['prefix' => 'notifications', 'as' => 'api.', 'namespace' => 'Api', 'middleware' => ['ChangeLanguage', 'auth:sanctum']], function () {
      Route::get('all', 'NotificationsApiController@index');
      Route::post('fcm-token', 'NotificationsApiController@update_fcm_token');
});

Route::group(['prefix' => 'conversations', 'as' => 'api.', 'namespace' => 'Api\Conversations', 'middleware' => ['ChangeLanguage', 'auth:sanctum']], function () {

      Route::get('contacts', 'ConversationsController@contacts');
      Route::get('messages/{conversation_id}', 'ConversationsController@messages');

      Route::post('start', 'ConversationsController@start');
      Route::post('send', 'ConversationsController@send');
});

//-------------------------------------------------------------------------------
//general routes
Route::group(['prefix' => 'general', 'as' => 'api.', 'namespace' => 'Api\General', 'middleware' => 'ChangeLanguage'], function () {
      Route::get('all_categories', 'TripCategoryController@index');
      Route::get('all_languages', 'LanguageController@index');
      Route::get('countries', 'GeneralController@countries');
      Route::get('cities/{country_id}', 'GeneralController@cities');
});
