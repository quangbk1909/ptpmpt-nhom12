<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainTask extends Model
{
    protected $table = "main_tasks";

    public function procedure(){
    	return $this->belongsTo('App\Procedure','procedure_id', 'id');
    }


    public function procedure_tasks(){
    	return $this->hasMany('App\ProcedureTask','main_task_id', 'id');
    }

}
