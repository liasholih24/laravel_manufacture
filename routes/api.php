<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('whoami/{id}', 'Apiv1Controller@whoami');
    Route::get('getPosts', 'Apiv1Controller@getPosts');
    Route::get('getPost/{id}', 'Apiv1Controller@getPost');
    Route::get('getSaldo/{id}', 'Apiv1Controller@getSaldo');
    Route::get('getHistoryTransaksi/{id}', 'Apiv1Controller@getHistoryTransaksi');
    Route::post('login', 'AuthController@login');
    Route::post('changePassword', 'Apiv1Controller@changePassword');
});
