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

/** Formulario de Login */
Route::get('/', 'AuthController@loginForm')->name('login');
Route::post('login', 'AuthController@login')->name('login.do');

Route::middleware('auth')->group(function () {
   Route::get('home', 'AuthController@home')->name('home');

   Route::get('icons', 'AuthController@icon')->name('icons');

   Route::get('users/team', 'UserController@team')->name('users.team');
   Route::get('search-products', 'SaleController@search_products')->name('sales.search-products');
   Route::put('details-status-sale/{sale}', 'SaleController@changeStatus')->name('sales.details-status');
   Route::put('details-status-purchase/{purchase}', 'PurchaseController@changeStatus')->name('purchases.details-status');
   //Route::get('details/{sale}', 'SaleController@details')->name('sales.details');
   Route::resources([
      'sales' => 'SaleController',
      'users' => 'UserController',
      'clients' => 'ClientController',
      'companies' => 'CompanyController',
      'inventories' => 'InventoryController',
      'purchases' => 'PurchaseController',
   ]);
});

/** Logout */
Route::get('logout', 'AuthController@logout')->name('logout');
