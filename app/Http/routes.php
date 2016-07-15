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

Route::get('/', function () {
    return view('welcome');
});

Route::get('resource/{section}', 'ResourceController@negotiation')->name('negotiation')->where(['section' => '.*']);

Route::get('resource', 'ResourceController@noResource')->name('noResource');

Route::get('page/{section}', 'ResourceController@page')->name('page')->where(['section' => '.*']);

Route::get('data/{section}', 'DataController@data')->name('data')->where(['section' => '.*']);

Route::get('browser', 'ResourceController@browser')->name('browser');

//Route::when('resource/*', 'resource');
