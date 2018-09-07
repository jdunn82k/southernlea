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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@catIndex');

Route::get('/product/{id}', 'ProductController@showProduct');
Route::get('/product_table/{sort}', 'ProductController@getProductTable');
Route::post('/product_table', 'ProductController@getProducts');

Route::put('/cart/add', 'CartController@addToCart');
Route::get('/cart/stats', 'CartController@getStats');
Route::delete('/cart/', 'CartController@emptyCart');

Route::get('/cart', 'CartController@showCart');
Route::post('/cart/delete', 'CartController@removeCartItem');

Route::get('/checkout', 'CartController@checkOut');

Route::post('/orders', 'CartController@createOrder');

Route::get('/thankyou', 'CartController@thankYou');

Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@adminAuth');





Route::group(['middleware' => 'auth.admin'], function()
{
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/logout', 'AdminController@logout');

    Route::get('/admin/products', 'AdminController@products');
    Route::get('/admin/products/{id}', 'AdminController@showProduct');

});