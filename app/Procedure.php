<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = "procedures";

    public function procedureType(){
    	return $this->belongsTo('App\ProcedureType','procedure_type_id', 'id');
    }

    public function procedureTasks(){
    	return $this->hasMany('App\ProcedureTask','procedure_id', 'id');
    }
}
