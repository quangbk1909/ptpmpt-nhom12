<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\ProcedureTask;
use App\MainTask;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Log;
use \Datetime;


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

    public function getDetailProcedure($id){
        $procedureTask = ProcedureTask::find($id);
        if($procedureTask){
            $mainTask = $procedureTask->mainTask;
            $procedureStep =  $procedureTask->procedureStep;

            return response()->json($procedureTask);
        } else {
            return response()->json (['message' => 'Task does not exist!']);
        }


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
            $procedureStep = $task->procedureStep;
    		$procedureType = $procedure->procedureType;
            if ($task->creator != null) {
                $creator = $this->getUser($task->creator);
                if ($creator){
                    $task->creator_detail = $creator;
                } else {
                     $task->creator_detail = "User does not exist";
                }
            } 

            if ($task->implementer != null) {
                $implementer = $this->getUser($task->implementer);
                if ($implementer){
                    $task->implementer_detail = $implementer;
                } else {
                     $task->implementer_detail = "User does not exist";
                }
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
            $procedureTasks = ProcedureTask::all();

            $tasks = array();
            foreach ($procedureTasks as $task) { 
                $procedureStep =  $task->procedureStep;
                array_push($tasks , $task);
            }

            return response()->json($tasks);
        } else {
            foreach ($ids as $id) {
                $task = ProcedureTask::find($id);
                if(!$task){
                    $task_info = array('id' => $id,
                                        'data' => 'There is no task corresponding to id!');
                    array_push($data, $task_info);
                } else {
                    $procedureStep =  $task->procedureStep;

                    $task_info = array('id' => $id,
                                        'data' => $task);
                    array_push($data, $task_info);
                }
            }
            return response()->json($data);
        }
        
    }


    public function getListTask(){
        $procedureTask = ProcedureTask::all();
        return response()->json($procedureTask);
    }


    public function analyze(){
        $num_finished_task = ProcedureTask::where('status','=',1)->count();
        $procedure_tasks_unfinished = ProcedureTask::where('status','=',0)->get();
        $num_unfinished_task = 0;
        $num_overdue_task = 0;
        $date = new DateTime(date("Y-m-d H:i:s"));
        foreach ($procedure_tasks_unfinished as $task) {
            $deadline = new DateTime($task->deadline);
            if ($date < $deadline) {
                $num_unfinished_task += 1;
            } else {
                $num_overdue_task += 1;
            }
        }

        return response()->json([
                                    'num_finished_task' => $num_finished_task,
                                    'num_unfinished_task' => $num_unfinished_task,
                                    'num_overdue_task' => $num_overdue_task
                                ]);

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
