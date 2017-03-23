<?php

namespace App\Acl;

use App\globalModel;
use Illuminate\Support\Facades\Auth;
use App\Acl\Acl;
/**
* 
*/

class GruposAcesso extends globalModel 
{
    protected $table = 'grupos_acesso';
    protected $fillable = ['id','descricao','tenant_id'];
    public function acl()
    {
    	 return $this->hasMany('App\Acl\Acl','grupo_acesso_id');
    }
}


