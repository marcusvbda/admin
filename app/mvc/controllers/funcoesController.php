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
		$funcoes = $this->model
			->where('descricao','like',"%$filtro%")
				->where('empresa','=',Auth('empresa'))
					->get();
		echo json_encode($funcoes);
	}	

	public function getEncontrafuncao($id)
	{	
		$funcoes = $this->model
			->where('id','=',$id)
				->where('empresa','=',Auth('empresa'))
					->get();
		echo json_encode($funcoes);
	}	

	public function postExcluir()
	{
		//verifica campo usado
		$funcoes = $this->model->findOrFail($_POST['id']);
		if((count($funcoes)>0)&&($funcoes->usado=="N"))
		{
			registralog("Excluiu a função de usuário id({$funcoes->id}), descrição({$funcoes->descricao}) ");
			$funcoes->delete();
			echo "SIM";
		}
		else
			echo "NAO";
	}

	public function postAlterar_inserir()
	{
		if(trim($_POST['id'])!="")
		{
			$funcoes = $this->model->findOrFail($_POST['id']);
	     	if ($funcoes->usado=="S")
	     	{
				echo "NAO";
				exit();
	     	}
	     	$descricao_antiga = $funcoes->descricao;
	     	$funcoes->descricao = $_POST['descricao'];
			if($funcoes->save())
			{
			   registralog("Alterou a função de usuário (id: {$funcoes->id}) de({$descricao_antiga}) para({$funcoes->descricao})");
			   echo "ALTERADO";
			}
			else
			   echo "NAOALTERADO";	
		}
		else
		{
			$_POST['empresa'] = Auth('empresa');
			if($this->model->create($_POST))
			{
				registralog("Cadastrou a função de usuário descricao({$_POST['descricao']})");
				echo "INSERIDO";
			}
			else
				echo "NAOINSERIDO";
		}		
	}
}