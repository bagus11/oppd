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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('layouts.app');
    })->name('home');    
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

        // Company
        Route::get('/company', 'App\Http\Controllers\Setting\CompanyController@index')->name('company');
        Route::get('/getCompany', 'App\Http\Controllers\Setting\CompanyController@getCompany')->name('getCompany');
        Route::get('/getCompanyLevel', 'App\Http\Controllers\Setting\CompanyController@getCompanyLevel')->name('getCompanyLevel');
        Route::get('/getCompanyType', 'App\Http\Controllers\Setting\CompanyController@getCompanyType')->name('getCompanyLevel');
        
        // Company

        // Location
            Route::get('/location', 'App\Http\Controllers\Setting\LocationController@index')->name('location');
            Route::get('/getLocation', 'App\Http\Controllers\Setting\LocationController@getLocation')->name('getLocation');
            Route::post('/addLocation', 'App\Http\Controllers\Setting\LocationController@addLocation')->name('addLocation');
        // Location

    // Setting


    // Employee
    
            Route::get('/employee_information', 'App\Http\Controllers\Master\EmployeeController@index')->name('employee_information');
            Route::get('/getEmployee', 'App\Http\Controllers\Master\EmployeeController@getEmployee')->name('getEmployee');
    // Employee
});
