<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class tanqueModel extends Eloquent
{
	protected $table     = "tanque";
	protected $fillable  = ['id','id_desktop','numero_empresa_desktop','capacidade','numero','volumeatual','numero_produto','updated_at','created_at'];
}

