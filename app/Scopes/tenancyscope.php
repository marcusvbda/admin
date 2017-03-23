<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class tenancyScope implements ScopeInterface
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('tenant_id', '=',Auth::user()->tenant_id); 
        $model->empresa_id = Auth::user()->empresa_id;
    }

    public function remove(Builder $builder, Model $model)
    {    
        $builder->where('tenant_id', '=',Auth::user()->tenant_id);   
    }


}   