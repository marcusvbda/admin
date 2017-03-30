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
    	 return $this->hasMany('App\Abastecimentos','caixa_codigo');
    }
}