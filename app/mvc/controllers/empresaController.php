<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class empresaController extends controller
{

	protected $usuario;
	public function __construct()
	{
		$this->usuario = $this->model('usuario');
	}
	
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

		$empresas_da_rede = add_campo_objeto('selecionado','N',$empresas_da_rede);
      	foreach(Auth('empresa') as $emp_selecionada):
	   		$empresas_da_rede[object_search($emp_selecionada,"id",$empresas_da_rede)]->selecionado = "S";
	   	endforeach;	

	   	echo json_encode($empresas_da_rede);
	}

	public function postSelecionar_empresas()
	{
		$empresas_selecionadas =  remove_repeticao_array(limpa_vazios_array(string_virgulas_array($_POST['empresas_selecionadas'])));
		append_empresa($empresas_selecionadas);
		$usuario = $this->usuario->find(Auth('id'));
		$usuario->empresa = separa_array_virgulas($empresas_selecionadas);
		$usuario->save();
        registralog("Alterou emprsas selecionadas");
		redirecionar(asset('empresa'));
	}

	public function getBuscaEmpresasEspecificas($operacao,$nova,$selecionadas)
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
				
      	$empresas_da_rede = add_campo_objeto('selecionado','N',$empresas_da_rede);
      	$selecionadas  = string_virgulas_array($selecionadas);


        foreach($selecionadas as $emp_selecionada):
	   		$empresas_da_rede[object_search($emp_selecionada,"id",$empresas_da_rede)]->selecionado = "S";
	   	endforeach;	


	   	if($operacao=="DESMARCAR")
	   		$empresas_da_rede[object_search($nova,"id",$empresas_da_rede)]->selecionado = "N";
	   	else
	   		$empresas_da_rede[object_search($nova,"id",$empresas_da_rede)]->selecionado = "S";

	   
	   	echo json_encode($empresas_da_rede);
	}
}