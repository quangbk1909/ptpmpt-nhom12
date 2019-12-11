<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MainTask;
use App\ProcedureTask;
use App\Procedure;
use Validator;
use GuzzleHttp\Client;
use App\Log;
use \Datetime;

class MainTaskController extends Controller
{

	public function getMainTaskList(Request $request){
		$mainTasks = MainTask::all();

		$log = $this->newLog($request);
        $log->type = "main-task";
        $log->response_code = 200;
        $log->save();

		return response()->json($mainTasks);
	}

    public function show(Request $request){
		$mainTask = MainTask::orderBy('created_at', 'desc')->get();
		$tasks = array();
		$departments = $this->getAllDepartment();
		$users = $this->getAllUser();

		foreach ($mainTask as $task) {
    		$procedure = $task->procedure;
    		unset($task['procedure_id']);


    		if ($task->creator != null) {
                foreach ($users as $user) {
                    if ($user->id = $task->creator) {
                        $creator = $user;
                    }
                }
                if ($creator){
                    $task->creator_detail = $creator;
                } else {
                     $task->creator_detail = "User does not exist";
                }
            }

            if ($task->responsible_person != null) {
                foreach ($users as $user) {
                    if ($user->id = $task->responsible_person) {
                        $responsible_person = $user;
                    }
                }

                if ($responsible_person){
                    $task->responsible_person_detail = $responsible_person;
                } else {
                     $task->responsible_person_detail = "User does not exist";
                }
            }

            if ($task->department_id != null) {
                $depart = null;
                foreach ($departments as $department) {
                    if ($department->id = $task->department_id) {
                        $depart = $department;
                    }
                }

                if ($depart){
                    $task->department_detail = $depart;
                } else {
                     $task->department_detail = "Department does not exist";
                }
            }

    		array_push($tasks , $task);
    	}

    	$log = $this->newLog($request);
        $log->type = "main-task";
        $log->response_code = 200;
        $log->save();

		return response()->json($tasks, 200);
	}

	public function getMainTaskByProcedure(Request $request,$id){
		$procedure = Procedure::find($id);
		if (!$procedure) {
			return response()->json (['message' => 'Procedure does not exist!']);
		} else {

			$log = $this->newLog($request);
		    $log->type = "main-task";
		    $log->response_code = 200;
		    $log->save();

			return response()->json ($procedure->mainTasks);
		}
	}


	public function getProcedureTasksList(Request $request,$id){
		$mainTask = MainTask::find($id);
		if($mainTask) {

			$log = $this->newLog($request);
		    $log->type = "main-task";
		    $log->object_id = $mainTask->id;
		    $log->response_code = 200;
		    $log->save();

			return response()->json($mainTask->procedureTasks);
		} else {
			return response()->json (['message' => 'Main task does not exist!']); 
		}
	}


	public function showDetail(Request $request,$id){
		$mainTask = MainTask::find($id);
    	if ($mainTask){
    		$procedure = $mainTask->procedure;
    		$procedureType = $procedure->procedureType;
    		if ($mainTask->creator != null) {
                $creator = $this->getUser($mainTask->creator);
                if ($creator){
                    $mainTask->creator_detail = $creator;
                } else {
                     $mainTask->creator_detail = "User does not exist";
                }
            }

            if ($mainTask->responsible_person != null) {
                $responsible_person = $this->getUser($mainTask->responsible_person);
                if ($responsible_person){
                    $mainTask->responsible_person_detail = $responsible_person;
                } else {
                     $mainTask->responsible_person_detail = "User does not exist";
                }
            }

            if ($mainTask->department_id != null) {
                $department = $this->getDepartment($mainTask->department_id);
                if ($department){
                    $mainTask->department_detail = $department;
                } else {
                     $mainTask->department_detail = "Department does not exist";
                }
            }

            $log = $this->newLog($request);
		    $log->type = "main-task";
		    $log->object_id = $mainTask->id;
		    $log->response_code = 200;
		    $log->save();

    		return response()->json ($mainTask);
    	} else {
    		return response()->json (['message' => 'Main task does not exist!']);
    	}
	}



