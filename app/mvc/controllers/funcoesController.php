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

	public function getEncontrafuncao($id)
	{	
		$funcoes = $this->model->where('id','=',$id)->get();
		echo json_encode($funcoes);
	}	

	public function postExcluir()
	{
		//verifica campo usado
		$funcoes = $this->model->findOrFail($_POST['id']);
		if((count($funcoes)>0)&&($funcoes->usado=="N"))
		{
			$funcoes->delete();
			echo "SIM";
		}
		else
			echo "NAO";
	}

	public function postAlterar()
	{
		//verifica campo usado
		$funcoes = $this->model->findOrFail($_POST['id']);
     	if ($funcoes->usado=="S")
     	{
			echo "NAO";
			exit();
     	}
     	$funcoes->descricao = $_POST['descricao'];
		if($funcoes->save())
		   echo "SIM";
		else
		   echo "NAO";
	}
}