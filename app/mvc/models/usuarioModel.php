<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class usuarioModel extends Eloquent
{
	protected $table     = "usuarios";
	protected $fillable  = ['id','usuario','empresa','senha','email','admin','admin_rede','logado','sexo'];
}

