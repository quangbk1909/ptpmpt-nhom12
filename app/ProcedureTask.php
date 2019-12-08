<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureTask extends Model
{
    protected $table = "procedure_tasks";

    public function mainTask(){
    	return $this->belongsTo('App\MainTask','main_task_id', 'id');
    }

    public function procedureStep(){
    	return $this->belongsTo('App\ProcedureStep','procedure_step_id','id');
    }
}
