<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class relatorio_customizadoModel extends Eloquent
{
	protected $table     = "relatorio_customizado";
	protected $fillable  = ['id','nome','descricao','empresa','query','formulario','excluido','updated_at','created_at'];
}

