<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\log;

class LogController extends Controller
{
    public function getLogs(){
    	$logs = Log::all();
    	return response()->json($logs); 
    }


    public function testJson(Request $request){
    	$data = json_decode($request->getContent());

    	return $data->name;

    }
}
