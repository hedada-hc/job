<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','IndexController@index');
Route::get('/play/{id}','IndexController@play');
Route::get('/search','IndexController@search');
Route::any('/up','UpController@index');
Route::any('/uptoken','UpController@token');
