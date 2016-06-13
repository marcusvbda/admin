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
		$resultado = "";
		$funcoes = $this->model->where('descricao','like',"%$filtro%")->where('empresa','=',Auth('empresa'))->get();
		// <td>1</td><td>2</td>
		// foreach ($funcoes as $funcao)
		// {
		// 	$resultado.="<tr><th>$funcao->id</th>
		// 				 <th>$funcao->descricao</th></tr>";
		// }
		echo json_encode($funcoes);
	}	
}