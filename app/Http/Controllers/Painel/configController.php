<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Input;
use App\Parametros;

class configController extends Controller
{ 
  	public function getIndex()
  	{
      if(cannot('configuracoes','get'))
        return abort(505);
      $config = Parametros::first();
		  return view('painel.config.index',compact('config'));
  	}

    public function putSetconfig()
    {
      try
      {
        $dados = Input::all();          
        DB::beginTransaction();
        Parametros::where('tenant_id','=',Auth::user()->tenant_id)->update([$dados['parametro']=>$dados['valor'] ]);
        DB::commit();
        return Response::json(['success'=>true,'msg'=>'Skin alterada com sucesso']); 
      }
      catch(\Exception $d)
      {
      DB::rollBack(); 
        return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);    
      }  
    }

    public function putEdit()
    {
      try
      {      
        $dados = Input::all();
        Parametros::where('tenant_id','=',Auth::user()->tenant_id)->update($dados);
        return Response::json(['success'=>true,'msg'=>'Alterada com sucesso']); 
      }
      catch(\Exception $d)
      {
        return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);    
      }  
    }

    public function getMultiempresa()
    {
      if(cannot('multiempresa','get'))
        return abort(505);
      return view('painel.config.multiempresa');
    }


}
