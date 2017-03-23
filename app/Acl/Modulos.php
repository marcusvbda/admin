<?php

namespace App\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Acl\Permissoes;
/**
* 
*/

class Modulos extends Model 
{
    protected $table = 'modulos';
    protected $fillable = ['id','nome','descricao'];

    public function permissoes()
    {
    	 return $this->hasMany('App\Acl\Permissoes','modulo_id','id');
    }
}

