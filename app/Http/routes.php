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

Route::get('/', 'LoginController@index');
Route::post('login', ['uses'=>'LoginController@login']);

/**
 * Admin Routes Group
 */
Route::group(['prefix' => 'admin'], function() {
    Route::group(array('middleware'=>'hasAccess:admin'),function() {
        Route::get('dashboard', 'AdminController@index');
        Route::get('logout', 'LoginController@logout');
        /* Department start here */
        Route::get('department', 'AdminController@department_show');
        Route::get('department/data', 'AdminController@department_data');
        Route::post('department/detail', 'AdminController@department_detail');
        Route::post('department/store', 'AdminController@department_store');
        Route::post('department/update', 'AdminController@department_update');
        Route::post('department/destroy', 'AdminController@department_destroy');
        /* Product start here */
        Route::get('product', 'AdminController@product_show');
        Route::get('product/data', 'AdminController@product_data');
        Route::post('product/detail', 'AdminController@product_detail');
        Route::post('product/store', 'AdminController@product_store');
        Route::post('product/update', 'AdminController@product_update');
        Route::post('product/destroy', 'AdminController@product_destroy');
    });
});


?>