<?php

namespace App\Http\Controllers;

use App\Log;
use App\Procedure;
use App\ProcedureType;
use Illuminate\Http\Request;
use Validator;
use GuzzleHttp\Client;

class ProcedureController extends Controller
{
    public function getAllProcedures(){
    	$allProcedures = Procedure::all();
    	$procedureList = array();

    	foreach ($allProcedures as $procedure) {
    		$procedureType = $procedure->procedureType;
    		unset($procedure['procedure_type_id']);
    		array_push($procedureList , $procedure);
    	}

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


    public function getDetailProcedure($id){
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

    		return response()->json ($procedure);
    	} else {
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

                $log = new Log;
                $log->action = 'User id '. $request->added_by . ' create new procedure'; 
                $log->save();

        		return response()->json(['message' => 'Create procedure successfully!','procedure' => $procedure], 201);
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

                    $log = new Log;
                    $log->action = 'User id '. $request->user_id . ' update  procedure id-'.$id; 
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
    		$procedure->delete();

            $log = new Log;
            $log->action = 'User id '. $request->user_id . ' delete  procedure id-'.$id; 
            $log->save();

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

    
}
