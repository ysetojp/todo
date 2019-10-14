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
    return redirect()->route('user.login');
});


Route::prefix('user')->namespace('User')->as('user.')->group(function(){

    Auth::routes();

    Route::get('login/{provider}',          'Auth\SocialUserController@redirectToProvider')->name('login.sns');
    Route::get('login/{provider}/callback', 'Auth\SocialUserController@handleProviderCallback')->name('login.callback');

    Route::middleware('auth')->group(function(){

        Route::get('home', 'HomeController@home')->name('home');

    });
});
