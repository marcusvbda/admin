<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;


class Produtos extends globalModel 
{
    protected $table = 'Produtos';
    protected $primaryKey = '_id';

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

    public function grupoproduto()
    {
        return $this->hasOne(Gruposproduto::class,'codigo');
    }

    public function tiposproduto()
    {
        return $this->hasOne(Tiposproduto::class,'codigo');
    }

    public static function scopePorcentagemComEstoque($query,$total)
    {
    	if($total<=0)
    		return 0;
        $baixo = $query->where('estoque','<=',parametro('estoque_baixo'))->count();   

        return porcentagem($baixo,$total);
    }
}

