<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\log;

class LogController extends Controller
{
    public function getLogs(){
    	//$logs = Log::all();
    	$logs = DB::table('logs')->get();
    	return response()->json($logs); 
    }


    public function testJson(Request $request){
    	$data = json_decode($request->getContent());

    	return $data->name;

    }


}
