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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['namespace' => 'Api'], function () {

    Route::post('login', 'LoginController@login');
//    Route::group(['middleware' => ['admin.auth', 'web']], function () {

        Route::post('logout', 'LoginController@logout');
        // 后台用户
        Route::get('user', 'UserController@getData');
        Route::get('user/auth', 'UserController@auth');
        Route::post('user/{id}/delete', 'UserController@delete');
        // 宠物
        Route::get('pets', 'PetsController@getData');
        Route::get('pets/{id}/detail', 'PetsController@detail');
        Route::post('pets', 'PetsController@store');
        Route::post('pets/{id}/delete', 'PetsController@delete');
        Route::match(['get', 'post'], 'pets/{id}/edit', 'PetsController@edit');
        // 分类
        Route::get('category', 'CategoryController@getData');
        Route::match(['get', 'post'], 'category/store', 'CategoryController@store');
        Route::post('category/{id}/delete', 'CategoryController@delete');
        Route::post('category/{id}/edit', 'CategoryController@edit');
        Route::get('category/parent', 'CategoryController@getParentCategory');
        Route::get('category/sub', 'CategoryController@getSubCategory');
        // 治疗记录
        Route::post('treatment', 'TreatmentRecordController@store');
        Route::post('treatment/{id}/delete', 'TreatmentRecordController@delete');

//    });
});
