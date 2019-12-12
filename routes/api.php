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

//Main task route
//Cac task chinh theo quy trinh duoc theo doi boi ban lanh dao
Route::group(['prefix' => 'main-task'], function() {

    // lay cac main task theo 1 procedure
    Route::get('procedure/{id}','MainTaskController@getMainTaskByProcedure');
    // lay danh sach cac main task theo quy trinh
    Route::get('','MainTaskController@show');
    // Lay chi tiet thong tin theo id
    Route::get('{id}','MainTaskController@showDetail');
    // Lay danh sach cac proceduretask nho trong maintask
    Route::get('{id}/procedure-tasks','MainTaskController@getProcedureTasks');
    // Them main task
    Route::post('','MainTaskController@create');
    // sua main task
    Route::put('{id}','MainTaskController@update');
    // xoa main task
    Route::delete('{id}','MainTaskController@delete');
    // danh dau hoan thanh task
    Route::put('finish/{id}','MainTaskController@finish');


});

// Procedure task route
// Cac task nho trong moi main task duoc theo doi boi nguoi tao va nguoi thuc hien
Route::group(['prefix' => 'procedure-task'], function() {
    // lay cong viec duoc tao boi user
    Route::get('created-by-user/{userID}', 'ProcedureTaskController@getTasksCreated');
    // lay cac cong viec user duoc giao
    Route::get('implemented-by-user/{userID}', 'ProcedureTaskController@getTasksImplemented');
    // lay thong tin chi tiet 1 cong viec
    Route::get('{id}' ,'ProcedureTaskController@showDetail');
    // lay danh sach cac cong viec trong 1 quy trinh
    //Route::get('task-in-procedure', 'ProcedureTaskController@getTaskInProcedure');
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
    // danh sach task theo danh sach id
    Route::get('','ProcedureTaskController@getList');

});

Route::put('swap-step-task', 'ProcedureTaskController@swapStep');

Route::get('logs','LogController@getLogs');

Route::get('test','LogController@testGuzz');

Route::get('total-main-task  ', 'MainTaskController@getTotal');

Route::get('analyze-main-task', 'MainTaskController@analyze');

Route::get('analyze-procedure-task', 'ProcedureTaskController@analyze');

Route::get('procedure-task-list' ,'ProcedureTaskController@getListTask');

Route::get('main-task-list','MainTaskController@getMainTaskList');

Route::get('main-task-detail/{id}','MainTaskController@getDetailMainTask');

Route::get('procedure-task-detail/{id}','ProcedureTaskController@getDetailProcedure');

Route::get('proceduretask-of-maintask/{id}','MainTaskController@getProcedureTasksList');

Route::group(['prefix'=>'configuration-management'], function() {

    Route::get('task-field', 'ConfigurationManagementController@getFieldsOfTask');
    Route::post('template','ConfigurationManagementController@createTemplate');
    Route::get('template/{id}', 'ConfigurationManagementController@getTemplate');
    Route::put('template/{id}', 'ConfigurationManagementController@updateTemplate');
});


Route::get('test', 'ProcedureTaskController@testRequest');



    

