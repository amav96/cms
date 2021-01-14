<?php 

Route::prefix('/admin')->group(function(){

    Route::get('/','Admin\DashboardController@home');
    Route::get('/users','Admin\UserController@getUsers');

    //module Products

    Route::get('/products', 'Admin\ProductController@home');
    Route::get('/product/create', 'Admin\ProductController@create');
    Route::get('/product/{id}/edit', 'Admin\ProductController@edit');

    Route::post('/product/save', 'Admin\ProductController@save');
    Route::post('/product/{id}/update', 'Admin\ProductController@update');


    //module categories

    Route::get('/categories/{module}', 'Admin\CategoryController@home');
    Route::post('/category/save','Admin\CategoryController@save');
    Route::get('/category/{id}/edit','Admin\CategoryController@edit');
    Route::post('/category/{id}/update','Admin\CategoryController@update');
    Route::get('/category/{id}/delete','Admin\CategoryController@delete');

});