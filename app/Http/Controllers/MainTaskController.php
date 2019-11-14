<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MainTask;
use App\ProcedureTask;
use App\Procedure;
use Validator;

class MainTaskController extends Controller
{
    public function show(){
		$mainTask = MainTask::orderBy('created_at', 'desc')->get();
		$tasks = array();
		foreach ($mainTask as $task) {
    		$procedure = $task->procedure;
    		unset($task['procedure_id']);
    		array_push($tasks , $task);
    	}

		return response()->json($tasks, 200);
	}


	public function showDetail($id){
		$mainTask = MainTask::find($id);
    	if ($mainTask){
    		$procedure = $mainTask->procedure;
    		$procedureType = $procedure->procedureType;
    		// Call api to get info creator of task
    		// Call api to get info responsible person of task

    		return response()->json ($mainTask);
    	} else {
    		return response()->json (['message' => 'Main task does not exist!']);
    	}
	}


	public function getProcedureTasks($id){
		$procedureTasks = ProcedureTask::where('main_task_id','=',$id)->orderBy('step', 'desc')->get();

		return response()->json($procedureTasks, 200);
	}


	public function create(Request $request){
		$validator = Validator::make($request->all(), [
			    		'name' => 'required|unique:main_tasks',
			    	],
			    	[
			    		'unique' => ':attribute already exist!'
			    	],
			    	[
			    		'name' => 'Name'
			    	]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
        	$procedure = Procedure::find($request->procedure_id);
	    	// call api check user exist with id creator
	    	if(!$procedure) {
	    		return response()->json(['message' => 'Main task  does not exist!']);
	    	} else if(0){
	    		return response()->json(['message' => 'The user who created this task  does not exist!']);
	    	} else {
	    		$mainTask = new MainTask;
	    		$mainTask->name = $request->name;
	    		$mainTask->description = $request->description;
	    		$mainTask->deadline = $request->deadline;
	    		$mainTask->procedure_id = $request->procedure_id;
	    		$mainTask->creator = $request->creator;
	    		$mainTask->responsible_person = $request->responsible_person;

	    		$mainTask->save();
	    		return response()->json(['message' => 'Create main task successfully!'],200);
	    	}
        }
	}


	public function update(Request $request, $id){
		$mainTask = MainTask::find($id);
		if (!$mainTask) {
			return response()->json(['message' => 'Main task does not exist!']);
		} else {
			$validator = Validator::make($request->all(), [
			    		'name' => 'required|unique:main_tasks,name,'.$id,
			    	],
			    	[
			    		'unique' => ':attribute already exist!'
			    	],
			    	[
			    		'name' => 'Name'
			    	]);
	        if ($validator->fails()) {
	            return response()->json(['error' => $validator->errors()]);
	        } else {
	        	$procedure = Procedure::find($request->procedure_id);
		    	if(!$procedure) {
		    		return response()->json(['message' => 'Main task  does not exist!']);
		    	} else if(0){
		    		return response()->json(['message' => 'The user who created this task  does not exist!']);
		    	} else {
		    		$mainTask->name = $request->name;
		    		$mainTask->description = $request->description;
		    		$mainTask->deadline = $request->deadline;
		    		$mainTask->procedure_id = $request->procedure_id;
		    		$mainTask->responsible_person = $request->responsible_person;

		    		$mainTask->save();
		    		return response()->json(['message' => 'Update main task successfully!'],200);
		    	}
		    }
		}
		
        
	}


	public function delete($id){
		$mainTask = MainTask::find($id);
		if (!$mainTask) {
			return response()->json(['message' => 'Main task  does not exist!']);
		} else {
			$mainTask->delete();
    		return response()->json(['message' => 'Delete main task successfully!'], 200);
		}
	}

	public function finish($id){
		$mainTask = MainTask::find($id);
		if (!$mainTask) {
			return response()->json(['message' => 'Main task  does not exist!']);
		} else {
			if ($mainTask->status == 1) {
				return response()->json(['message' => 'Main task  already finished!']);
			} else {
				$procedureTasks = $mainTask->procedureTasks;
				$flag = True;
				if (!$procedureTasks) {
					return response()->json(['message' => 'Main task has not procedural task!']);
				} else {
					foreach ($procedureTasks as $task) {
						if ($task->status == 0){
							$flag = False;
							break;
						}
					}
					if ($flag) {
						$mainTask->status = 1;
						$mainTask->finished_at = date("Y-m-d H:i:s");
						$mainTask->save();
						return response()->json(['message' => 'Main task  has been finished!']);
					} else {
						return response()->json(['message' => 'All procedural task in main task has not been finished. Can not finish main task!']);
					}
				}
			}
			
		}
	}


}
