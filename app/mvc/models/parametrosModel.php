<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class parametrosModel extends Eloquent
{
	protected $table     = "empresa_parametros";
	protected $fillable  = ['id','empresa','rede','id_parametro','valor','usuario_ultima_alteracao','updated_at','created_at'];
}

