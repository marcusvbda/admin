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
		$parametros_acesso = $this->model
						->join('parametros','parametros.id','=','empresa_parametros.id_parametro')
   							->wherein('empresa',Auth('empresa'))
   								->groupby('parametro')
									->get();
		SalvaParametros([$parametros_acesso[0]->parametro=>$parametros_acesso[0]->valor]);	
		echo $this->view('configuracoes.index',compact('parametros_acesso'));
	}

	public function getBuscaparametros()
	{
		$parametros = $this->model
				->join('parametros','parametros.id','=','empresa_parametros.id_parametro')
						->where('parametros.classificacao','!=',"MULTIEMPRESA")
   							->wherein('empresa_parametros.empresa',Auth('empresa'))
	   							->groupby('parametro')
									->get();
		echo json_encode($parametros);
	}	

	public function postSalvar()
	{
		if((Auth('admin_rede')=="S")&&(count(Auth('empresa'))>1))
		{
			$nova_configuracao = $_POST;
			$id_parametros = array();
			foreach ($nova_configuracao as $id => $valor):
				array_push($id_parametros,$parametro_id = $this->model->find($id)->id_parametro);				
			endforeach;

			foreach ($_POST as $parametro =>$valor):
				$config = $this->model
						->where("id_parametro",'=',$parametro)
							->wherein('empresa',Auth('empresa'))
								->update(['valor'=>$valor]);
			endforeach;
		}
		else
		{
			$nova_configuracao = $_POST;	
			foreach ($_POST as $parametro =>$valor):
				$config = $this->model
						->where("id_parametro",'=',$parametro)
							->wherein('empresa',Auth('empresa'))
								->update(['valor'=>$valor]);
			endforeach;
		}
		redirecionar(asset('configuracoes'));
	}

	
}

