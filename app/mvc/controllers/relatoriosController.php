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

		// $results = DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = '$someVariable'") );
	}

	public function postGerarelatoriocustomizado()
	{
		echo "Oi";

	}

	public function getFormulariorelatoriocustomizado($id)
	{
		$relatorio_customizado = DB::table('relatorio_customizado')
		  	->where('empresa','=',Auth('empresa'))
		  		->where('id','=',$id)
		  			->get();
		echo $relatorio_customizado[0]->formulario;
	}
	
}

