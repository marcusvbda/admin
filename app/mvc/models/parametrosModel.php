<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class parametrosModel extends Eloquent
{
	protected $table     = "parametros";
	protected $fillable  = ['id','classificacao','titulo','tipo','valor','parametro','descricao','updated_at','created_at'];
}

