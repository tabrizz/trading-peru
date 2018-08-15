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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('sellers', 'SellerController');
Route::resource('products', 'ProductController');
Route::resource('truck-loads', 'TruckLoadController');