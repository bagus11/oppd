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
        Route::get('/', function () {
            return redirect('/home');
        });
   
   
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

        // Master Satgas
            
            Route::get('/master_satgas', 'App\Http\Controllers\Setting\MasterSatgasController@index')->name('master_satgas');
            Route::get('/getSatgasTable', 'App\Http\Controllers\Setting\MasterSatgasController@getSatgasTable')->name('getSatgasTable');
            Route::post('/addSatgas', 'App\Http\Controllers\Setting\MasterSatgasController@addSatgas')->name('addSatgas');
        // Master Satgas

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

    // Master
        Route::get('/master_asset', 'App\Http\Controllers\Master\MasterAssetController@index')->name('master_asset');
        Route::get('/getMasterAsset', 'App\Http\Controllers\Master\MasterAssetController@getMasterAsset')->name('getMasterAsset');
        Route::get('/getInventoryCategory', 'App\Http\Controllers\Master\MasterAssetController@getInventoryCategory')->name('getInventoryCategory');
        Route::get('/getInventorySubCategory', 'App\Http\Controllers\Master\MasterAssetController@getInventorySubCategory')->name('getInventorySubCategory');
        Route::get('/getInventoryType', 'App\Http\Controllers\Master\MasterAssetController@getInventoryType')->name('getInventoryType');
        Route::get('/getInventoryBrand', 'App\Http\Controllers\Master\MasterAssetController@getInventoryBrand')->name('getInventoryBrand');
        Route::post('/addMasterAsset', 'App\Http\Controllers\Master\MasterAssetController@addMasterAsset')->name('addMasterAsset');
        Route::get('/getLogAsset', 'App\Http\Controllers\Master\MasterAssetController@getLogAsset')->name('getLogAsset');
        Route::get('/getSatgas', 'App\Http\Controllers\Master\MasterAssetController@getSatgas')->name('getSatgas');
        Route::post('/updateAsset', 'App\Http\Controllers\Master\MasterAssetController@updateAsset')->name('updateAsset');
        
    // Master
        
    // Transaction
        // Asset
            Route::get('/inventory_condition', 'App\Http\Controllers\Transaction\Asset\AssetController@index')->name('inventory_condition');
            Route::get('/inventory', 'App\Http\Controllers\Transaction\Asset\AssetController@index')->name('inventory');
           
            Route::get('/getAsset', 'App\Http\Controllers\Transaction\Asset\AssetController@getAsset')->name('getAsset');
            Route::get('/getPengajuanAsset', 'App\Http\Controllers\Transaction\Asset\AssetController@getPengajuanAsset')->name('getPengajuanAsset');
            Route::get('/getPengajuanAssetFilter', 'App\Http\Controllers\Transaction\Asset\AssetController@getPengajuanAssetFilter')->name('getPengajuanAssetFilter');
            Route::get('/getAssetFilter', 'App\Http\Controllers\Transaction\Asset\AssetController@getAssetFilter')->name('getAssetFilter');
            Route::get('/getMasterSatgas', 'App\Http\Controllers\Transaction\Asset\AssetController@getMasterSatgas')->name('getMasterSatgas');
            Route::post('/addAsset', 'App\Http\Controllers\Transaction\Asset\AssetController@addAsset')->name('addAsset');
        // Asset

        // Inventaris Aset
            Route::get('/asset_inventaris', 'App\Http\Controllers\Transaction\Asset\AssetInventarisController@index')->name('asset_inventaris');
            Route::get('/getDetailAsset', 'App\Http\Controllers\Transaction\Asset\AssetInventarisController@getDetailAsset')->name('getDetailAsset');
            Route::get('/getInventaris', 'App\Http\Controllers\Transaction\Asset\AssetInventarisController@getInventaris')->name('getInventaris');
            Route::get('/getInventarisLog', 'App\Http\Controllers\Transaction\Asset\AssetInventarisController@getInventarisLog')->name('getInventarisLog');
            Route::post('/addInventaris', 'App\Http\Controllers\Transaction\Asset\AssetInventarisController@addInventaris')->name('addInventaris');
            Route::post('/updateInventaris', 'App\Http\Controllers\Transaction\Asset\AssetInventarisController@updateInventaris')->name('updateInventaris');
        // Inventaris Aset

        // Status
            Route::get('/status_distribusi', 'App\Http\Controllers\Transaction\Asset\StatusDistribusiController@index')->name('status_distribusi');
            Route::get('/getStatusDistribusi', 'App\Http\Controllers\Transaction\Asset\StatusDistribusiController@getStatusDistribusi')->name('getStatusDistribusi');
            Route::get('/getMasterAssetDistribusi', 'App\Http\Controllers\Transaction\Asset\StatusDistribusiController@getMasterAssetDistribusi')->name('getMasterAssetDistribusi');
            Route::post('/addDistribusi', 'App\Http\Controllers\Transaction\Asset\StatusDistribusiController@addDistribusi')->name('addDistribusi');
            Route::post('/startProgressDistribution', 'App\Http\Controllers\Transaction\Asset\StatusDistribusiController@startProgressDistribution')->name('startProgressDistribution');
            Route::post('/updateDistribusi', 'App\Http\Controllers\Transaction\Asset\StatusDistribusiController@updateDistribusi')->name('updateDistribusi');
            Route::get('/getDistribusiLog', 'App\Http\Controllers\Transaction\Asset\StatusDistribusiController@getDistribusiLog')->name('getDistribusiLog');
        // Status

        // Maintenance
        Route::get('/lap_harwat', 'App\Http\Controllers\Transaction\Asset\LaporanController@index')->name('lap_harwat');
        Route::get('/getMaintenance', 'App\Http\Controllers\Transaction\Asset\LaporanController@getMaintenance')->name('getMaintenance');
        Route::get('/getAssetMaintenance', 'App\Http\Controllers\Transaction\Asset\LaporanController@getAssetMaintenance')->name('getAssetMaintenance');
        
        // Maintenance
    // Transaction
});
