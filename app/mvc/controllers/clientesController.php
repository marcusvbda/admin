<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class clientesController extends controller
{

	public function getIndex()
	{
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";
		if(isset($_GET['pagina']))
			$pagina = $_GET['pagina'];
		else
			$pagina = "1";

		$filtro = strtoupper($filtro);
      	$tempo_inicio = microtime(true);		
		$clientes = DB::table('clientes')
						->where('excluido','=','N')
						->whereRaw("(numero like '%$filtro%' or 
							nome like '%$filtro%' or
							cnpj like '%$filtro%' or 
							razaosocial like '%$filtro%')")
									->paginate(10, ['*'], "pagina", $pagina);
      	$tempo_consulta = microtime(true) - $tempo_inicio;
      	$qtde_registros = $clientes->total();      	
		$clientes->appends(['filtro'=>$filtro])->render();
		echo $this->view('clientes.index',compact('clientes','filtro','tempo_consulta','qtde_registros'));
	}


	public function getShow($id)
	{
		if($id=="")
			redirecionar(asset('erros/404'));
		$cliente = DB::table('clientes')			
				->where('sequencia','=',$id)
					->where('excluido','=','N')
							->get();
		if(count($cliente)==0)
			redirecionar(asset('erros/404'));
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
