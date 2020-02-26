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

Route::domain(env('APP_DOMAIN', 'app.kingdomcaresitters.com'))->middleware('auth:api')->group(function() {
    Route::prefix('users')->group(function() {
        Route::get('/', 'API\DashboardController@getUsers')->name('api.users');
        Route::get('/{user}', 'API\DashboardController@getUser')->name('api.user');
        Route::match(['put', 'patch'], '/{user}/update', 'API\DashboardController@updateUser')->name('api.user.update');
        Route::get('/{user}/reset', 'API\DashboardController@resetPassword')->name('api.user.reset');
        Route::get('/{user}/delete', 'API\DashboardController@deleteUser')->name('api.user.delete');
    });


    Route::prefix('dashboard')->group(function() {
        Route::get('newSignups', 'API\DashboardController@newSignups');
    });

});
