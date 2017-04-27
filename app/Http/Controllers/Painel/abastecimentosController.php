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

use App\Abastecimentos;
use App\Bombas;


class abastecimentosController extends Controller
{ 
  	public function getIndex()
  	{     
  		if(cannot('abastecimentos','get'))
			return abort(505);

		$abastecimentos = Abastecimentos::all();
		$bicos = Bombas::all();
		$filtro['bico'] = "";
		$filtro['de'] = "";
		$filtro['ate'] = "";
		$filtro['de_hora'] = "";
		$filtro['ate_hora'] = "";
		return view('painel.abastecimentos.index',compact('abastecimentos','bicos','filtro'));
    }

    public function postIndex()
  	{     
  		if(cannot('abastecimentos','get'))
			return abort(505);

		$filtro = Input::all();

		$abastecimentos = Abastecimentos::where('_id','>',0);
		if(isset($filtro)):	
			if($filtro['bico']!="TODOS")
				$abastecimentos->where('bomba_codigo','=',$filtro['bico']);

			if($filtro['de']!="")
				$abastecimentos->where('data','>=',$filtro['de']);
			if($filtro['ate']!="")
				$abastecimentos->where('data','<=',$filtro['ate']);

			if($filtro['de_hora']!="")
				$abastecimentos->where('hora','>=',$filtro['de_hora']);
			if($filtro['ate_hora']!="")
				$abastecimentos->where('hora','<=',$filtro['ate_hora']);
		endif;
		$abastecimentos = $abastecimentos->get();

		$bicos = Bombas::all();
		return view('painel.abastecimentos.index',compact('abastecimentos','bicos','filtro'));
    }

    public function getReport()
    {
    	if(cannot('abastecimentos','get'))
			return abort(505);
		$bicos = Bombas::all();
		$filtro['bico'] = "";
		$filtro['de'] = "";
		$filtro['ate'] = "";
		$filtro['de_hora'] = "";
		$filtro['ate_hora'] = "";
		return view('painel.abastecimentos.report',compact('abastecimentos','bicos','filtro'));
	}

	public function postPrintreport()
	{
		$filtro = Input::all();
		$where = "";
		if(isset($filtro['bico']))
			if($filtro['bico']!="TODOS")
				$where .= " and a.bomba_codigo=".$filtro['bico'];

		if(isset($filtro['de']))
			$where .= " and a.data>'".$filtro['de']."'";
		if(isset($filtro['ate']))
			$where .= " and a.data>'".$filtro['ate']."'";
    	return relatorio('_abastecimentos_basico',['parametros'=>$where]);
	}

}
