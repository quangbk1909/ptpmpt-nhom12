<?php

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
// Procedure route
// Lay tat ca cac quy trinh
Route::get('procedure', 'ProcedureController@getAllProcedures');
// lay cac quy trinh theo tung loai
Route::get('procedure-by-type/{idType}', 'ProcedureController@getProcedureByType');
// lay chi tiet quy trinh theo id
Route::get('procedure/{id}', 'ProcedureController@getDetailProcedure');
// tao 1 quy trinh moi
Route::post('procedure', 'ProcedureController@create');
// sua quy trinh
Route::put('procedure/{id}', 'ProcedureController@update');
// xoa quy trinh
Route::delete('procedure/{id}', 'ProcedureController@delete');


// Procedure task route
Route::group(['prefix' => 'procedure-task'], function() {
    // lay cong viec duoc tao boi user
    Route::get('created-by-user/{userID}', 'ProcedureTaskController@getTasksCreated');
    // lay cac cong viec user duoc giao
    Route::get('implemented-by-user/{userID}', 'ProcedureTaskController@getTasksImplemented');
    // lay thong tin chi tiet 1 cong viec
    Route::get('{id}' ,'ProcedureTaskController@showDetail');
    // lay danh sach cac cong viec trong 1 quy trinh
    Route::get('task-in-procedure', 'ProcedureTaskController@getTaskInProcedure');
    // them mot quy trinh moi
    Route::post('', 'ProcedureTaskController@create');
    // sua noi dung 1 cong viec
    Route::put('{id}', 'ProcedureTaskController@update');
    // xoa cong viec
    Route::delete('{id}', 'ProcedureTaskController@delete');
    // phan cong cong viec
    Route::put('assign/{id}', 'ProcedureTaskController@assignTask');
    // cap nhat tien do thuc hien cong viec
    Route::put('update-progress/{id}', 'ProcedureTaskController@updateProgress');
    // danh dau nhiem vu da hoan thanh
    Route::put('done/{id}', 'ProcedureTaskController@markTaskDone');


});



