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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('search','App\Http\Controllers\StoreController@search');
Route::apiResource('store','App\Http\Controllers\StoreController');
Route::get('find/{id?}/{cats?}/{subcat?}/{locs?}/{cdate?}/{udate?}/{desc?}/{elem?}/{order?}/','App\Http\Controllers\StoreController@findIt');
Route::get('new/{categories_id?}','App\Http\Controllers\StoreController@storeNew');

Route::post('store','App\Http\Controllers\StoreController@store');
Route::get('getcat/{categories_id}','App\Http\Controllers\StoreController@getCat');
Route::post('addcat','App\Http\Controllers\StoreController@addcat');
Route::post('addsubcat','App\Http\Controllers\StoreController@addsubcat');
Route::post('addlocation','App\Http\Controllers\StoreController@addlocation');


