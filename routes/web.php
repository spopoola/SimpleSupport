<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'IndexController@index']);
Route::get('/portal', ['as' => 'portal', 'uses' => 'IndexController@portal']);
Route::get('avatar/{user}', 'UserController@avatar')->name('generate.avatar');
