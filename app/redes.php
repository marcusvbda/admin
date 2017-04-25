<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Empresas;
class Redes extends Model 
{
    protected $table = 'redes';

    public function empresas()
    {
        return $this->hasMany(Empresas::class,'rede_id');
    }
}