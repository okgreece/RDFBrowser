<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
Route::auth();

Route::get('/admin', 'AdminController@adminPanel')->name('admin');


Route::get('/dashboard', 'AdminController@adminPanel')->name('dashboard');

//Route::when('resource/*', 'resource');
Route::resource('geo-extractor', 'GeoExtractorController');

});

Route::get('/login', 'Auth\LogInController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@register')->name('register');

Route::get('resource/{section}', 'ResourceController@negotiation')->name('negotiation')->where(['section' => '.*']);

Route::get('resource', 'ResourceController@noResource')->name('noResource');

Route::get('page/{section}', 'ResourceController@page')->name('page')->where(['section' => '.*']);

Route::get('data/{section}', 'DataController@data')->name('data')->where(['section' => '.*']);

Route::get('browser', 'BrowserController@browser')->name('browser');
