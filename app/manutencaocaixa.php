<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;

use App\Funcionarios;

class Manutencaocaixa extends globalModel 
{
    protected $table = 'manutencaocaixa';
    protected $primaryKey = '_id';      

    public function funcionario()
    {
         return $this->hasOne(Funcionarios::class,'codigo','funcionario_codigo');
    }
}
