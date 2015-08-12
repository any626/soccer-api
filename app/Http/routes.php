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

Route::get('/home', function(){return "logged in";});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Api Key routes...
Route::get('apikey', 'ApiKey\ApiKeyController@index');
Route::post('apikey/create', 'ApiKey\ApiKeyController@create');
Route::post('apikey/edit', 'ApiKey\ApiKeyController@edit');
Route::post('apikey/delete', 'ApiKey\ApiKeyController@delete');

//File routes...
Route::get('file', 'File\FileController@index');
Route::post('file/upload', 'File\FileController@upload');

//Api routes...
//api routes are exempt from token authentication in the App\Controllers\Kernel.php
Route::get('api/list', 'Api\ApiController@index');
Route::get('api/top', 'Api\ApiController@top');
Route::post('api/create', 'Api\ApiController@create');
Route::post('api/edit/{id}', 'Api\ApiController@edit');
Route::post('api/delete/{id}', 'Api\ApiController@delete');