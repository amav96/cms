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
    return view('welcome');
});


//Router Auth

Route::get('/login','UserController@login')->name('login');
Route::post('/login','UserController@authenticate')->name('login');

Route::get('/register','UserController@register')->name('register');
Route::post('/register','UserController@create')->name('create');

Route::get('/logout','UserController@logout')->name('logout');


