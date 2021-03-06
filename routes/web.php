<?php

use App\Http\Controllers\Root\UserController;
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

   /**Rota de permissoes de acesso */
   Route::get('roles/{role}/permissions', 'RoleController@permissions')->name('roles.permission');
   Route::put('roles/{role}/permissions/sync', 'RoleController@permissionsSync')->name('roles.permissionSync');

   Route::get('users/{user}/roles', 'UserController@roles')->name('users.roles');
   Route::put('users/{user}/roles/sync', 'UserController@rolesSync')->name('users.rolesSync');

   Route::resources([
      'roles' => 'RoleController',
      'permissions' => 'PermissionController',
   ]);
   /*********/

   Route::get('icons', 'AuthController@icon')->name('icons');

   Route::get('users/team', 'UserController@team')->name('users.team');
   Route::get('users/company', 'UserController@company')->name('users.company');
   Route::get('search-products', 'SaleController@search_products')->name('sales.search-products');
   Route::put('details-status-sale/{sale}', 'SaleController@changeStatus')->name('sales.details-status');
   Route::put('details-status-purchase/{purchase}', 'PurchaseController@changeStatus')->name('purchases.details-status');
   Route::put('details-status-expense/{expense}', 'ExpenseController@changeStatus')->name('expenses.details-status');
   //Route::get('details/{sale}', 'SaleController@details')->name('sales.details');

   Route::get('inventories/clothes', 'InventoryController@clothes')->name('inventories.clothes');
   Route::get('inventories/changing-diapers', 'InventoryController@changingDiapers')->name('inventories.changing-diapers');
   Route::get('inventories/footwear', 'InventoryController@footwear')->name('inventories.footwear');
   Route::get('inventories/baby-layette', 'InventoryController@babyLayette')->name('inventories.baby-layette');
   Route::get('inventories/hygiene', 'InventoryController@hygiene')->name('inventories.hygiene');
   Route::get('inventories/accessories', 'InventoryController@accessories')->name('inventories.accessories');
   Route::resources([
      'sales' => 'SaleController',
      'users' => 'UserController',
      'clients' => 'ClientController',
      'inventories' => 'InventoryController',
      'purchases' => 'PurchaseController',
      'categories' => 'CategoryController',
      'expenses' => 'ExpenseController',
   ]);

   Route::prefix('root')->name('root.')->namespace('Root')->group(function() {
      Route::resources([
         'users' => 'UserController',
         'companies' => 'CompanyController',
      ]);
   });

   /** Relatorios */
   Route::get('reports', 'ReportsController@index')->name('reports.index');
   Route::get('reports-sales', 'ReportsController@salesReport')->name('reports.sales');
   Route::get('reports-sales-pdf', 'ReportsController@salesPdf')->name('reports.sales-pdf');
});

/** Logout */
Route::get('logout', 'AuthController@logout')->name('logout');
