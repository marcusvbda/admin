<?php
namespace App;
use App\globalModel;
use Illuminate\Support\Facades\Auth;


class historico extends globalModel 
{
    protected $table = 'historico';
    protected $fillable = ['id','usuario_id','tipo','titulo','descricao','ref_id','tenant_id','created_at','updated_at'];
    // public static function scopeQtde($query,$tipo,$ativo = true)
    // {
    //     if($ativo)
    //         $ativo="S";
    //     else
    //         $ativo="N";

    //     return $query->where('ativo','=',$ativo)->where('classificacao','=',$tipo)->count();
    // }

   
}