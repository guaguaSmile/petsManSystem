<?php

use Illuminate\Routing\Router;

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

/*Route::get('/', function () {
    return view('admin.common.public');
});*/
Route::get('{any}', function () {
    return view('admin.common.public');
})->where('any', '.*');

//Route::group(['prefix'=>'admin','middleware' =>['auth']], function() {
/*Route::group(['prefix'=>'admin', 'namespace' => 'Admin'], function() {
    // 用户CURD
    Router::get('user', 'UserController@index')->name('admin.user.index');
    Router::post('user/store', 'UserController@store')->name('admin.user.store');
    Router::get('user/{id}/edit', 'UserController@edit')->name('admin.user.edit');
    Router::delete('user/delete', 'UserController@delete')->name('admin.user.delete');
    // 宠物CURD
    Router::get('pets', 'PetsController@index')->name('admin.pets.index');
    Router::post('pets/store', 'PetsController@store')->name('admin.pets.store');
    Router::get('pets/{id}/edit', 'PetsController@edit')->name('admin.pets.edit');
    Router::delete('delete', 'PetsController@delete')->name('admin.pets.delete');
    Router::get('pets/detail', 'PetsController@detail')->name('admin.pets.detail');
    // 宠物治疗CURD
    Router::get('pets/{id}/treatment', 'TreatmentController@index')->name('admin.pets.treatment.index');
    Router::post('pets/treatment/store', 'TreatmentController@store')->name('admin.pets.treatment.store');
    Router::post('pets/{id}/treatment/edit', 'TreatmentController@edit')->name('admin.pets.treatment.edit');
    // 宠物品种CURD
    Router::get('category', 'CategoryController@index')->name('admin.pets.category.index');
    Router::post('pets/category/store', 'CategoryController@store')->name('admin.pets.category.store');
    Router::post('pets/{id}/category/edit', 'CategoryController@edit')->name('admin.pets.category.edit');

});*/