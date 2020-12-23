<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'vehicles'], function () {
  Route::get('', 'VehicleController@all');
  Route::get('/schema', 'VehicleController@schema');
  Route::get('/{id}', 'VehicleController@get');
  Route::get('/{id}/count', 'VehicleController@getCount');
  Route::post('/{id}/count', 'VehicleController@setCount');
  Route::get('/{id}/increment-count', 'VehicleController@increment');
  Route::get('/{id}/decrement-count', 'VehicleController@decrement');
});

Route::group(['prefix' => 'starships'], function () {
  Route::get('', 'StarshipController@all');
  Route::get('/schema', 'StarshipController@schema');
  Route::get('/{id}', 'StarshipController@get');
  Route::get('/{id}/count', 'StarshipController@getCount');
  Route::post('/{id}/count', 'StarshipController@setCount');
  Route::get('/{id}/increment-count', 'StarshipController@increment');
  Route::get('/{id}/decrement-count', 'StarshipController@decrement');
});
