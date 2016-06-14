<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class usuarioModel extends Eloquent
{
	protected $table     = "usuarios";
	protected $fillable  = ['id','usuario','tipopessoa','CPF_CNPJ','site','dtnascimento','empresa','senha','foto','grupo_acesso','email','admin','logado'];
}

