<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class funcoesController extends controller
{

	public function __construct()
	{
		$this->model = $this->model('funcoes');
	}

	public function getSelectfuncoes($filtro = "")
	{	
		$funcoes = $this->model->where('descricao','like',"%$filtro%")->where('empresa','=',Auth('empresa'))->get();
		echo json_encode($funcoes);
	}	

	public function postExcluir()
	{
		//verifica campo usado
		$funcoes = $this->model->where('id','=',$_POST['id']);
		if(count($funcoes)>0)
		{
			$funcoes->delete();
			echo "SIM";
		}
		else
		{
			echo "NAO";
		}
	}
}