<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class empresaController extends controller
{
	
	public function getIndex()
	{		
		$id_empresa_principal = DB::table('usuarios')->find(Auth('id'))->empresa;
		$empresa = DB::table('empresas')->find($id_empresa_principal);
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";
		if(isset($_GET['pagina']))
			$pagina = $_GET['pagina'];
		else
			$pagina = "1";
		$tempo_inicio = microtime(true);
		$rede_empresa_principal = DB::table('redes_empresas')->where('empresa','=',$id_empresa_principal)->get();
		$rede = DB::table('redes_empresas')->where('empresa','=',$id_empresa_principal)->get();
		$id_rede = $rede[0]->id;
		$empresas_da_rede = DB::table('redes_empresas')
			->join('redes','redes_empresas.rede' ,'=', 'redes.id')
				->join('empresas','empresas.id' ,'=', 'redes_empresas.empresa')
					->select('empresas.*','redes.nome as nome_rede')
						->where('redes_empresas.rede','=',$id_rede)	
							->whereRaw("( empresas.razao like '%$filtro%' or
								 empresas.nome like '%$filtro%')")
								->paginate(10, ['*'], "pagina", $pagina);
      	$tempo_consulta = microtime(true) - $tempo_inicio;
	    $qtde_registros = $empresas_da_rede->total();
		$nome_rede = $empresas_da_rede[0]->nome_rede;
      	$empresas_da_rede->appends(['filtro'=>$filtro])->render();
        foreach(Auth('empresa') as $emp_selecionada):
	       	foreach($empresas_da_rede as $emp):
	   			if($emp->id==$emp_selecionada)
	   				$emp->selecionado = "S";      				
	   		endforeach;
	   	endforeach;	

	   	echo $this->view('empresa.index',compact(
	   		'empresa','empresas_da_rede','nome_rede',
	   		'empresas_da_rede','qtde_registros','tempo_consulta','filtro'));
	}

	public function getChecar_empresa($empresa)
	{
		append_empresa($empresa);
		redirecionar(asset('empresa'));
	}


	public function getDeschecar_empresa($empresa)
	{
		if(count(Auth('empresa'))>1)
			remove_empresa($empresa);
			redirecionar(asset('empresa'));
	}
}