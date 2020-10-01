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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/createItem', 'App\Http\Controllers\ApiController@createItem');
Route::get('/allItems', 'App\Http\Controllers\ApiController@getAllItems');
Route::delete('/deleteItem/{id}', 'App\Http\Controllers\ApiController@deleteItem');
Route::put('/updateItem/{id}', 'App\Http\Controllers\ApiController@updateItem');
Route::get('/profile', 'App\Http\Controllers\ApiController@profile');
Route::put('/updateUser', 'App\Http\Controllers\ApiController@updateUser');
Route::put('/updatePP', 'App\Http\Controllers\ApiController@updatePP');
Route::get('/itemDetails/{id}', 'App\Http\Controllers\ApiController@itemDetails');





