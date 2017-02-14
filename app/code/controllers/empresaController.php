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

	public function putSelecionar()
	{
		$dados = Request::get('PUT')['selecionados'];
		$separado_virgula = "";
		for ($i=0; $i < count($dados) ; $i++):
			$separado_virgula.=$dados[$i];
			if($i<count($dados)-1)
				$separado_virgula.=',';
		endfor;
		DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
		->where('id','=',Auth('id'))
		->update(['empresa_selecionada'=>$separado_virgula]);
		append_empresa($dados);			
		Rest::response(true);
	}

	public function getIndex()
	{
		$empresas = DB::table(BANCO_DE_DADOS_USUARIOS.'.redes_empresas')
		->select('empresas.*')
		->join(BANCO_DE_DADOS_USUARIOS.'.empresas','empresas.serie','=','redes_empresas.serie_empresa')
		->where('redes_empresas.rede','=',Auth('rede'))->get();
		echo $this->view('empresa.index',compact('empresas'));
	}



}