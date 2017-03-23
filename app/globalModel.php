<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\tenancyScope;
use Illuminate\Support\Facades\Auth;


class globalModel extends Model
{
	protected static function boot() 
    {
        static::addGlobalScope(new tenancyScope);
        parent::boot();
        static::creating(function ($model)
        {
            $model->tenant_id = Auth::user()->tenant_id;
        });
    }

    
    public function empresa()
    {
    	 return $this->belongsTo('App\Empresas', 'tenant_id');
    }
}



