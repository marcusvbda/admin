<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;


class Pessoas extends globalModel 
{

    protected $table = 'pessoas';

    protected $fillable = ['id','bloqueado','codigo','razao','nome','classificacao','tipo','CPF_CNPJ','email','ativo','created_at','updated_at'];

    public function contatos()
    {
        return $this->hasMany('app\Contatos','pessoa_id');
    }    



    public static function scopeQtde($query,$tipo,$ativo = true)
    {
        if($ativo)
            $ativo="S";
        else
            $ativo="N";

        return $query->where('ativo','=',$ativo)->where('classificacao','=',$tipo)->whereNotIn('nome',['CLIENTE','FORNECEDOR'])->count();
    }

    public static function scopePorcento($query,$tipo,$qtde)
    {
        $total = $query->where('tenant_id', '=',Auth::user()->tenant_id)->where('classificacao','=',$tipo)->whereNotIn('nome',['CLIENTE','FORNECEDOR'])->count();
        if($total>0)
            $percentual = ($qtde*100) / $total;
        else
            $percentual = 0;

        return round($percentual,3);
    }
}


class Contatos extends globalModel 
{

    protected $table = 'contatos';
    protected $fillable = ['id','codigo','telefone','celular','email','pessoa_id'];
}