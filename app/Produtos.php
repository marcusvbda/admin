<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;


class Produtos extends globalModel 
{
    protected $table = 'Produtos';

    public static function scopeQtde($query,$ativo = true)
    {
        if($ativo)
            $ativo="S";
        else
            $ativo="N";

        $result = $query->get();
        if($result->isEmpty())
        	return 0;
        else
        	return count($result);
    }

    public static function scopePorcentagemComEstoque($query,$qtde)
    {
    	if($qtde<=0)
    		return 0;
        $total = $query->where('estoque','<=',parametro('estoque_baixo'))->count();
    
        if($total>0)
            $percentual = ($qtde*100) / $total;
        else
            $percentual = 0;

        return round($percentual,parametro('qtde_dec_porcento'));
    }
}


