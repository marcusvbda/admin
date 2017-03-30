<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Empresas;
class tenancyScope implements ScopeInterface
{
    public function apply(Builder $builder, Model $model)
    {
    	$usuario = Auth::user();
    	if($usuario->multi_tenant!="S")
        	$builder->where('tenant_id', '=',Auth::user()->tenant_id); 
        else
        	$builder->whereIn('tenant_id',explode(",", $usuario->tenant_selecionados)); 
    }

    public function remove(Builder $builder, Model $model)
    {    
        $builder->where('tenant_id', '=',Auth::user()->tenant_id);   

        $usuario = Auth::user();
    	if($usuario->multi_tenant!="S")
        	$builder->where('tenant_id', '=',Auth::user()->tenant_id);           	
        else
        	$builder->whereIn('tenant_id',explode(",", $usuario->tenant_selecionados)); 
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresas', 'tenant_id');
    }


}   