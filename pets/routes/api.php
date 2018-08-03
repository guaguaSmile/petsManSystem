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
    Route::post('logout', 'LoginController@logout');
//    Route::group([], function () {
    Route::get('user', 'UserController@getData');
    Route::get('pets', 'PetsController@getData');
    Route::get('pets/{id}/detail', 'PetsController@detail');
    Route::post('pets', 'PetsController@store');
    Route::post('pets/{id}/delete', 'PetsController@delete');
    Route::match(['get', 'post'], 'pets/{id}/edit', 'PetsController@edit');

    Route::get('category', 'CategoryController@getData');
    Route::match(['get', 'post'], 'category/store', 'CategoryController@store');
    Route::post('category/{id}/delete', 'CategoryController@delete');
    Route::post('category/{id}/edit', 'CategoryController@edit');

//    });
});
