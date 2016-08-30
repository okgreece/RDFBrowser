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

Route::group(['middlewareGroups' => ['web']], function () {
    //
Route::auth();

Route::get('/admin', 'AdminController@adminPanel')->name('admin');

Route::get('/dashboard', 'AdminController@adminPanel')->name('dashboard');

    
    Route::resource('geo-extractor', 'GeoExtractorController');

    Route::resource('endpoint', 'EndpointController');

    Route::resource('rdfnamespace', 'rdfnamespaceController');

    Route::resource('abstract-extractor', 'AbstractExtractorController');

    Route::resource('label-extractor', 'LabelExtractorController');

    Route::resource('image-extractor', 'ImageExtractorController');

    Route::resource('user', 'UserController');




});

Route::group(['prefix'=>'admin','middleware' => ['web']], function () {

});

Route::get('/login', 'Auth\LogInController@login')->name('login');

if(config('app.registration')){
    Route::get('/register', 'Auth\RegisterController@register')->name('register');
}


Route::get('resource/{section}', 'ResourceController@negotiation')->name('negotiation')->where(['section' => '.*']);

Route::get('resource', 'ResourceController@noResource')->name('noResource');

Route::get('page/{section}', 'ResourceController@page')->name('page')->where(['section' => '.*']);

Route::get('data/{section}', 'DataController@data')->name('data')->where(['section' => '.*']);

Route::get('browser', 'BrowserController@browser')->name('browser');

