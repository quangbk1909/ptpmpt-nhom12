<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\log;
use GuzzleHttp\Client;

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

    public function testGuzz(){
    	$client = new Client(['base_uri' => 'https://dsd05-dot-my-test-project-252009.appspot.com',]);
    	try {
    		$response = $client->request('GET','/user/getUserInfo?id=514414017825996812');
    		$body = $response->getBody();
    		return response()->json(json_decode($body));
    	} catch (\GuzzleHttp\Exception\BadResponseException $e) {
    		 echo $e->getResponse()->getStatusCode();
    	}



    	// $response = $client->request('GET','/user/getUserInfo?id=51441401782599681');
    	 
    	//  return $response->getStatusCode();


    	// if ($response->getStatusCode() == 500) {
    	// 	return response()->json(['user' => 'not found']);
    	// } else {
    	// 	return $response->getStatusCode();
    	// }
    }



}
