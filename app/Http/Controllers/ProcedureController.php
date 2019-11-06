<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\ProcedureType;
use Illuminate\Http\Request;
use Validator;

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
    		// Call api to get info user created procedure and handle

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
        		$procedure->attached_file = $request->attached_file;

        		// xử lý khi có file gửi thực tế
        		/*if($file = $request->file('attached_file')){
		    		$name = 'file_'.$procedure->id.'.'.$file->getClientOriginalExtension();
		    		$procedure->attached_file = 'assets/'.$name;

		    		if (File::exists($procedure->attached_file)) {
		    			File::delete($procedure->attached_file);
		    			$file->move('assets',$name);
		    		} else {
		    			$file->move('assets',$name);    			
		    		}
		    	}*/
		    	$procedure->save();
        		return response()->json(['message' => 'Create procedure successfully!'], 201);
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
		    		$procedure->attached_file = $request->attached_file;

		    		// xử lý khi có file gửi thực tế
		    		/*if($file = $request->file('attached_file')){
			    		$name = 'file_'.$procedure->id.'.'.$file->getClientOriginalExtension();
			    		$procedure->attached_file = 'assets/'.$name;

			    		if (File::exists($procedure->attached_file)) {
			    			File::delete($procedure->attached_file);
			    			$file->move('assets',$name);
			    		} else {
			    			$file->move('assets',$name);    			
			    		}
			    	}*/
			    	$procedure->save();
		    		return response()->json(['message' => 'Update procedure successfully!'], 200);
	    		}        	
			}
	    }
    }


    public function delete($id){
    	$procedure = Procedure::find($id);
    	if (!$procedure) {
    		return response()->json(['message' => 'Procedure  does not exist!']);
    	} else {
    		$procedure->delete();
    		return response()->json(['message' => 'Delete procedure successfully!'], 200);
    	}
    }

    
}
