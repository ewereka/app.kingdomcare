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


Route::domain(env('APP_DOMAIN', 'app.kingdomcaresitters.com'))->group(function() {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    })->name('index');

    Auth::routes();
    Route::get('/register/next', 'UserController@continueRegistration')->name('register.next');
    Route::get('/register/{role}', 'Auth\RegisterController@showRoleRegistrationForm')->name('register.role');


    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/users', 'UserController@index')->middleware('can:viewAll,App\User')->name('users');

    Route::get('/search', function(Request $request) {
        return view('app.search.results');
    });

    Route::prefix('me')->middleware('auth')->group(function () {
        Route::get('', 'UserController@view')->name('profile.self');
        Route::get('edit', 'UserController@edit')->name('profile.self.edit');
    });

    // Form Handlers
    Route::match(['put', 'patch'], '/user/{user}/select-role', 'UserController@selectRole')->middleware('can:update,user')->name('user.select-role');
    Route::match(['put', 'patch'], '/users/{user}/update', 'UserController@update')->middleware('can:update,user')->name('user.update');

    // OAuth Routes
    Route::prefix('oauth')->group(function() {
        Route::get('{provider}/login', 'Auth\LoginController@redirectToProvider')
            ->where('provider', env('OAUTH_ALLOWED_ENGINES'))->name('oauth.login');
        Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback')
            ->where('provider', env('OAUTH_ALLOWED_ENGINES'))->name('oauth.callback');
    });
    Route::get('login/fail', function() {
        return "OAuth Failure";
    })->name('oauth.failure');

    // Testing Purposes
    Route::get('/test', function() {
        dd(wowzers());
    });
});

