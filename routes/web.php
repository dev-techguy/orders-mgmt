<?php

Route::get('/', 'HomeController@index');

Route::get('/users/all', 'UsersController@index')->name('users.all');
Route::get('/products/all', 'ProductController@index')->name('products.all');

Route::get('orders', 'OrderController@index')->name('orders.all');
Route::post('orders', 'OrderController@store')->name('orders');
Route::delete('orders/{order}/delete', 'OrderController@destroy')->name('orders.delete');
