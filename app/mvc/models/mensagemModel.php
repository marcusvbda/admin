<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class mensagemModel extends Eloquent
{
	protected $table     = "mensagens";
	protected $fillable  = ['id_remetente','mensagem','id_destinatario','lido','dt_envio'];
}


