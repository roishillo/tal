<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::group([
], function () {
    Route::get('admins/password/reset/{token}', 'App\Http\Controllers\Admin\AdminController@passwordReset')->name('password.reset');
    Route::post('admins/password/reset', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@reset')->name('password.request');

});



