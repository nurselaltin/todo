<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/','TodoController@index')->name('shoplists');
Route::get('/alisveris-listeleri','TodoController@index')->name('shoplists');
Route::get('/add-shop-title','TodoController@addShoptitle')->name('add.shop.title');
Route::get('/remove-list','TodoController@removeList')->name('remove.list');
Route::get('/change-list-status','TodoController@changeListStatus')->name('change.list.status');


Route::get('/add-product-page/{id}','TodoController@addProductPage')->name('add.product.page');
Route::get('/add-product','TodoController@addProduct')->name('add.product');
Route::get('/remove-product','TodoController@removeProduct')->name('remove.product');
Route::get('/change-product-status','TodoController@changeProductStatus')->name('change.product.status');