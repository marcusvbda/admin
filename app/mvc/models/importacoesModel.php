<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class importacoesModel extends Eloquent
{
	protected $table     = "importacoes";
	protected $fillable  = ['id','arquivos','qtde_registros','qtde_inserts','qtde_updates','importado','usuario','empresa','updated_at','created_at'];
}

