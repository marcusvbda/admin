<?php
class middleware
{

	public function middleware_geral($controller, $metodo)
	{	
		$rota_requerida = $controller.'@'.strtoupper($metodo);

		if ($this->RotaLiberada($rota_requerida))
		  	return true;
		else
		{
			if(CheckAuth())
				return true;
			else
			   redirecionar('usuarios/login');
		}
	}

	private function RotaLiberada($rota_requerida)
	{
		$rotas_liberadas = $this->leArquivoRotasProtegidas();
		$resultado = false;
		if(count($rotas_liberadas)>0)
		{
			foreach ($rotas_liberadas as $rotas_liberada ) 
			{
			 	if( ($rotas_liberada->controller.'@'.strtoupper($rotas_liberada->metodo))==($rota_requerida))
			 	{
			 		$resultado = true;
			 		break;
			 	}
			 	else
			 		$resultado = false;
			}
		}
		else
			$resultado = false;
		return $resultado;
	}


	private function leArquivoRotasProtegidas()
	{
		if(file_exists(__DIR__.'/../../rotas_liberadas.xml'))
		   	return  simplexml_load_file(__DIR__.'/../../rotas_liberadas.xml');
		else
			return null;
	}

}