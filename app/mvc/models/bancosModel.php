<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class bancosModel extends Eloquent
{
	protected $table     = "bancos";
	protected $fillable  = ['id','numero_desktop','nome','excluido','empresa','updated_at','created_at'];
}

