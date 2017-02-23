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

Route::get('/', 'ProductController@index');
Route::get('/home', 'ProductController@index')->name('home.index');
Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/products/{product}', 'ProductController@show')->name('product.show');

Route::post('/cart/clear', 'CartController@clear')->name('cart.clear');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'CartController@store')->name('cart.store');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');

Route::get('/order/create', 'OrderController@create')->name('order.create');
Route::post('/order', 'OrderController@store')->name('order.store');
Route::get('/order/{order}', 'OrderController@show')->name('order.show');


Route::get('/dashboard', 'UserOrderController@index')->name('dashboard');
Route::get('/dashboard/payments', 'UserPaymentController@index')->name('dashboard.payments');

Auth::routes();