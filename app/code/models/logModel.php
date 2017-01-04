<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class logModel extends Eloquent
{
	protected $table     = "log";
	protected $fillable  = ['id','usuario','descricao','updated_at','created_at'];
}

