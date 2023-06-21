<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DispatchRecordController;


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
Route::post('error-info', 'Auth\LoginController@errorInfo');

Route::get('login','Api\userController@login');
Route::apiResource('user','Api\userController');
Route::apiResource('company','Api\CompanyController');
Route::apiResource('car','Api\CarController');
Route::apiResource('dispatch','Api\DispatchRecordController');
Route::apiResource('dispatchEMT','Api\DispatchEmtController');
Route::apiResource('consumablesRecord','Api\ConsumablesRecordController');
Route::apiResource('news','Api\NewsController');
Route::apiResource('equipment','Api\EquipmentController');
Route::apiResource('customer','Api\CustomerController');
Route::apiResource('preferential','Api\PreferentialController');

Route::get('checkTask','Api\DispatchRecordController@checkTask');
Route::get('userTake/{vm}','Api\userController@userTake');
Route::get('driverTask/{userid}','Api\DispatchRecordController@driverTask');
Route::get('emtTask/{userid}','Api\DispatchRecordController@emtTask');
Route::get('getEvents/{userid}','Api\DispatchRecordController@getEvents');

Route::post('dispatchCount','Api\ChartController@dispatchCount');
Route::post('simgleDispatchCount','Api\ChartController@simgleDispatchCount');

Route::post('exportUser','Api\ExportController@exportUser');
Route::post('exportCar','Api\ExportController@exportCar');
Route::post('exportEquipment','Api\ExportController@exportEquipment');
Route::post('exportDispatch','Api\ExportController@exportDispatch');

Route::post('getCompanyKey','Api\userController@getCompanyKey');
Route::post('updateCompanyKey','Api\userController@updateCompanyKey');