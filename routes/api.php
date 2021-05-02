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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('login','api\userController@login');
Route::apiResource('user','api\userController');
Route::apiResource('company','api\CompanyController');
Route::apiResource('dispatch','api\DispatchRecordController');
Route::apiResource('dispatchEMT','api\DispatchEmtController');

Route::get('checkTask','api\DispatchRecordController@checkTask');
Route::get('userTake/{vm}','api\userController@userTake');
