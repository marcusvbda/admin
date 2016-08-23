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
						->whereRaw("excluido='N' and 
							(numero like '%$filtro%' or 
							nome like '%$filtro%' or
							cnpj like '%$filtro%' or 
							razaosocial like '%$filtro%')")
								->wherein('empresa',Auth('empresa'))
									->paginate(10, ['*'], "pagina", $pagina);
      	$tempo_consulta = microtime(true) - $tempo_inicio;
      	$qtde_registros = $clientes->total();      	
		$clientes->appends(['filtro'=>$filtro])->render();
		echo $this->view('clientes.index',compact('clientes','filtro','tempo_consulta','qtde_registros'));
	}




}
