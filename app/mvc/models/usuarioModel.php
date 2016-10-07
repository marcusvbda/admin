<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class usuarioModel extends Eloquent
{
	protected $table     =  BANCO_DE_DADOS_USUARIOS.".usuarios";
	protected $fillable  = ['id','usuario','empresa','empresa_selecionada','senha','email','admin','admin_rede','logado','sexo'];
}

