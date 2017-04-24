<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;
use App\abastecimentos;

class Caixas extends globalModel 
{
    protected $primaryKey = '_id';	
    protected $table = 'caixa';

    public function abastecimentos()
    {
    	 return $this->hasMany('App\Abastecimentos','caixa_codigo','codigo');
    }
    public function cupons()
    {
    	 return $this->hasMany('App\Dadosfaturamento','caixa_codigo','codigo')->groupBy('numeronota');
    }
    public function manutencao()
    {
         return $this->hasMany('App\Manutencaocaixa','caixa_codigo','codigo');
    }

}