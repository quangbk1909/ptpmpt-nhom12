<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\ProcedureTask;
use App\MainTask;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Log;


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
            if ($task->creator != null) {
                $creator = $this->getUser($task->creator);
                if ($creator){
                    $task->creator = $creator;
                } else {
                     $task->creator = "User does not exist";
                }
            } else {
                $task->creator = null;
            }

            if ($task->implementer != null) {
                $implementer = $this->getUser($task->implementer);
                if ($implementer){
                    $task->implementer = $implementer;
                } else {
                     $task->implementer = "User does not exist";
                }
            } else {
                $task->implementer = null;
            }

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

            $log = new Log;
            $log->action = 'User id '. $request->user_id . ' create new procedure task '; 
            $log->save();

    		return response()->json(['message' => 'Create task successfully!','task' => $procedureTask],200);
    	}

    }

    public function update(Request $request, $id){
        $procedureTask = ProcedureTask::find($id);
    	$mainTask = MainTask::find($procedureTask->main_task_id);
    	// call api check user exist with id creator
    	if(!$mainTask) {
    		return response()->json(['message' => 'Main task  does not exist!']);
    	} else if(0){
    		return response()->json(['message' => 'The user who created this task  does not exist!']);
    	} else {
            if(!$procedureTask) {
                return response()->json(['message' => 'Procedure task  does not exist!']);
            } else {
                $procedureTask->name = $request->name;
                $procedureTask->content = $request->content;
                $procedureTask->amount_of_work = $request->amount_of_work;

                $procedureTask->save();

                $log = new Log;
                $log->action = 'User id '. $request->user_id . ' update  procedure task id-'.$id; 
                $log->save();

                return response()->json(['message' => 'The task was updated!','task' => $procedureTask],200);
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

            $log = new Log;
            $log->action = 'User id '. $request->user_id . ' delete  procedure task id-'.$id; 
            $log->save();

    		return response()->json(['message' => 'The task  was deleted!']);
    	}
    }


    public function assignTask(Request $request, $id){
    	$procedureTask = ProcedureTask::find($id);

    	$implementer = $this->getUser($request->implementer);
    	if (!$procedureTask) {
    		return response()->json(['message' => 'The task  does not exist!']);
    	} else if (!$implementer){
            return response()->json(['message' => 'The user who be assigned does not exist!']);
        } else {

    		$procedureTask->implementer = $request->implementer;
	    	$procedureTask->deadline = $request->deadline;

	    	$procedureTask->save();

            $log = new Log;
            $log->action = 'User id '. $request->user_id . ' assign user for procedure task id-'.$id; 
            $log->save();

	    	return response()->json(['message' => 'Assign user for task successfully!','task' => $procedureTask]);
    	}
    	
    }


    public function updateProgress(Request $request, $id){
    	$procedureTask = ProcedureTask::find($id);
    	if (!$procedureTask) {
    		return response()->json(['message' => 'The task  does not exist!']);
    	} else {
    		$procedureTask->amount_of_accomplished_work = $request->amount_of_accomplished_work;
	    	$procedureTask->save();

            $log = new Log;
            $log->action = 'User id '. $request->user_id . ' update progress of  procedure task id-'.$id; 
            $log->save();

	    	return response()->json(['message' => 'Update progress of task successfully!','task' => $procedureTask]);
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

                $log = new Log;
                $log->action = 'User id '. $request->user_id . ' mark done procedure task id-'.$id; 
                $log->save();

		    	return response()->json(['message' => 'Mark task been done  successfully!','task' => $procedureTask]);
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
