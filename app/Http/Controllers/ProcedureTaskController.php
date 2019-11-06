<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\ProcedureTask;
use Illuminate\Http\Request;

class ProcedureTaskController extends Controller
{
	public function getTasksCreated($userID){
		$procedureTasks = ProcedureTask::where('creator','=',$userID)->orderBy('created_at', 'desc')->get();
		$tasks = array();
		foreach ($procedureTasks as $task) {
    		$procedure = $task->procedure;
    		unset($task['procedure_id']);
    		array_push($tasks , $task);
    	}

		return response()->json($tasks, 200);
	}


	public function getTasksImplemented($userID){
		$procedureTasks = ProcedureTask::where('implementer','=',$userID)->orderBy('created_at', 'desc')->get();
		$tasks = array();
		foreach ($procedureTasks as $task) {
    		$procedure = $task->procedure;
    		unset($task['procedure_id']);
    		array_push($tasks , $task);
    	}

		return response()->json($tasks, 200);
	}


	public function showDetail($id){
		$task = ProcedureTask::find($id);
    	if ($task){
    		$procedure = $task->procedure;
    		// Call api to get info creator of task
    		// Call api to get info implementer of task

    		return response()->json ($task);
    	} else {
    		return response()->json (['message' => 'Task does not exist!']);
    	}
	}


    public function create(Request $request){
    	$procedure = Procedure::find($request->procedure_id);
    	// call api check user exist with id creator
    	if(!$procedure) {
    		return response()->json(['message' => 'Procedure  does not exist!']);
    	} else if(0){
    		return response()->json(['message' => 'The user who created this task  does not exist!']);
    	} else {
    		$procedureTask = new ProcedureTask;
    		$procedureTask->name = $request->name;
    		$procedureTask->content = $request->content;
    		$procedureTask->amount_of_work = $request->amount_of_work;
    		$procedureTask->procedure_id = $request->procedure_id;
    		$procedureTask->creator = $request->creator;

    		$procedureTask->save();
    		return response()->json(['message' => 'Create task successfully!'],201);
    	}

    }

    public function update(Request $request, $id){
    	$procedure = Procedure::find($request->procedure_id);
    	// call api check user exist with id creator
    	if(!$procedure) {
    		return response()->json(['message' => 'Procedure  does not exist!']);
    	} else if(0){
    		return response()->json(['message' => 'The user who created this task  does not exist!']);
    	} else {
    		$procedureTask = ProcedureTask::find($id);
    		$procedureTask->name = $request->name;
    		$procedureTask->content = $request->content;
    		$procedureTask->amount_of_work = $request->amount_of_work;
    		$procedureTask->procedure_id = $request->procedure_id;

    		$procedureTask->save();
    		return response()->json(['message' => 'The task was updated!'],200);
    	}
    }

    public function delete($id){
    	$procedureTask = ProcedureTask::find($id);
    	if (!$procedureTask) {
    		return response()->json(['message' => 'The task  does not exist!']);
    	} else {
    		$procedureTask->delete();
    		return response()->json(['message' => 'The task  was deleted!']);
    	}
    }


    public function assignTask(Request $request, $id){
    	$procedureTask = ProcedureTask::find($id);

    	// call api get check user by $request->implementer
    	if (!$procedureTask) {
    		return response()->json(['message' => 'The task  does not exist!']);
    	} else {
    		$procedureTask->implementer = $request->implementer;
	    	$procedureTask->deadline = $request->deadline;

	    	$procedureTask->save();

	    	return response()->json(['message' => 'Assign user for task successfully!']);
    	}
    	
    }


    public function updateProgress(Request $request, $id){
    	$procedureTask = ProcedureTask::find($id);
    	if (!$procedureTask) {
    		return response()->json(['message' => 'The task  does not exist!']);
    	} else {
    		$procedureTask->amount_of_accomplished_work = $request->amount_of_accomplished_work;
	    	$procedureTask->save();
	    	return response()->json(['message' => 'Update progress of task successfully!']);
    	}	
    }


    public function markTaskDone($id){
    	$procedureTask = ProcedureTask::find($id);
    	if (!$procedureTask) {
    		return response()->json(['message' => 'The task  does not exist!']);
    	} else {
    		if ($procedureTask->amount_of_accomplished_work < $procedureTask->amount_of_work) {
    			return response()->json(['message' => 'The task has not been complete, can not mark it done!']);
    		} else {
    			$procedureTask->status = 1;
		    	$procedureTask->save();
		    	return response()->json(['message' => ' Mark task been done  successfully!']);
    		}

    		
    	}	
    }


}