	public function getProcedureTasks(Request $request,$id){
		$procedureTasks = ProcedureTask::where('main_task_id','=',$id)->orderBy('step', 'desc')->get();

		$tasks = array();
		$users = $this->getAllUser();
        foreach ($procedureTasks as $task) {
            $procedureStep =  $task->procedureStep;

            if ($task->creator != null) {
                //$creator = null;
                // $creator = $this->getUser($task->creator);
                foreach ($users as $user) {
                    if ($user->id = $task->creator) {
                        $creator = $user;
                    }
                }
                if ($creator){
                    $task->creator_detail = $creator;
                } else {
                     $task->creator_detail = "User does not exist";
                }
            } 

            if ($task->implementer != null) {
                //$implementer = $this->getUser($task->implementer);
                foreach ($users as $user) {
                    if ($user->id = $task->implementer) {
                        $implementer = $user;
                    }
                }

                if ($implementer){
                    $task->implementer_detail = $implementer;
                } else {
                     $task->implementer_detail = "User does not exist";
                }
            }

            $log = $this->newLog($request);
		    $log->type = "main-task";
		    $log->object_id = $id;
		    $log->response_code = 200;
		    $log->save();

            array_push($tasks , $task);
        }

        return response()->json($tasks);
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
	    		return response()->json(['message' => 'Procedure does not exist!']);
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
	    		$mainTask->department_id = $request->department_id;

	    		$mainTask->save();

	    		$log = $this->newLog($request);
			    $log->type = "main-task";
			    $log->object_id = $mainTask->id;
			    $log->response_code = 200;
			    $log->save();

	    		return response()->json(['message' => 'Create main task successfully!','main-task' => $mainTask],200);
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
		    		$mainTask->department_id = $request->department_id;

		    		$mainTask->save();

		    		$log = $this->newLog($request);
				    $log->type = "main-task";
				    $log->object_id = $mainTask->id;
				    $log->response_code = 200;
				    $log->save();
		    		
		    		return response()->json(['message' => 'Update main task successfully!','main-task' => $mainTask],200);
		    	}
		    }
		}
		
        
	}


	public function delete(Request $request,$id){
		$mainTask = MainTask::find($id);
		if (!$mainTask) {
			return response()->json(['message' => 'Main task  does not exist!']);
		} else {
			$mainTask->delete();

			$log = $this->newLog($request);
		    $log->type = "main-task";
		    $log->object_id = $id;
		    $log->response_code = 200;
		    $log->save();
    		return response()->json(['message' => 'Delete main task successfully!'], 200);
		}
	}

	public function finish(Request $request,$id){
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
					$lastProcedureTask = ProcedureTask::where('main_task_id', '=', $id)->orderBy('step','desc')->first();
					$lastStep = $mainTask->procedure->procedureSteps->sortByDesc('step')->first();
					if ($lastProcedureTask->step < $lastStep->step) {
						$flag = false;
					}
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

						$log = $this->newLog($request);
					    $log->type = "main-task";
					    $log->object_id = $maintask->id;
					    $log->response_code = 200;
					    $log->save();

						return response()->json(['message' => 'Main task  has been finished!']);
					} else {
						return response()->json(['message' => 'All procedure step in procedure of main task  has not been finished. Can not finish main task!']);
					}
				}
			}
			
		}
	}

	public function getTotal(){
		$nunMainTask = MainTask::count();
		return response()->json(['total' => $nunMainTask]);
	}

	public function analyze(){
		$num_finished_task = MainTask::where('status','=',1)->count();
		$main_tasks_unfinished = MainTask::where('status','=',0)->get();
		$num_unfinished_task = 0;
		$num_overdue_task = 0;
		$date = new DateTime(date("Y-m-d H:i:s"));
		foreach ($main_tasks_unfinished as $task) {
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

    public function getDepartment($id){
        $client = new Client(['base_uri' => 'https://dsd15-department.azurewebsites.net',]);
        try {
            $response = $client->request('GET','/Departments/'.$id);
            $body = $response->getBody();
            return json_decode($body);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getResponse()->getStatusCode() != 200) {
                return false;
            }
        }
    }

    public function getAllDepartment(){
        $client = new Client(['base_uri' => 'https://dsd15-department.azurewebsites.net',]);
        try {
            $response = $client->request('GET','/Departments/');
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


}
