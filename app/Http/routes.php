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


Route::get('/home', 'HomeController@index');

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@store');


Route::get('/logout','LoginController@logout');

Route::get('/register', 'RegisterController@index');

Route::post('/register','RegisterController@store');


// xu li cai confirm code
Route::get('/register/verify/{confirmationCode}','RegisterController@confirm');