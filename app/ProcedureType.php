<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureType extends Model
{
    protected $table = "procedure_types";
    public $timestamp = false;

    public function procedures(){
    	return $this->hasMany('App\Procedure','procedure_type_id', 'id');
    }
}
