<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureTask extends Model
{
    protected $table = "procedure_tasks";

    public function procedure(){
    	return $this->belongsTo('App\Procedure','procedure_id', 'id');
    }
}
