<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;
use App\Produtos;

class Dadosfaturamento extends globalModel 
{
    protected $table = 'dadosfaturamento';

    public function produto()
    {
        return $this->hasOne(Produtos::class,'codigo','produto_codigo');
    }
    public function produtos()
    {
        return $this->hasMany(Produtos::class,'codigo','produto_codigo');
    }
}