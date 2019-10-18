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


Route::get('test', function() {
    return response()->json(['data' => 'Hello world']);
});

Route::get('procedure', function () {
    $res = json_decode("[{\"id\":1,\"title\":\"Thủ tục xuất/nhập hàng kho\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình xuất/nhập hàng kho \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"date_updated\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1},{\"id\":2,\"title\":\"Quy trình kiểm kê sản phẩm\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình kiểm kê sản phẩm \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1}]");
   return response() -> json(['data' => $res]);
});


Route::get('procedure/{id}', function($id) {
    $res = json_decode("[{\"id\":1,\"title\":\"Thủ tục xuất/nhập hàng kho\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình xuất/nhập hàng kho \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"date_updated\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1},{\"id\":2,\"title\":\"Quy trình kiểm kê sản phẩm\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình kiểm kê sản phẩm \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1}]");
    return response() -> json(['data' => $res]);
});

Route::post('procedure/{id}', function($id) {
    $res = json_decode("[{\"id\":1,\"title\":\"Thủ tục xuất/nhập hàng kho\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình xuất/nhập hàng kho \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"date_updated\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1},{\"id\":2,\"title\":\"Quy trình kiểm kê sản phẩm\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình kiểm kê sản phẩm \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1}]");
    return response() -> json(['data' => $res]);
});

Route::post('create_procedure', function (Request $request) {
    $res = json_decode("{\"id\":1,\"title\":\"Thủ tục xuất/nhập hàng kho\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình xuất/nhập hàng kho \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"date_updated\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1}");
    return response() -> json(['data' => $res]);
});

Route::put('update_procedure', function (Request $request) {
    $res = json_decode("{\"id\":1,\"title\":\"Thủ tục xuất/nhập hàng kho\",\"type\":\"Quy trình thường xuyên sử dụng\",\"content\":\"Nội dung của quy trình xuất/nhập hàng kho \",\"date_created\":\"2019-9-28 07:54:35.000000\",\"date_updated\":\"2019-9-28 07:54:35.000000\",\"attached_file\":\"path/to/file/in/server\",\"added_by\":1}");
    return response() -> json(['data' => $res]);
});

Route::delete('delete_procedure/{ids}', function (Request $request) {
   return response() -> json(['data' => 'Success']);
});

Route::post('add_person', function (Request $request) {
    return response() -> json(['data' => 'Success']);
});

Route::post('change_role', function (Request $request) {
    return response() -> json(['data' => 'Success']);
});

Route::post('assign_task', function (Request $request) {
    return response() -> json(['data' => 'Success']);
});

Route::get('task', function () {
   $res = json_decode("{\"tasks\":[{\"id\":1,\"name\":\"Kiểm tra máy móc\",\"assign\":[{\"user_id\":1,\"user_name\":\"Quang\",\"role\":\"nhan_vien_ky_thuat\",\"deadline\":\"1/11/2019\"}]}]}");
   return response() -> json(['data' => $res]);
});

Route::get('/api/task/{id}', function ($id) {
    $res = json_decode("{\"id\":1,\"name\":\"Kiểm tra máy móc\",\"assign\":[{\"user_id\":1,\"user_name\":\"Quang\",\"role\":\"nhan_vien_ky_thuat\",\"deadline\":\"1/11/2019\"}]}");
    return response() ->json(['data' => $res]);
});
