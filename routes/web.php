<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
 
        Route::get('/', 'App\Http\Controllers\HomeController@index');
   
   
        Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
   
    // Setting
        // General 
            Route::post('changeDarkTheme', 'App\Http\Controllers\Setting\SettingController@changeDarkTheme')->name('changeDarkTheme');
        // General 
        // Menus
            Route::get('/menus', 'App\Http\Controllers\Setting\MenusController@index')->name('menus');
            Route::get('getMenus', 'App\Http\Controllers\Setting\MenusController@getMenus')->name('getMenus');
            Route::get('getActiveParent', 'App\Http\Controllers\Setting\MenusController@getActiveParent')->name('getActiveParent');
            Route::get('getSubMenus', 'App\Http\Controllers\Setting\MenusController@getSubMenus')->name('getSubMenus');
            Route::post('addMenus', 'App\Http\Controllers\Setting\MenusController@addMenus')->name('addMenus');
            Route::post('updateStatusMenu', 'App\Http\Controllers\Setting\MenusController@updateStatusMenu')->name('updateStatusMenu');
            Route::post('updateMenus', 'App\Http\Controllers\Setting\MenusController@updateMenus')->name('updateMenus');
            Route::post('addSubMenus', 'App\Http\Controllers\Setting\MenusController@addSubMenus')->name('addSubMenus');
            Route::post('updateStatusSubMenu', 'App\Http\Controllers\Setting\MenusController@updateStatusSubMenu')->name('updateStatusSubMenu');
            Route::post('updateSubMenus', 'App\Http\Controllers\Setting\MenusController@updateSubMenus')->name('updateSubMenus');
        // Menus

        // Role & Permission
            Route::get('/role_permission', 'App\Http\Controllers\Setting\RolePermissionController@index')->name('role_permission');
            Route::get('/getRole', 'App\Http\Controllers\Setting\RolePermissionController@getRole')->name('getRole');
            Route::get('/getPermission', 'App\Http\Controllers\Setting\RolePermissionController@getPermission')->name('getPermission');
            Route::post('/addRole', 'App\Http\Controllers\Setting\RolePermissionController@addRole')->name('addRole');
            Route::get('/detailRole', 'App\Http\Controllers\Setting\RolePermissionController@detailRole')->name('detailRole');
            Route::post('/updateRole', 'App\Http\Controllers\Setting\RolePermissionController@updateRole')->name('updateRole');
            Route::post('/savePermission', 'App\Http\Controllers\Setting\RolePermissionController@savePermission')->name('savePermission');
            Route::get('/permissionMenus', 'App\Http\Controllers\Setting\RolePermissionController@permissionMenus')->name('permissionMenus');
            Route::get('/deletePermission', 'App\Http\Controllers\Setting\RolePermissionController@deletePermission')->name('deletePermission');

        // Role & Permission

        // User Access
            Route::get('/user_access', 'App\Http\Controllers\Setting\UserAccessController@index')->name('user_access');
            Route::get('/getRoleUser', 'App\Http\Controllers\Setting\UserAccessController@getRoleUser')->name('getRoleUser');
            Route::get('/getUser', 'App\Http\Controllers\Setting\UserAccessController@getUser')->name('getUser');
            Route::get('/getRolePermissionDetail', 'App\Http\Controllers\Setting\UserAccessController@getRolePermissionDetail')->name('getRolePermissionDetail');
            Route::post('/addRoleUser', 'App\Http\Controllers\Setting\UserAccessController@addRoleUser')->name('addRoleUser');
            Route::post('/updateRoleUser', 'App\Http\Controllers\Setting\UserAccessController@updateRoleUser')->name('updateRoleUser');
            Route::post('/saveRolePermission', 'App\Http\Controllers\Setting\UserAccessController@saveRolePermission')->name('saveRolePermission');
            Route::get('/destroyRolePermission', 'App\Http\Controllers\Setting\UserAccessController@destroyRolePermission')->name('saveRolePermission');

        // User Access

        // Employee
        Route::get('/master_user', 'App\Http\Controllers\Setting\UserController@index')->name('master_user');
        Route::get('/getUser', 'App\Http\Controllers\Setting\UserController@getUser')->name('getUser');
        // Employee
    // Setting

    // Dashboard
        Route::get('/getCountingAsset', 'App\Http\Controllers\HomeController@getCountingAsset')->name('getCountingAsset');
        Route::get('/assetChart', 'App\Http\Controllers\HomeController@assetChart')->name('assetChart');
        Route::get('/assetChartFilter', 'App\Http\Controllers\HomeController@assetChartFilter')->name('assetChartFilter');
        // Dashboard
        
        // Transaction
        // Asset
            Route::get('/inventory_condition', 'App\Http\Controllers\Transaction\Asset\AssetController@index')->name('inventory_condition');
            Route::get('/inventory', 'App\Http\Controllers\Transaction\Asset\AssetController@index')->name('inventory');
            Route::get('/inventory_transaction', 'App\Http\Controllers\Transaction\Asset\AssetController@index')->name('inventory_transaction');
            Route::get('/getAsset', 'App\Http\Controllers\Transaction\Asset\AssetController@getAsset')->name('getAsset');
            Route::get('/getPengajuanAsset', 'App\Http\Controllers\Transaction\Asset\AssetController@getPengajuanAsset')->name('getPengajuanAsset');
            Route::get('/getPengajuanAssetFilter', 'App\Http\Controllers\Transaction\Asset\AssetController@getPengajuanAssetFilter')->name('getPengajuanAssetFilter');
            Route::get('/getAssetFilter', 'App\Http\Controllers\Transaction\Asset\AssetController@getAssetFilter')->name('getAssetFilter');
            Route::get('/getMasterSatgas', 'App\Http\Controllers\Transaction\Asset\AssetController@getMasterSatgas')->name('getMasterSatgas');
            Route::post('/addAsset', 'App\Http\Controllers\Transaction\Asset\AssetController@addAsset')->name('addAsset');
        
        // Asset
    // Transaction
});
