<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresas extends Model
{
    protected $table = 'tenant';
    protected $fillable = ['id','razao','nome','created_at','updated_at'];
}
