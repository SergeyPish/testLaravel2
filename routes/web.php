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

Route::group(['middleware' => 'web'], function () {

    Route::get('/', ['as' => 'home', 'uses' => 'BeerController@index']);

    Route::group(['prefix' => 'beer'], function () {
        Route::get('/', ['as' => 'beer.index', 'uses' => 'BeerController@index']);
        Route::get('/edit/{id}', ['as' => 'beer.show', 'uses' => 'BeerController@show'])
            ->where('id', '\d+');
        Route::post('/edit/{id}', ['as' => 'beer.show.edit', 'uses' => 'BeerController@show'])
            ->where('id', '\d+');
        Route::post('/add', ['as' => 'beer.add.write', 'uses' => 'BeerController@add']);
        Route::get('/add', ['as' => 'beer.add', 'uses' => 'BeerController@add']);
        Route::get('/delete/{id}', ['as' => 'beer.delete', 'uses' => 'BeerController@delete'])
            ->where('id', '\d+');
    });

    Route::group(['prefix' => 'type'], function () {
        Route::get('/', ['as' => 'type.index', 'uses' => 'TypeController@index']);
        Route::get('/edit/{id}', ['as' => 'type.show', 'uses' => 'TypeController@show'])
            ->where('id', '\d+');
        Route::post('/edit/{id}', ['as' => 'type.show.edit', 'uses' => 'TypeController@show'])
            ->where('id', '\d+');
        Route::post('/add', ['as' => 'type.add.write', 'uses' => 'TypeController@add']);
        Route::get('/add', ['as' => 'type.add', 'uses' => 'TypeController@add']);
        Route::get('/delete/{id}', ['as' => 'type.delete', 'uses' => 'TypeController@delete'])
            ->where('id', '\d+');
    });

    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', ['as' => 'brand.index', 'uses' => 'ManufacturerController@index']);
        Route::get('/edit/{id}', ['as' => 'brand.show', 'uses' => 'ManufacturerController@show'])
            ->where('id', '\d+');
        Route::post('/edit/{id}', ['as' => 'brand.show.edit', 'uses' => 'ManufacturerController@show'])
            ->where('id', '\d+');
        Route::post('/add', ['as' => 'brand.add.write', 'uses' => 'ManufacturerController@add']);
        Route::get('/add', ['as' => 'brand.add', 'uses' => 'ManufacturerController@add']);
        Route::get('/delete/{id}', ['as' => 'brand.delete', 'uses' => 'ManufacturerController@delete'])
            ->where('id', '\d+');
    });

});
