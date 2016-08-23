<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class empresaController extends controller
{
	
	public function getIndex()
	{		
		

	   

	   	echo $this->view('empresa.index');
	}

	public function getBuscaEmpresas()
	{
		$id_empresa_principal = DB::table('usuarios')->find(Auth('id'))->empresa;
		$empresa = DB::table('empresas')->find($id_empresa_principal);

		$rede_empresa_principal = DB::table('redes_empresas')->where('empresa','=',$id_empresa_principal)->get();
		$rede = DB::table('redes_empresas')->where('empresa','=',$id_empresa_principal)->get();
		$id_rede = $rede[0]->id;
		$empresas_da_rede = DB::table('redes_empresas')
			->join('redes','redes_empresas.rede' ,'=', 'redes.id')
				->join('empresas','empresas.id' ,'=', 'redes_empresas.empresa')
					->select('empresas.*','redes.nome as nome_rede')
						->where('redes_empresas.rede','=',$id_rede)	
							->get();

      	
		$nome_rede = $empresas_da_rede[0]->nome_rede;

      	$qtde_selecionadas = 0;
        foreach(Auth('empresa') as $emp_selecionada):
	       	foreach($empresas_da_rede as $emp):
	   			if($emp->id==$emp_selecionada)
	   				$emp->selecionado = "S"; 
	   		endforeach;
	   	endforeach;	
	   	echo json_encode($empresas_da_rede);
	}

	public function getChecar_empresa($empresa)
	{
		append_empresa($empresa);
	}


	public function getDeschecar_empresa($empresa)
	{
		if(count(Auth('empresa'))>1)
			remove_empresa($empresa);
	}
}