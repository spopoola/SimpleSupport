<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\AuthController@login');
Route::post('/logout', 'Auth\AuthController@logout');
    
Route::group(['middleware' => 'jwt.auth'], function () {

    // Users
    Route::get('/me', 'Auth\AuthController@user');

    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@store');
    Route::patch('users/profile', 'UserController@updateProfile');
    Route::get('users/{user}', 'UserController@show');
    Route::patch('users/{user}', 'UserController@update');
    Route::patch('users/{user}/status', 'UserController@updateStatus');
    Route::delete('users/{user}', 'UserController@destroy');
    Route::post('users/avatar', 'Account\AvatarController@store');

    // Tickets
    Route::get('tickets/stats', 'Admin\TicketsController@getTicketStats');
    Route::get('tickets/{ticket}', 'Admin\TicketsController@show');
    Route::get('tickets', 'Admin\TicketsController@index');
    Route::post('tickets', 'Admin\TicketsController@store');
    Route::patch('tickets/{ticket}', 'Admin\TicketsController@update');

    Route::get('tickets/type/{type}', 'Admin\TicketsController@getByType');
    Route::get('tickets/type/unassigned', 'Admin\TicketsController@getUnassigned');
    Route::get('tickets/type/dueToday', 'Admin\TicketsController@getDueToday');
    Route::get('tickets/type/overdue', 'Admin\TicketsController@getOverdue');

    Route::get('ticket-priorities', 'Admin\TicketPrioritiesController@index');
});
