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


/**
 * Admin Routes Group
 */
Route::group(['prefix' => 'api/v1'], function() {
    Route::get('ticket', 'ApiTicketController@getTicket');
    Route::post('ticket/book', 'ApiTicketController@bookingTicket');
    Route::get('schedule', 'ApiTicketController@getSchedule');
    Route::get('schedule-detail', 'ApiTicketController@getDetailSchedule');
    Route::post('schedule-book', 'ApiTicketController@bookingSchedule');
    Route::post('user/signup', 'ApiTicketController@customerSignUp');
    Route::post('customer/login', 'ApiTicketController@customerLogin');
    Route::get('user', 'ApiTicketController@getUserData');
    Route::get('classement', 'ApiTicketController@getClassement');
    Route::get('transaction', 'ApiTicketController@getTransaction');
    Route::post('insert/transaction', 'ApiTicketController@insertImageTransaction');
});



//API Routes

?>
