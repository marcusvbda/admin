<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class clientesController extends controller
{

	public function getIndex()
	{	
		$clientes = DB::table('clientes')
						->where('excluido','=','N')
							->get();
		echo $this->view('clientes.index',compact('clientes'));
	}


	public function getShow($id)
	{
		if($id=="")
			App::erro(404);
		$cliente = DB::table('clientes')			
				->where('sequencia','=',$id)
					->where('excluido','=','N')
							->get();
		if(count($cliente)==0)
			App::erro(404);
		$cliente=$cliente[0];
		registralog("Visualizou o cliente :".$id);	

		echo $this->view('clientes.show',compact('cliente'));
	}


	public function postRelatorio_simples()
	{     	
		if(isset($_POST['filtro']))
			$filtro = strtoupper($_POST['filtro']);
		else
			$filtro = "";

		$clientes = DB::table('clientes')
						->whereRaw("excluido='N' and 
							(numero like '%$filtro%' or 
							nome like '%$filtro%' or
							cnpj like '%$filtro%' or 
							razaosocial like '%$filtro%')")
									->get();
		$campo_relatorio = array(''=>'numero','Nome'=>'nome','Razão'=>'razaosocial','CPF / CNPJ'=>'cnpj');

		$html = prepararelatorio($campo_relatorio,$clientes,"Relatório Simples de Clientes");
		registralog("Imprimiu relatório simples de clientes");
        imprimir($html);

	}
}
