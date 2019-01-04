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
    Route::get('infouser/{id}','Apiv1Controller@infouser');
    Route::get('myprofile','Apiv1Controller@myprofile');
    Route::get('assetlist/{id}/{pop}','Apiv1Controller@assetlist');
    Route::get('assetbyqr/{qr_code}','Apiv1Controller@assetbyqr');
    Route::get('assetdetail/{id}/{code}','Apiv1Controller@assetdetail');
    Route::get('infouser/{id}','Apiv1Controller@infouser');
    Route::get('assetattribute/{model_id}','Apiv1Controller@assetattribute');
    Route::get('porttype/{model_id}','Apiv1Controller@porttype');
    Route::get('customer','Apiv1Controller@customer');
    Route::get('sid/{cust}','Apiv1Controller@sid');
    Route::get('workorder/{sbu}','Apiv1Controller@workorder');
    Route::get('sbus','Apiv1Controller@sbus');
    Route::get('pops/{sbu}','Apiv1Controller@pops');
    Route::get('buildings/{pop}','Apiv1Controller@buildings');
    Route::get('rooms/{building}','Apiv1Controller@rooms');
    Route::get('types','Apiv1Controller@types');
    Route::get('categories/{type}','Apiv1Controller@categories');
    Route::get('assetcategories/{category}','Apiv1Controller@assetcategories');
    Route::get('brands','Apiv1Controller@brands');
    Route::get('models/{brand}','Apiv1Controller@models');
    Route::get('materialnumb/{model}','Apiv1Controller@materialnumb');
    Route::get('racks/{pop}','Apiv1Controller@racks');
    Route::get('listports/{asset_id}','Apiv1Controller@listports');
    Route::get('listslots/{asset_id}','Apiv1Controller@listslots');
    Route::get('checkresponse','Apiv1Controller@checkresponse');
    Route::get('qrcheck/{id}','Apiv1Controller@qrcheck');
    Route::post('postasset', 'Apiv1Controller@postasset');
    Route::post('posttambahasset', 'Apiv1Controller@posttambahasset');
    Route::post('login', 'AuthController@login');
    Route::post('updateAsset', 'Apiv1Controller@updateAsset');
    Route::post('updatePort', 'Apiv1Controller@updatePort');
    Route::post('updateSlot', 'Apiv1Controller@updateSlot');
    Route::post('register', 'AuthController@register');
    Route::post('tambahfotoasset', 'Apiv1Controller@tambahfotoasset');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('refresh', 'AuthController@refresh');
        Route::group(['prefix' => 'user'], function () {
          Route::get('profile', 'UserController@getProfile');
          Route::post('profile', 'UserController@postProfile');
        });
    });
});
