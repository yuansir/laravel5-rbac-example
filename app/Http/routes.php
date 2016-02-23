<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});


Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::auth();

    Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('admin_user', 'AdminUserController');
    Route::delete('admin/admin_user/destoryall',['as'=>'admin.admin_user.destory.all','uses'=>'AdminUserController@destoryAll']);
    Route::resource('role', 'RoleController');
    Route::delete('admin/role/destoryall',['as'=>'admin.role.destory.all','uses'=>'RoleController@destoryAll']);
    Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@permissions']);
    Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::delete('admin/permission/destoryall',['as'=>'admin.permission.destory.all','uses'=>'PermissionController@destoryAll']);
    Route::resource('blog', 'BlogController');
});


Route::get('/admin', function () {
    return view('admin.welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
