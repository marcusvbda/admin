<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class serviceController extends controller
{
	
	// public function __construct()
	// {
	// 	// $this->model = $this->model('usuario');
	// }




	public function getIndex($tamanho)
	{
		echo "selecione um metodo";
	}

	private function selecionarAlgoritimo($tamanho)
	{
		if (($tamanho>=20)&&($tamanho<50))
		{
			return "criptografia a";
			exit();
		}
		elseif(($tamanho>=100)&&($tamanho<150))
		{
			return "criptografia b";
			exit();
		}
		elseif(($tamanho>=150)&&($tamanho<200))
		{
			return "criptografia c";
			exit();
		}
	}

	public function getCriptografar($texto)
	{
		// $criptogria_selecionada = $this->selecionarAlgoritimo($tamanho);
		// echo $criptogria_selecionada;
		$this->enviarparawebservice(base64_encode($texto));

	}

	private function enviarparawebservice($codigo)
	{
		//envia
		echo "ENVIOU";
	}
	
}