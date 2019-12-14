<?php

Route::get('/', 'HomeController@index');

Route::get('/users/all', 'UsersController@index')->name('users.all');
Route::get('/products/all', 'ProductController@index')->name('products.all');

Route::get('search', 'SearchController@index')->name('search');

Route::get('orders', 'OrderController@index')->name('orders.all');
Route::post('orders', 'OrderController@store')->name('orders');
Route::patch('orders/{order}/update', 'OrderController@update')->name('orders.update');
Route::delete('orders/{order}/delete', 'OrderController@destroy')->name('orders.delete');
