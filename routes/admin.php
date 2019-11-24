<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/**
 * Auth routes
 */

Auth::routes();


/**
 * Reset Password
 */
//Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('resetPassword');


Route::group(['middleware' => ['auth_admin', 'sidebar']], function () {

	/**
	 * Dashboard
	 */

	Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');
    Route::get('barcode', 'BarcodeController@barcode');

	/**
	 * Profile
	 */

	Route::group(['prefix' => 'profile'], function () {
		Route::get('/', 'Profile\ProfileController@index')->name('profile');
		Route::post('update', 'Profile\ProfileController@update');
		Route::post('change-password', 'Profile\ProfileController@changePassword');
	});

	/**
	 * Logout
	 */
	Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	/**
     * APP ROUTES
     */

	/**
     * Admins Management
     */

    Route::group(['prefix' => 'admins', 'as' => 'admins-management.', 'middleware' => 'permissions:Admin,Site Builder,Helper'], function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('data', 'AdminController@getTableQuery')->name('get-data');
        Route::get('create', 'AdminController@select')->name('select');
        Route::get('{adminId}', 'AdminController@show')->name('show');
        Route::post('/save/{adminId?}', 'AdminController@save')->name('save');
        Route::get('{adminId}/reset', 'AdminController@reset')->name('reset');
        Route::post('{adminId}/reset', 'AdminController@resetPassword')->name('resetPassword');
    });

    /**
     * Educands Management
     */

    Route::group(['prefix' => 'educands', 'as' => 'educands-management.', 'middleware' => 'permissions:Admin,Helper'], function () {
        Route::get('/', 'Educands\EducandController@index')->name('index');
        Route::get('/data', 'Educands\EducandController@getEducandsTableQuery')->name('get-data');
        Route::get('/create/{educandId?}', 'Educands\EducandController@create')->name('create');
        Route::post('/save/{educand?}', 'Educands\EducandController@save')->name('save-educand');
        Route::get('/{educandId}/delete', 'Educands\EducandController@delete')->name('delete');


    });

    /**
     * Sites Management
     */

    Route::group(['prefix' => 'sites', 'as' => 'sites-management.', 'middleware' => ['permissions:Admin,Site Builder,Helper','web']], function () {
        Route::get('/', 'AdminController@sites')->name('index');
        Route::get('/data', 'Sites\SiteController@getTableQuery')->name('get-data');
        Route::get('/create', 'Sites\SiteController@createSite')->name('create');
        Route::get('/{siteId}', 'Sites\SiteController@showSite')->name('show');
        Route::post('/save/{site?}', 'Sites\SiteController@saveSite')->name('save');
        Route::post('/saveNew/', 'Sites\SiteController@saveNewSite')->name('save-new');
        Route::get('/{siteId}/delete', 'Sites\SiteController@deleteSite')->name('delete-site');
        Route::get('/{siteId}/toggle-active', 'Sites\SiteController@toggleActive')->name('toggle');

        Route::get('/{siteId}/stations', 'Stations\StationController@showSitesStations')->name('show-stations');
        Route::get('/{siteId}/stations/create', 'Stations\StationController@createStation')->name('create-station');
        Route::get('/{siteId}/stations/{stationId}', 'Stations\StationController@editStation')->name('edit-station');
        Route::get('/{siteId}/stations/{stationId}/delete', 'Stations\StationController@deleteStation')->name('delete-station');
        Route::post('/{siteId}/stations/save/{stationId?}', 'Stations\StationController@saveStation')->name('save-station');
        Route::post('/{siteId}/stations/saveNew/', 'Stations\StationController@saveNewStation')->name('save-new-station');

        Route::post('/{siteId}/stations/sort', 'Stations\StationController@sortStations')->name('sort-stations');

        Route::post('/getStations', 'Stations\StationController@getStations')->name('get-stations');

    });

    /**
     * Tasks Management
     */

    Route::group(['prefix' => 'tasks', 'as' => 'tasks-management.', 'middleware' => ['permissions:Admin,Helper,Site Builder','web']], function () {
        Route::get('/', 'Tasks\TaskController@index')->name('index');
        Route::get('/data', 'Tasks\TaskController@getTasksTableQuery')->name('get-data');
        Route::get('/create/{stationId?}', 'Tasks\TaskController@createTask')->name('create');

        Route::get('/{taskId}', 'Tasks\TaskController@showTask')->name('show-task');
        Route::post('/save/{task?}', 'Tasks\TaskController@saveTask')->name('save-task');
        Route::post('/saveNew/', 'Tasks\TaskController@saveNewTask')->name('save-new-task');
        Route::get('/{taskId}/delete', 'Tasks\TaskController@deleteTask')->name('delete-task');

        Route::post('/getStationTasks', 'Tasks\TaskController@getStationTasks')->name('get-station-tasks');

    });

    /**
     * Tracks Management
     */

    Route::group(['prefix' => 'tracks', 'as' => 'tracks-management.', 'middleware' => ['permissions:Admin,Helper','web']], function () {
        Route::get('/', 'Tracks\TrackController@index')->name('index');
        Route::get('/data', 'Tracks\TrackController@getTracksTableQuery')->name('get-data');
        Route::post('/set-public', 'Tracks\TrackController@setPublic')->name('set-public');
        Route::get('/create', 'Tracks\TrackController@createTrack')->name('create');
        Route::post('/getTask', 'Tracks\TrackController@getTask')->name('get-task');
        Route::get('/{trackId}', 'Tracks\TrackController@showTrack')->name('show-track');
        Route::post('/save/{track?}', 'Tracks\TrackController@saveTrack')->name('save-track');
        Route::post('/saveNew/', 'Tracks\TrackController@saveNewTrack')->name('save-new-track');
        Route::get('/{trackId}/delete', 'Tracks\TrackController@deleteTrack')->name('delete-track');
        Route::post('/{trackId}/assign', 'Tracks\TrackController@assign')->name('assign');

    });
});