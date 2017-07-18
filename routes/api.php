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

    Route::get('/me', 'Auth\AuthController@user');

    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@store');
    Route::patch('users/profile', 'UserController@updateProfile');
    Route::get('users/{user}', 'UserController@show');
    Route::patch('users/{user}', 'UserController@update');
    Route::patch('users/{user}/status', 'UserController@updateStatus');
    Route::delete('users/{user}', 'UserController@destroy');
    Route::post('users/avatar', 'Account\AvatarController@store');
});