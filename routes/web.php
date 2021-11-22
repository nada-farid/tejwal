<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Language
    Route::delete('languages/destroy', 'LanguageController@massDestroy')->name('languages.massDestroy');
    Route::post('languages/media', 'LanguageController@storeMedia')->name('languages.storeMedia');
    Route::post('languages/ckmedia', 'LanguageController@storeCKEditorImages')->name('languages.storeCKEditorImages');
    Route::resource('languages', 'LanguageController');

    // Guide
    Route::delete('guides/destroy', 'GuideController@massDestroy')->name('guides.massDestroy');
    Route::resource('guides', 'GuideController');

    // Experience
    Route::delete('experiences/destroy', 'ExperienceController@massDestroy')->name('experiences.massDestroy');
    Route::resource('experiences', 'ExperienceController')->except([
        'create']);
    Route::get('experiences/create/{id}','ExperienceController@create')->name('experiences.create');  


    // Following
    Route::delete('followings/destroy', 'FollowingController@massDestroy')->name('followings.massDestroy');
    Route::resource('followings', 'FollowingController');

    // Ratting
    Route::delete('rattings/destroy', 'RattingController@massDestroy')->name('rattings.massDestroy');
    Route::resource('rattings', 'RattingController');

    // Trip Category
    Route::delete('trip-categories/destroy', 'TripCategoryController@massDestroy')->name('trip-categories.massDestroy');
    Route::resource('trip-categories', 'TripCategoryController');

    // Trips
    Route::delete('trips/destroy', 'TripsController@massDestroy')->name('trips.massDestroy');
    Route::post('trips/media', 'TripsController@storeMedia')->name('trips.storeMedia');
    Route::post('trips/ckmedia', 'TripsController@storeCKEditorImages')->name('trips.storeCKEditorImages');
    Route::resource('trips', 'TripsController');

    // Posts
    Route::delete('posts/destroy', 'PostsController@massDestroy')->name('posts.massDestroy');
    Route::resource('posts', 'PostsController');

    // Booking
    Route::delete('bookings/destroy', 'BookingController@massDestroy')->name('bookings.massDestroy');
    Route::resource('bookings', 'BookingController');

    // Favorite
    Route::delete('favorites/destroy', 'FavoriteController@massDestroy')->name('favorites.massDestroy');
    Route::resource('favorites', 'FavoriteController');

    // Tourist
    Route::delete('tourists/destroy', 'TouristController@massDestroy')->name('tourists.massDestroy');
    Route::resource('tourists', 'TouristController');

      // User Alerts
      Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
      Route::get('user-alerts/read', 'UserAlertsController@read');
      Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

   
 });


Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
