<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureStep extends Model
{
    protected $table = "procedure_steps";

    public $timestamps = false;

    public function procedure(){
    	return $this->belongsTo('App\Procedure','procedure_id', 'id');
    }

    public function procedureTasks(){
    	return $this->hasMany('App\ProcedureTask','procedure_step_id','id');
    }
}
