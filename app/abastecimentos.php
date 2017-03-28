<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;
use App\Produtos;
use App\Bombas;

class Abastecimentos extends globalModel 
{
    protected $table = 'abastecimentos';
    public function bomba()
    {
        return $this->hasOne(Bombas::class,'codigo','bomba_codigo');
    }
    public function produto()
    {
        return $this->hasOne(Produtos::class,'codigo');
    }
    // public function caixa()
    // {
    //     return $this->hasOne(Caixa::class,'codigo');
    // }
}
