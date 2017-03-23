<?php

namespace App\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Acl\Acl;
/**
* 
*/

class Permissoes extends Model 
{
    protected $table = 'permissoes';
    protected $fillable = ['id','descricao','nome','descricao','modulo_id'];

    public function acl()
    {
    	 return $this->hasOne('App\Acl\Acl','permissao_id','id');
    }
}


