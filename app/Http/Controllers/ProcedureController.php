<?php

namespace App\Http\Controllers;

use App\Log;
use App\Procedure;
use App\ProcedureType;
use Illuminate\Http\Request;
use Validator;
use GuzzleHttp\Client;
use App\ProcedureStep;

class ProcedureController extends Controller
{
    public function getAllProcedures(Request $request){
    	$allProcedures = Procedure::all();
    	$procedureList = array();

        $users = $this->getAllUser();

    	foreach ($allProcedures as $procedure) {
    		$procedureType = $procedure->procedureType;
    		unset($procedure['procedure_type_id']);
            $procedureSteps = $procedure->procedureSteps;

            foreach ($users as $user) {
                    if ($user->id = $procedure->added_by) {
                        $creator = $user;
                    }
                }

            if($user){
                $procedure->added_by_detail = $creator;
            } else {
                 $procedure->added_by_detail = "User does not exist";
            }

    		array_push($procedureList , $procedure);
    	}

        $log = $this->newLog($request);
        $log->type = "procedure";
        $log->response_code = 200;
        $log->save();


    	return response()->json($procedureList, 200);
    }


    public function getProcedureByType($idType){
    	$type = ProcedureType::find($idType);
    	if ($type) {
    		$procedures = $type->procedures;
    		return response()->json($procedures, 200);
    	} else {
    		return response()->json(['message' => 'Procedure type does not exist!']);
    	}
    }


    public function getDetailProcedure(Request $request,$id){
    	$procedure = Procedure::find($id);
    	if ($procedure){
    		$procedureType = $procedure->procedureType;
            $procedureSteps = $procedure->procedureSteps;
            $user = $this->getUser($procedure->added_by);
    		if($user){
                $procedure->added_by_detail = $user;
            } else {
                 $procedure->added_by_detail = "User does not exist";
            }

            $log = $this->newLog($request);
            $log->type = "procedure";
            $log->object_id = $procedure->id;
            $log->response_code = 200;
            $log->save();

    		return response()->json ($procedure);
    	} else {

            $log = $this->newLog($request);
            $log->type = "procedure";
            $log->object_id = $procedure->id;
            $log->response_code = 400;
            $log->save();

    		return response()->json (['message' => 'Procedure does not exist!']);
    	}
    }


    public function create(Request $request){        
    	$validator = Validator::make($request->all(), [
				    		'title' => 'required|unique:procedures',
				    	],
				    	[
				    		'unique' => ':attribute already exist!'
				    	],
				    	[
				    		'title' => 'Title'
				    	]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
        	$procedureType = ProcedureType::find($request->procedure_type_id);
        	if (!$procedureType) {
        		return response()->json(['message' => 'Procedure type does not exist!']);
        	} else if(0){
        		// get user en check user exist
        	} else{
        		$procedure = new Procedure;
        		$procedure->title = $request->title;
        		$procedure->procedure_type_id = $request->procedure_type_id;
        		$procedure->content = $request->content;
        		$procedure->added_by = $request->added_by;
		    	$procedure->save();

                $log = $this->newLog($request);
                $log->type = "procedure";
                $log->object_id = $procedure->id;
                $log->response_code = 200;
                $log->save();

        		return response()->json(['message' => 'Create procedure successfully!','procedure' => $procedure]);
        	}        	
       }
    }


    public function update(Request $request, $id){
    	$procedure = Procedure::find($id);
    	if (!$procedure) {
	    		return response()->json(['message' => 'Procedure does not exist!']);
	    } else {
	    	$validator = Validator::make($request->all(), [
				    		'title' => 'required|unique:procedures,title,'.$id
				    	],
				    	[
				    		'unique' => ':attribute already exist!'
				    	],
				    	[
				    		'title' => 'Title'
				    	]);
	    	if ($validator->fails()) {
	            return response()->json(['error' => $validator->errors()]);
	        } else {
		    	$procedureType = ProcedureType::find($request->procedure_type_id);
		    	
	    		if (!$procedureType) {
		    		return response()->json(['message' => 'Procedure type does not exist!']);
		    	} else {
		    		$procedure->title = $request->title;
		    		$procedure->procedure_type_id = $request->procedure_type_id;
		    		$procedure->content = $request->content;
			    	$procedure->save();

                    $log = $this->newLog($request);
                    $log->type = "procedure";
                    $log->object_id = $procedure->id;
                    $log->response_code = 200;
                    $log->save();

		    		return response()->json(['message' => 'Update procedure successfully!','procedure' => $procedure], 200);
	    		}        	
			}
	    }


    }


    public function delete(Request $request,$id){
    	$procedure = Procedure::find($id);
    	if (!$procedure) {
    		return response()->json(['message' => 'Procedure  does not exist!']);
    	} else {
            $log = $this->newLog($request);
            $log->type = "procedure";
            $log->object_id = $procedure->id;
            $log->response_code = 200;
            $log->save();
    		$procedure->delete();


    		return response()->json(['message' => 'Delete procedure successfully!'], 200);
    	}
    }

    public function getUser($id){
        $client = new Client(['base_uri' => 'https://dsd05-dot-my-test-project-252009.appspot.com',]);
        try {
            $response = $client->request('GET','/user/getUserInfo?id='.$id);
            $body = $response->getBody();
            return json_decode($body);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getResponse()->getStatusCode() != 200) {
                return false;
            }
        }
    }


    public function getAllUser(){
        $client = new Client(['base_uri' => 'https://dsd05-dot-my-test-project-252009.appspot.com',]);
        try {
            $response = $client->request('GET','/user/getUserInfos');
            $body = $response->getBody();
            return json_decode($body);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getResponse()->getStatusCode() != 200) {
                return false;
            }
        }
    }

    public function newLog(Request $request){
        $log = new Log;
        $log->ip = $request->ip();
        $log->created_time = time();
        $log->method = $request->method();
        $log->path = $request->getRequestUri();
        $log->data_send = json_encode($request->all());

        return $log;
    }









    // for view render


    public function getAllProceduresView(){
        $procedures = Procedure::all();

        $users = $this->getAllUser();

        foreach ($procedures as $procedure) {
            foreach ($users as $user) {
                    if ($user->id = $procedure->added_by) {
                        $creator = $user;
                    }
                }

            if($user){
                $procedure->adder = $creator;
            } else {
                 $procedure->adder = "User does not exist";
            }

        }
        return view('procedure.show',compact('procedures'));
    }

    public function getCreate(){
        $procedureTypes = ProcedureType::all();
        return view('procedure.create',compact('procedureTypes'));
    }

    
}
