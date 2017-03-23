<?php

namespace App\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
/**
* 
*/

class Acl extends Model 
{
	protected $model;
    protected $table = 'grupo_acesso_permissoes';
    protected $fillable = ['id','grupo_acesso_id','valor','permissao_id','tenant_id']; 
    protected $timestamp = false;
    public static function scopeCan($query,$modulo,$permissao)
    {
    	return $query->join("permissoes","permissoes.id","=","grupo_acesso_permissoes.permissao_id")
        ->join("modulos","modulos.id","=","permissoes.modulo_id")
        ->where("grupo_acesso_permissoes.tenant_id","=",Auth::user()->tenant_id)
        ->where("grupo_acesso_permissoes.grupo_acesso_id","=",Auth::user()->grupo_acesso_id)
        ->where("modulos.nome","=",$modulo)
        ->where("permissoes.nome","=",$permissao)
        ->where("grupo_acesso_permissoes.valor","=","S")
		->select("grupo_acesso_permissoes.valor");
    }
    public function permissoes()
    {
        return $this->hasMany('App\Acl\Permissoes','id','permissao_id');
    }
}

