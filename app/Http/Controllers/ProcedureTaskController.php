<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\ProcedureTask;
use App\MainTask;
use Illuminate\Http\Request;


class ProcedureTaskController extends Controller
{
	public function getTasksCreated($userID){
		$procedureTasks = ProcedureTask::where('creator','=',$userID)->orderBy('created_at', 'desc')->get();
		$tasks = array();
		foreach ($procedureTasks as $task) {
    		$mainTask = $task->mainTask;
    		unset($task['main_task_id']);
    		array_push($tasks , $task);
    	}

		return response()->json($tasks, 200);
	}


	public function getTasksImplemented($userID){
		$procedureTasks = ProcedureTask::where('implementer','=',$userID)->orderBy('created_at', 'desc')->get();
		$tasks = array();
		foreach ($procedureTasks as $task) {
    		$mainTask = $task->mainTask;
    		unset($task['main_task_id']);
    		array_push($tasks , $task);
    	}

		return response()->json($tasks, 200);
	}


	public function showDetail($id){
		$task = ProcedureTask::find($id);
    	if ($task){
    		$mainTask = $task->mainTask;
    		$procedure = $mainTask->procedure;
    		$procedureType = $procedure->procedureType;
    		// Call api to get info creator of task
    		// Call api to get info implementer of task

    		return response()->json ($task);
    	} else {
    		return response()->json (['message' => 'Task does not exist!']);
    	}
	}


    public function create(Request $request){
    	$mainTask = MainTask::find($request->main_task_id);
        $lastStep = ProcedureTask::where('main_task_id','=',$request->main_task_id)->orderBy('step', 'desc')->first();
    	// call api check user exist with id creator
    	if(!$mainTask) {
    		return response()->json(['message' => 'Main task  does not exist!']);
    	} else if(0){
    		return response()->json(['message' => 'The user who created this task  does not exist!']);
    	} else {
    		$procedureTask = new ProcedureTask;
    		$procedureTask->name = $request->name;
    		$procedureTask->content = $request->content;
    		$procedureTask->amount_of_work = $request->amount_of_work;
    		$procedureTask->main_task_id = $request->main_task_id;
    		$procedureTask->creator = $request->creator;

            if (!$lastStep) {
                $procedureTask->step = 1;
            } else {
                $procedureTask->step = $lastStep->step + 1;
            }
    		$procedureTask->save();
    		return response()->json(['message' => 'Create task successfully!'],200);
    	}

    }

    public function update(Request $request, $id){
    	$mainTask = MainTask::find($request->main_task_id);
    	// call api check user exist with id creator
    	if(!$mainTask) {
    		return response()->json(['message' => 'Main task  does not exist!']);
    	} else if(0){
    		return response()->json(['message' => 'The user who created this task  does not exist!']);
    	} else {
    		$procedureTask = ProcedureTask::find($id);
            if(!$procedureTask) {
                return response()->json(['message' => 'Procedure task  does not exist!']);
            } else {
                $procedureTask->name = $request->name;
                $procedureTask->content = $request->content;
                $procedureTask->amount_of_work = $request->amount_of_work;

                $procedureTask->save();
                return response()->json(['message' => 'The task was updated!'],200);
            }
    		
    	}
    }

    public function delete($id){
    	$procedureTask = ProcedureTask::find($id);
    	if (!$procedureTask) {
    		return response()->json(['message' => 'The task  does not exist!']);
    	} else {
            $step = $procedureTask->step;
    		$procedureTask->delete();
            $stepAfter = ProcedureTask::where('step','>',$step)->get();
            foreach ($stepAfter as $task) {
                $task->step -= 1;
            }
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
		    	return response()->json(['message' => 'Mark task been done  successfully!']);
    		}

    		
    	}	
    }

    public function swapStep(Request $request){
        $firstTask = ProcedureTask::find($request->first_task_id);
        $secondTask = ProcedureTask::find($request->second_task_id);

        if (!$firstTask) {
            return response()->json(['message' => 'The first task  does not exist!']);
        } else if (!$secondTask) {
            return response()->json(['message' => 'The second task  does not exist!']);
        } else {
            $temp = $firstTask->step;
            $firstTask->step = $secondTask->step;
            $secondTask->step = $temp;
            $firstTask->save();
            $secondTask->save();
            return response()->json(['message' => 'Swap step between two task successfully!']);
        }
    }

    public function getList(Request $request){
        $ids = $request->id;
        $data = array();

        if(!$ids){
            return response()->json(['message' => 'No id or list id to get procedure task']);
        } else {
            foreach ($ids as $id) {
                $task = ProcedureTask::find($id);
                if(!$task){
                    $task_info = array('id' => $id,
                                        'data' => 'There is no task corresponding to id!');
                    array_push($data, $task_info);
                } else {
                    $task_info = array('id' => $id,
                                        'data' => $task);
                    array_push($data, $task_info);
                }
            }
            return response()->json($data);
        }
        
    }
}
