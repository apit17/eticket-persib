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
        Route::get('dashboard', ['uses' => 'LoginController@dashboard']);
        Route::get('logout', ['uses' => 'LoginController@logout']);

        /* Product start here */
        Route::group(['prefix' => 'product'],function() {
            Route::get('/',['uses' => 'ProductController@index']);
            Route::get('/datatables',['uses' => 'ProductController@datatables']);
            Route::post('/delete', ['uses' => 'ProductController@destroy']);
            Route::post('/add', ['uses' => 'ProductController@store']);
            Route::post('/edit', ['uses' => 'ProductController@edit']);
            Route::post('/update', ['uses' => 'ProductController@update']);
        });
    });
});


?>