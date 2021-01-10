<?php 

Route::prefix('/admin')->group(function(){

    Route::get('/','Admin\DashboardController@home');
    Route::get('/users','Admin\UserController@getUsers');

    //module Products

    Route::get('/products', 'Admin\ProductController@home');
    Route::get('/product/add', 'Admin\ProductController@create');

});