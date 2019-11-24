<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login')->name('login');
    });

    Route::group(['middleware' => ['JWTAuth'], 'prefix' => 'auth'], function () {
        Route::post('logout', 'AuthController@logout');
    });

    Route::group(['middleware' => ['JWTAuth'], 'prefix' => 'educand/{educand}'], function () {
        Route::get('', 'EducandController@show');
        Route::get('track', 'EducandController@track');
        Route::post('track/start', 'EducandController@start');
        Route::post('track/finish', 'EducandController@finish');
        Route::post('track/{task}/help', 'EducandController@help');
    });

    Route::group(['middleware' => ['JWTAuth'], 'prefix' => 'educand/'], function () {
        Route::get('zip/{educand}', 'EducandController@zipfiles');
        Route::get('', 'EducandController@showAll');
    });
});