<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainTask extends Model
{
    protected $table = "main_tasks";

    public function procedure(){
    	return $this->belongsTo('App\Procedure','procedure_id', 'id');
    }


    public function procedureTasks(){
    	return $this->hasMany('App\ProcedureTask','main_task_id', 'id');
    }


    public function checkStepHasTask(int $step){
    	$procedureTasks = $this->procedureTasks;
    	if (!$procedureTasks) {
    		return false;
    	} else {
    		foreach ($procedureTasks as $procedureTask) {
    			if($procedureTask->step == $step) {
    				return true;
    			}
    		}
    	}

    	return false;
    }

    public function getTaskByStep(int $step) {
    	$procedureTasks = $this->procedureTasks;
    	$tasks = array();
    	if (!$procedureTasks) {
    		return $procedureTasks;
    	} else {
    		foreach ($procedureTasks as $task) {
    			if($task->step == $step){
    				array_push($tasks, $task);
    			}
    		}
    		return $tasks;
    	}
    }

}
