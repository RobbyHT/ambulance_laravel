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
Route::post('error-info', 'auth\LoginController@errorInfo');

Route::get('login','api\userController@login');
Route::apiResource('user','api\userController');
Route::apiResource('company','api\CompanyController');
Route::apiResource('car','api\CarController');
Route::apiResource('dispatch','api\DispatchRecordController');
Route::apiResource('dispatchEMT','api\DispatchEmtController');
Route::apiResource('consumablesRecord','api\ConsumablesRecordController');
Route::apiResource('news','api\NewsController');
Route::apiResource('equipment','api\EquipmentController');
Route::apiResource('customer','api\CustomerController');
Route::apiResource('preferential','api\PreferentialController');

Route::get('checkTask','api\DispatchRecordController@checkTask');
Route::get('userTake/{vm}','api\userController@userTake');
Route::get('driverTask/{userid}','api\DispatchRecordController@driverTask');
Route::get('emtTask/{userid}','api\DispatchRecordController@emtTask');
Route::get('getEvents','api\DispatchRecordController@getEvents');

Route::post('dispatchCount','api\ChartController@dispatchCount');

Route::post('exportUser','api\ExportController@exportUser');
Route::post('exportCar','api\ExportController@exportCar');
Route::post('exportEquipment','api\ExportController@exportEquipment');
Route::post('exportDispatch','api\ExportController@exportDispatch');
