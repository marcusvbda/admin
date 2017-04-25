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
        $builder->whereIn('tenant_id',explode(',',Auth::user()->tenant_selecionados));    
    }

    public function remove(Builder $builder, Model $model)
    {    
        $builder->whereIn('tenant_id',explode(',',Auth::user()->tenant_selecionados));    
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresas', 'tenant_id');
    }


}   