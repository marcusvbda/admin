<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class relatoriosController extends controller
{
	
	protected $relatorio_customizado;
	public function __construct()
	{
		$this->relatorio_customizado = $this->model('relatorio_customizado');
	}


	public function getCustomizados()
	{
		echo $this->view('relatorios.customizados',[]);
	}

	public function getSelectrelatorioscustomizados()
	{
		$relatorioscustomizados = $this->relatorio_customizado
			->where('excluido','=','N')
				->where('empresa','=',Auth('empresa'))
					->get();
		echo json_encode($relatorioscustomizados);
	}

	public function postGerarelatoriocustomizado()
	{
		$relatorio_customizado = $this->relatorio_customizado->findOrFail($_POST['id_relatorio_selecionado']);
		$resultado =DB::select( DB::raw($relatorio_customizado->query));

		print_r($resultado);
	}

	public function getFormulariorelatoriocustomizado($id)
	{
		$relatorio_customizado = DB::table('relatorio_customizado')
		  	->where('empresa','=',Auth('empresa'))
		  		->where('id','=',$id)
		  			->get();
		echo json_encode($relatorio_customizado[0]->formulario);
	}
	
}

