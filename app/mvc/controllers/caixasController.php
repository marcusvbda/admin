<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class caixasController extends controller
{

	public function getIndex()
	{
		echo $this->view('caixas.frente');
	}

	public function getProduto($produto="")
	{
		$produto = strtoupper($produto);

		$produtos = DB::table('produtos')->where('codigobarras','=',$produto)->get();

		if(count($produtos)==0)
			$produtos = DB::table('produtos')->where('codigo','=',$produto)->get();

		if(count($produtos)==0)
			$produtos = DB::table('produtos')->where('descricao','=',$produto)->get();

		if(count($produtos)==0)
			$produtos = DB::table('produtos')->where('nomefantasia','=',$produto)->get();

		if(count($produtos)==0)
			$produtos = DB::table('produtos')->where('descricao','like',"%".$produto."%")->get();

		if(count($produtos)==0)
			$produtos = DB::table('produtos')->where('nomefantasia','like',"%".$produto."%")->get();


		echo json_encode($produtos);
	}
	
}



		