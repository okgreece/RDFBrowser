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

Route::group(['prefix'=>'RDFBrowser' ,'middlewareGroups' => ['web']], function () {
    //


Route::get('/admin', 'AdminController@adminPanel')->name('admin');

Route::get('/dashboard', 'AdminController@adminPanel')->name('dashboard');

    
    Route::resource('geo-extractor', 'GeoExtractorController', 
            array('names' => array ('create' => 'geo-extractor.create',
                                    'show' => 'geo-extractor.show',
                                    'index'=> 'geo-extractor.index',
                                    'store' => 'geo-extractor.store',
                                    'update' => 'geo-extractor.update',
                                    'edit' => 'geo-extractor.edit',
                                    'destroy' => 'geo-extractor.destroy')));

    Route::resource('endpoint', 'EndpointController', 
            array('names' => array ('create' => 'endpoint.create',
                                    'show' => 'endpoint.show',
                                    'index'=> 'endpoint.index',
                                    'store' => 'endpoint.store',
                                    'update' => 'endpoint.update',
                                    'edit' => 'endpoint.edit',
                                    'destroy' => 'endpoint.destroy')));

    Route::resource('rdfnamespace', 'rdfnamespaceController', 
            array('names' => array ('create' => 'rdfnamespace.create',
                                    'show' => 'rdfnamespace.show',
                                    'index'=> 'rdfnamespace.index',
                                    'store' => 'rdfnamespace.store',
                                    'update' => 'rdfnamespace.update',
                                    'edit' => 'rdfnamespace.edit',
                                    'destroy' => 'rdfnamespace.destroy')));

    Route::resource('abstract-extractor', 'AbstractExtractorController', 
            array('names' => array ('create' => 'abstract-extractor.create',
                                    'show' => 'abstract-extractor.show',
                                    'index'=> 'abstract-extractor.index',
                                    'store' => 'abstract-extractor.store',
                                    'update' => 'abstract-extractor.update',
                                    'edit' => 'abstract-extractor.edit',
                                    'destroy' => 'abstract-extractor.destroy')));

    Route::resource('label-extractor', 'LabelExtractorController', 
            array('names' => array ('create' => 'label-extractor.create',
                                    'show' => 'label-extractor.show',
                                    'index'=> 'label-extractor.index',
                                    'store' => 'label-extractor.store',
                                    'update' => 'label-extractor.update',
                                    'edit' => 'label-extractor.edit',
                                    'destroy' => 'label-extractor.destroy')));

    Route::resource('image-extractor', 'ImageExtractorController', 
            array('names' => array ('create' => 'image-extractor.create',
                                    'show' => 'image-extractor.show',
                                    'index'=> 'image-extractor.index',
                                    'store' => 'image-extractor.store',
                                    'update' => 'image-extractor.update',
                                    'edit' => 'image-extractor.edit',
                                    'destroy' => 'image-extractor.destroy')));

    Route::resource('user', 'UserController', 
            array('names' => array ('create' => 'user.create',
                                    'show' => 'user.show',
                                    'index'=> 'user.index',
                                    'store' => 'user.store',
                                    'update' => 'user.update',
                                    'edit' => 'user.edit',
                                    'destroy' => 'user.destroy')));

Route::auth();

Route::get('/login', 'Auth\LogInController@login')->name('login');

if(config('app.registration')){
    Route::get('/register', 'Auth\RegisterController@register')->name('register');
}

Route::get('browser', 'BrowserController@browser')->name('browser');


});

Route::group(['middleware' => ['web']], function () {
    

});

Route::post('getLabel', 'BrowserController@getLabel')->name('getLabel');

Route::get('resource/{section}', 'ResourceController@negotiation')->name('negotiation')->where(['section' => '.*']);

Route::get('resource', 'ResourceController@noResource')->name('noResource');

Route::get('page/{section}', 'ResourceController@page')->name('page')->where(['section' => '.*']);

Route::get('data/{section}', 'DataController@data')->name('data')->where(['section' => '.*']);

Route::get('ontology/{section}', 'ResourceController@negotiation')->name('negotiation')->where(['section' => '.*']);

Route::get('ontology', 'ResourceController@noResource')->name('noResource');

Route::get('page2/{section}', 'ResourceController@page')->name('page2')->where(['section' => '.*']);

Route::get('data2/{section}', 'DataController@data')->name('data2')->where(['section' => '.*']);

