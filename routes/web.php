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

Route::get('/product/size/{sid}', 'ProductController@getProductSizes');





Route::group(['middleware' => 'auth.admin'], function()
{
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/logout', 'AdminController@logout');

    Route::get('/admin/products', 'AdminController@products');
    Route::get('/admin/products/{id}', 'AdminController@showProduct');
    Route::get('/admin/product/new/', 'AdminController@showNewProductForm');
    Route::delete('/admin/products/', 'AdminController@deleteProducts');

    Route::get('/admin/orders', 'AdminController@showOrders');
    Route::get('/admin/order/{id}', 'AdminController@showOrder');
    Route::post('/admin/order/complete', 'AdminController@completeOrder');

    Route::post('/admin/product/image', 'AdminController@addProductImage');
    Route::post('/admin/product/image_2', 'AdminController@addProductImageNewProduct');

    Route::delete('/admin/product/image', 'AdminController@removeProductImages');

    Route::post('/admin/product/update', 'AdminController@updateProduct');
    Route::post('/admin/product/new', 'AdminController@newProduct');

    Route::post('/admin/image/rotate1', 'AdminController@rotateImage1');
});