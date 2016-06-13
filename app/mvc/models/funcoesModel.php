<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class funcoesModel extends Eloquent
{
	protected $table     = "funcoes";
	protected $fillable  = ['id','descricao'];
}