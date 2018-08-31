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

Auth::routes();

Route::get('/api/sellers', 'SellerController@getSellers');
Route::get('/api/products', 'ProductController@getProducts');
Route::post('/api/truck-loads', 'TruckLoadController@storeTruckLoadProducts');
Route::get('/api/truck-loads-by-date/{from_date}/{to_date}', 'TruckLoadController@getTruckLoadByDate');
Route::post('/api/purchase-orders', 'PurchaseOrderController@storePurchaseOrder');
Route::get('/api/purchase-orders-by-date/{from_date}/{to_date}', 'PurchaseOrderController@getPurchaseOrderByDate');
Route::post('api/store-clearings', 'ClearingController@storeClearing');
Route::put('api/books/{id}', 'BookController@update');

Route::get('seller-product-bag/{id}', 'SellerController@getSellerBag')->name('sellers.inventory');
Route::get('seller-clearing/{id}', 'SellerController@storeSellerClearing')->name('sellers.clearing');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('sellers', 'SellerController');
Route::resource('products', 'ProductController');
Route::resource('truck-loads', 'TruckLoadController');
Route::resource('purchase-orders', 'PurchaseOrderController');
Route::get('clearings/{id}', 'ClearingController@index')->name('clearings.index');
Route::put('clearings/{id}', 'ClearingController@update')->name('clearings.update');
Route::get('clearings/{id}/show', 'ClearingController@show')->name('clearings.show');
Route::get('clearings/{id}/create', 'ClearingController@create')->name('clearings.create');
Route::get('books/{id}', 'BookController@index')->name('books.index');
Route::get('books/{id}/show', 'BookController@show')->name('books.show');