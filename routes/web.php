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
Route::get('/','ShopController@shop');

// Auth
Route::get('register','AuthController@regsterView');
Route::get('login','AuthController@loginView');
Route::get('logout','AuthController@logout');


Route::post('manageuser/register','AuthController@register');
Route::post('manageuser/login','AuthController@login');

// shop
Route::get('shop','ShopController@shop');
Route::get('shop/add/{id}','ShopController@add');
Route::get('shop/delete/{id}','ShopController@delete');
Route::get('ingredientes','ShopController@ingredientes');
Route::get('ingredientes/add/{id}','ShopController@addIngredientes');
Route::get('addon','ShopController@addOn');
Route::get('addon/add/{id}','ShopController@createAddOn');
Route::get('checkout','CheckoutController@index');
Route::get('transaksi','TransaksiController@index');
Route::get('transaksi/kirim/{id}','TransaksiController@kirim');
Route::post('checkout/alamatbaru','CheckoutController@alamatbaru');

Route::group(['middleware' => ['auth', 'chechkRole:1']],function(){
   
// Admin
// manage user
Route::resource('manageuser','ManageUserController');
// manage menu
Route::resource('managemenu','ManageMenuController');
// manage ingredients
Route::resource('manageingredients','ManageIngredientsController');
// manage addon
Route::resource('manageaddon','ManageAddOnController');


});


Route::group(['middleware' => ['auth', 'chechkRole:2']],function(){
   
    Route::get('shop','ShopController@shop');

});


