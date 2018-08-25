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

Route::get('/product/{id}', 'ProductController@showProduct');
Route::get('/product_table/{sort}', 'ProductController@getProductTable');
Route::post('/product_table', 'ProductController@getProducts');