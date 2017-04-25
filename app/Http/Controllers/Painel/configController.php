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
use App\Empresas;
use App\User;

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
      
      $selecionados = explode(',', Auth::user()->tenant_selecionados);
      $empresas = array();
      foreach (Auth::user()->empresa->rede->empresas as $empresa):
        if(in_array($empresa->id,$selecionados))
          array_push($empresas,(object)['id'=>$empresa->id,'nome'=>$empresa->nome,'razao'=>$empresa->razao,'selecionado'=>uppertrim('S')]);
        else
          array_push($empresas,(object)['id'=>$empresa->id,'nome'=>$empresa->nome,'razao'=>$empresa->razao,'selecionado'=>
            uppertrim('N')]);
      endforeach;
      return view('painel.config.multiempresa',compact('empresas'));
    }

    public function putSelecionarempresa()
    {
      try
      {      
        $dados = Input::all();         
        $selecionados = explode(',', Auth::user()->tenant_selecionados);
       
        if($dados['valor']=="S")
        {
          if(!in_array($dados['id'],$selecionados))
            array_push($selecionados,$dados['id']);
        }
        else
        {
          if(in_array($dados['id'],$selecionados) && ($dados['id']!=Auth::user()->tenant_id))
            unset($selecionados[array_search($dados['id'],$selecionados)]);
        }
        if(count($selecionados)>0):
          if(count($selecionados)==1)
            User::where('id','=',Auth::user()->id)->update(['tenant_selecionados' => implode(',',$selecionados),'multi_tenant'=>"N",'tenant_id'=>implode(',',$selecionados)]);
          else
            User::where('id','=',Auth::user()->id)->update(['tenant_selecionados' => implode(',',$selecionados),'multi_tenant'=>"S"]);
        endif;
        return Response::json(['success'=>true]);
      }
      catch(\Exception $e)
      {
        return Response::json(['success'=>false]);    
      }  
    }


}
