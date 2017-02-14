<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class configuracoesController extends controller
{
	public function __construct()
	{
		$this->model = $this->model('parametros');
	}


	public function getIndex()
	{
		if(!Access('GET','parametros'))
			return App::erro(505);

		$parametros = $this->model->get();
		$array=array();						
		for ($i=0; $i < count($parametros); $i++):
			$array[$parametros[$i]->parametro] = $parametros[$i]->valor;				
		endfor;
		SalvaParametros($array);	
		echo $this->view('configuracoes.index',compact('parametros'));
	}

	public function getBuscaparametros()
	{
		$parametros = $this->model->get();

		echo json_encode($parametros);
	}	

	public function postSalvar()
	{	
		$_POST = request::get('POST',['valida_token'=>false]);
		foreach (Auth('empresa_selecionada') as $empresa):
			foreach ($_POST as $parametro =>$valor):
				$banco = __PREFIXO_BANCO__.$empresa.".parametros";
			 	DB::table($banco)->where("id",'=',$parametro)->update(['valor'=>$valor]);
			endforeach;
		endforeach;
		redirecionar(asset('configuracoes'));
	}

	
}

