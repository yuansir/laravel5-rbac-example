<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/', ['as'=>'admin.home','uses'=>'HomeController@index']);
    Route::controllers([
        'auth' => 'Auth\AuthController',
        //	'password' => 'Auth\PasswordController',
    ]);
    //Rbac
    Route::group(['prefix'=>'rbac','namespace'=>'Rbac'],function(){
        Route::resource('role', 'RoleController');
        Route::get('role/{id}/permissions',['as'=>'admin.rbac.role.permissions','uses'=>'RoleController@getPerms']);
        Route::post('role/{id}/permissions',['as'=>'admin.rbac.role.permissions','uses'=>'RoleController@postPerms']);
        Route::resource('user', 'UserController');
        Route::resource('permission', 'PermissionController');
    });


    Route::resource('blog', 'BlogController');
});
