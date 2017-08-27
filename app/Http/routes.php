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
        Route::get('setting', ['uses' => 'LoginController@setting']);
        Route::post('setting/update', ['uses' => 'LoginController@updateAdmin']);
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

        /* Sale start here */
        Route::group(['prefix' => 'sale'],function() {
            Route::get('/',['uses' => 'SaleController@index']);
            Route::get('/datatables',['uses' => 'SaleController@datatables']);
            Route::get('/create',['uses' => 'SaleController@create']);
            Route::post('/store',['uses' => 'SaleController@store']);
            Route::post('/detail',['uses' => 'SaleController@show']);
            Route::get('/print',['uses' => 'SaleController@printInvoice']);
            Route::post('/resi',['uses' => 'SaleController@addResiNumber']);
        });

        /* Procurement start here */
        Route::group(['prefix' => 'procurement'],function() {
            Route::get('/',['uses' => 'ProcurementController@index']);
            Route::get('/datatables',['uses' => 'ProcurementController@datatables']);
            Route::get('/create',['uses' => 'ProcurementController@create']);
            Route::post('/store',['uses' => 'ProcurementController@store']);
            Route::post('/detail',['uses' => 'ProcurementController@show']);
        });

        /* Customer start here */
        Route::group(['prefix' => 'customer'],function() {
            Route::get('/',['uses' => 'CustomerController@index']);
            Route::get('/datatables',['uses' => 'CustomerController@datatables']);
        });

        Route::group(['prefix' => 'print'],function() {
            Route::get('/',['uses' => 'PrintController@index']);
            Route::get('/datatables',['uses' => 'PrintController@datatables']);
            Route::post('/validate-print',['uses' => 'PrintController@validatePrint']);
            Route::get('/view/{id}',['uses' => 'PrintController@show']);
        });

        /* Promotion start here */
        Route::group(['prefix' => 'promotion'],function() {
            Route::get('/',['uses' => 'PromotionController@index']);
            Route::get('/datatables',['uses' => 'PromotionController@datatables']);
            Route::get('/create',['uses' => 'PromotionController@create']);
            Route::get('/detail/{id}',['uses' => 'PromotionController@show','as' => 'admin.promotion.admin.detail']);
            Route::post('/add-ticket', ['uses' => 'PromotionController@storeTicket', 'as' => 'admin.promotion.admin.add-ticket']);
            Route::post('/add', ['uses' => 'PromotionController@store']);
            Route::post('/delete', ['uses' => 'PromotionController@destroy']);
            Route::resource('admin', 'PromotionController', ['only' => ['edit', 'update']]);
        });

        /* Classement start here */
        Route::group(['prefix' => 'classement'],function() {
            Route::get('/',['uses' => 'ClassementController@index']);
            Route::get('/datatables',['uses' => 'ClassementController@datatables']);
            Route::get('/create',['uses' => 'ClassementController@create']);
            Route::post('/add', ['uses' => 'ClassementController@store']);
            Route::post('/delete', ['uses' => 'ClassementController@destroy']);
            Route::resource('admin', 'ClassementController', ['only' => ['edit', 'update']]);
        });

        /* Statistic start here */
        Route::group(['prefix' => 'statistic'],function() {
            Route::get('/',['uses' => 'StatisticController@index']);
            Route::post('/income',['uses' => 'StatisticController@income']);
            Route::post('/outcome',['uses' => 'StatisticController@outcome']);
        });
    });
});


//API Routes

?>
