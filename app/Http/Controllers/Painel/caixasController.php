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
use App\Caixas;
use App\Abastecimentos;
use App\DadosFaturamento;
use App\GruposProduto;

class caixasController extends Controller
{ 
  	public function getIndex()
  	{   
  	  	if(cannot('caixas','get'))
			return abort(505);	
	    $caixas = Caixas::all();
	    $filtro['de_abertura'] = "";
	    $filtro['ate_abertura'] = "";
	    $filtro['de_hora_abertura'] = "";
	    $filtro['ate_hora_abertura'] = "";

	    $filtro['de_fechamento'] = "";
		$filtro['ate_fechamento'] = "";
		$filtro['de_hora_fechamento'] = "";
		$filtro['ate_hora_fechamento'] = "";
	    return view('painel.caixas.index',compact('caixas','filtro'));
    }

    public function postIndex()
  	{     
  		if(cannot('caixas','get'))
			return abort(505);

		$filtro = Input::all();

		$caixas = Caixas::where('_id','>',0);
		if(isset($filtro)):	
			if($filtro['de_abertura']!="")
				$caixas->where('data_abertura','>=',$filtro['de_abertura']);

			if($filtro['ate_abertura']!="")
				$caixas->where('data_abertura','<=',$filtro['ate_abertura']);

			if($filtro['de_hora_abertura']!="")
				$caixas->where('hora_abertura','>=',$filtro['de_hora_abertura']);

			if($filtro['ate_hora_abertura']!="")
				$caixas->where('hora_abertura','<=',$filtro['ate_hora_abertura']);


			if($filtro['de_fechamento']!="")
				$caixas->where('data_fechamento','>=',$filtro['de_fechamento']);

			if($filtro['ate_fechamento']!="")
				$caixas->where('data_fechamento','<=',$filtro['ate_fechamento']);

			if($filtro['de_hora_fechamento']!="")
				$caixas->where('hora_fechamento','>=',$filtro['de_hora_fechamento']);

			if($filtro['ate_hora_abertura']!="")
				$caixas->where('hora_fechamento','<=',$filtro['ate_hora_fechamento']);
		endif;
		$caixas = $caixas->get();
		return view('painel.caixas.index',compact('caixas','filtro'));
    }

    public function getShow($id)
    {
    	$id = base64_decode($id);
    	$caixa = Caixas::find($id);
    	$porcentagem = $this->calcularporcentagens($caixa->codigo);
	    return view('painel.caixas.show',compact('caixa','porcentagem'));
    }

    private function calcularporcentagens($caixa)
    {
      $dadosfaturamento = DadosFaturamento::where('excluido','=','N')->where('caixa_codigo','=',$caixa)->get();
      $grupos = GruposProduto::all();      
      $total = $dadosfaturamento->count();
      $result = array();
        // $query = select("
        // select
        //    count(*) as qtde from dadosfaturamento d    
        //    join produtos p on p.codigo=d.produto_codigo
        //    join gruposprodutos gp on gp.codigo=p.grupoproduto_codigo
        // where 
        // d.excluido='N' and 
        // d.caixa_codigo=$caixa and 
        // gp.codigo=8");
      foreach ($grupos as $grupo):
	    // $query = DadosFaturamento::join('produtos','produtos.codigo','=','dadosfaturamento.produto_codigo')
	    //   ->join('gruposprodutos','gruposprodutos.codigo','=','produtos.grupoproduto_codigo')
	    //   ->select('dadosfaturamento.*')
	    //   ->where('dadosfaturamento.caixa_codigo','=',$caixa)
	    //   ->where('gruposprodutos.codigo','=',$grupo->codigo)
	    //   ->count();
        array_push($result,(object)['codigo_grupo'=>$grupo->codigo,'descricao_grupo'=>$grupo->descricao,'porcentagem'=>0]);
      endforeach;
      return $result;

    }

}