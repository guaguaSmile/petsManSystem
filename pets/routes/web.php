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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware' =>['auth']], function(Router $router) {
    // 宠物CURD
    Router::get('pets', 'PetsController@index')->name('admin.pets.index');
    Router::post('pets/store', 'PetsController@store')->name('admin.pets.store');
    Router::get('pets/{id}/edit', 'PetsController@edit')->name('admin.pets.edit');
    Router::delete('delete', 'PetsController@delete')->name('admin.pets.delete');
    // 宠物治疗CURD
    Router::get('pets/{id}/treatment', 'TreatmentController@index')->name('admin.pets.treatment.index');
    Router::post('pets/treatment/store', 'TreatmentController@store')->name('admin.pets.treatment.store');
    Router::post('pets/{id}/treatment/edit', 'TreatmentController@edit')->name('admin.pets.treatment.edit');
    // 宠物品种CURD
    Router::get('pets/varieties', 'VarietiesController@index')->name('admin.pets.varieties.index');
    Router::post('pets/varieties/store', 'VarietiesController@store')->name('admin.pets.varieties.store');
    Router::post('pets/{id}/varieties/edit', 'VarietiesController@edit')->name('admin.pets.varieties.edit');

});