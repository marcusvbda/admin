<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;

class Bombas extends globalModel 
{
    protected $table = 'bomba';
    public function tanque()
    {
        return $this->hasOne(Tanques::class,'codigo');
    }
}