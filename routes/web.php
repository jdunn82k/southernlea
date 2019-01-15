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
use Illuminate\Http\Request;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');
Route::post('/', 'HomeController@catIndex');

Route::get('/location', function () {return view('pages.location'); } );
Route::get('/hempworx', function () {return view('pages.hempworx'); } );

Route::get('/product/{id}', 'ProductController@showProduct');
Route::get('/product_table/{sort}', 'ProductController@getProductTable');
Route::post('/product_table', 'ProductController@getProducts');

Route::put('/cart/add', 'CartController@addToCart');
Route::get('/cart/stats', 'CartController@getStats');
Route::delete('/cart/', 'CartController@emptyCart');
Route::post('/cart/addspecial', 'CartController@addToCartSpecial');
Route::get('/cart/shipping', 'CartController@getShippingCost');

Route::get('/cart', 'CartController@showCart');
Route::post('/cart/delete', 'CartController@removeCartItem');

Route::get('/checkout', 'CartController@checkOut');

Route::post('/orders', 'CartController@createOrder');

Route::get('/thankyou', 'CartController@thankYou');

Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@adminAuth');

Route::get('/product/size/{sid}', 'ProductController@getProductSizes');

Route::get('/custom', 'CustomController@index');
Route::get('/custom/{type}', 'CustomController@getDropdown');


Route::get('/user', function(Request $request) {


})->middleware('client');


Route::group(['middleware' => 'auth.admin'], function()
{
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/logout', 'AdminController@logout');

    Route::get('/admin/expenses', 'ExpensesController@showExpenses');
    Route::delete('/admin/expenses', 'ExpensesController@deleteExpenses');
    Route::put('/admin/expenses', 'ExpensesController@updateExpense');
    Route::post('/admin/expenses/export', 'ExpensesController@export');
    Route::get('/admin/expense/{id}', 'ExpensesController@getExpenseById');
    Route::get('/admin/income/{id}', 'ExpensesController@getIncomeById');
    Route::post('/admin/expenses', 'ExpensesController@addExpense');
    Route::post('/admin/expenses/table', 'ExpensesController@getExpensesTable');

    Route::get('/admin/products', 'AdminController@products');
    Route::get('/admin/products/{id}', 'AdminController@showProduct');
    Route::get('/admin/product/new/', 'AdminController@showNewProductForm');
    Route::delete('/admin/products/', 'AdminController@deleteProducts');

    Route::get('/admin/orders', 'AdminController@showOrders');
    Route::get('/admin/order/{id}', 'AdminController@showOrder');
    Route::post('/admin/order/complete', 'AdminController@completeOrder');

    Route::post('/admin/product/image', 'AdminController@addProductImage');
    Route::post('/admin/product/image_2', 'AdminController@addProductImageNewProduct');
    Route::post('/admin/product/image_3', 'AdminController@addSpecialImage');

    Route::delete('/admin/product/image', 'AdminController@removeProductImages');

    Route::post('/admin/product/update', 'AdminController@updateProduct');
    Route::post('/admin/product/new', 'AdminController@newProduct');
    Route::post('/admin/product/export', 'AdminController@exportProducts');

    Route::post('/admin/product/getcat', 'AdminController@getCats');
    Route::post("/admin/product/getlinks", 'AdminController@getLinks');

    Route::post('/admin/reports/netincome', 'ExpensesController@showNetIncome');

    Route::post('/admin/image/rotate1', 'AdminController@rotateImage1');
    Route::get('/admin/image/{product}', 'AdminController@getImages');

    Route::get('/admin/categories', 'AdminController@categories');
    Route::post('/admin/categories/add', 'AdminController@addCategory');
    Route::post('/admin/categories/check', 'AdminController@checkSubCat');
    Route::post('/admin/categories/update', 'AdminController@updateCategory');
    Route::post('/admin/categories/delete', 'AdminController@deleteCat');
    Route::post('/admin/categories/delete2', 'AdminController@deleteCat2');
    Route::post('/admin/categories/addcat', 'AdminController@addSubCat');

    Route::get('/admin/specials', 'AdminController@specials');
    Route::post('/admin/special/add', 'AdminController@addSpecial');
    Route::get('/admin/special/get/{id}', 'AdminController@getSpecial');
    Route::post('/admin/special/update', 'AdminController@updateSpecial');
    Route::post('/admin/special/remove', 'AdminController@removeSpecials');

    Route::post('/admin/removeimage', 'AdminController@removeImage');
});