<?php

namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;

class Funcionarios extends globalModel 
{
    protected $table = 'funcionarios';
    protected $primaryKey = '_id';    
}
