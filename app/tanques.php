<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;
use App\Produtos;

class Tanques extends globalModel 
{
    protected $table = 'tanque';

    public function produto()
    {
        return $this->hasOne(Produtos::class,'codigo','produto_codigo');
    }
}