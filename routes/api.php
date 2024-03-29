<?php

use App\Http\Controllers\BoardController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users',function(){
    return \App\User::where('id',1)->with(['role','boards'])->first();
});


Route::middleware('auth:api')->group(function () {
  	Route::get('boards','BoardController@index');

    Route::get('projects/{board_id}','ProjectController@index');

    Route::get('modules/{project_id}','ModuleController@index');

    Route::get('module_details/{module_id}','ModuleController@get_details');

    Route::get('{module_type}','ModuleController@getDashboardDetails');

    Route::post('get_dashboard_detail','ModuleController@get_dashboard_details');

    Route::post('get_financial_detail','FinanceController@get_finance_details');

});

 //Route::get('get_financial_detail','FinanceController@get_finance_details');
Route::group(['middleware'=>'client'],function(){

});





