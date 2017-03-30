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
use App\Produtos;
use App\GruposProduto;
use App\TiposProduto;


class productsController extends Controller
{ 
  	public function getIndex()
  	{     
      $produtos = Produtos::all();
      $grupos = GruposProduto::all();
      $tipos = TiposProduto::all();
      $gp_tipo = 'TODOS';
      $tp_tipo = 'TODOS';
      return view('painel.produtos.index',compact('produtos','grupos','gp_tipo','tipos','tp_tipo'));
    }

    public function postIndex()
  	{     
        $dados  = Input::all(); 
        $grupos = GruposProduto::all();
        $tipos  = TiposProduto::all();
        $produtos = Produtos::where('_id','>',0);
        if($dados['codigo_tipo']!="TODOS")
        	$produtos->where('tipoproduto_codigo','=',$dados['codigo_tipo']);
        if($dados['codigo_grupo']!="TODOS")
        	$produtos->where('grupoproduto_codigo','=',$dados['codigo_grupo']);

        $produtos = $produtos->get();
        $gp_tipo = $dados['codigo_grupo'];
        $tp_tipo = $dados['codigo_tipo'];
        return view('painel.produtos.index',compact('produtos','grupos','gp_tipo','tipos','tp_tipo'));
    }

    public function getShow($id)
    {
      $id = base64_decode($id);
      $produto = Produtos::find($id);
      return view('painel.produtos.show',compact('produto'));
    }


}
