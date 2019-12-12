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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function() {
    return view('dashboard');
});


Route::group(['prefix' => 'procedure'], function() {
    
    Route::get('show', 'ProcedureController@getAllProceduresView');

    Route::get('create','ProcedureController@getCreate');

    Route::post('create','ProcedureController@postCreate');

    Route::get('delete/{id}','ProcedureController@getDelete');

});

Route::group(['prefix' => 'main-task'], function() {
    
    Route::get('show', 'MainTaskController@getAllMaintask');

    Route::get('{id}/procedure-tasks','MainTaskController@getProcedureTasksView');

    Route::get('create','MainTaskController@getCreate');

    Route::post('create','MainTaskController@postCreate');

    Route::get('delete/{id}','MainTaskController@getDelete');

    Route::get('update/{id}','MainTaskController@getUpdate');

    Route::post('update/{id}','MainTaskController@postUpdate');

});


