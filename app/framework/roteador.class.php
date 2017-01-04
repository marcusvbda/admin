<?php


class Route
{
	public function direcionar($caminho)
	{
	    header("location:$caminho");
	}

	public function voltar()
	{
		echo '<script>window.history.back();</script>';
	}

	public function executar($controller,$metodo,$parametros=[])
	{
		call_user_func_array([$controller,$metodo],$parametros);
	}

	public function getParametros($url,$request_method='GET')
	{
		$controller = 'inicioController';
		$metodo     = 'index';
		$parametros = [];
		$posicao    = 0;

		$url = Route::parseUrl($url);

		// pega controller
		if(isset($url[$posicao]))
		{
			if(file_exists(__CODE__.'controllers/'.$url[$posicao].'Controller'.'.php'))
			{
				$controller = $url[$posicao].'Controller';
				unset($url[$posicao]);
				$posicao ++;
			}
		}
		$nome_controller = $controller;	
		require __CODE__.'/controllers/'.$nome_controller.'.php';
		$controller = new $controller;


		// define metodo
		if(isset($url[$posicao]))
		{
			if(method_exists($controller, strtolower($request_method).ucfirst($url[$posicao])))
			{
				$metodo = $url[$posicao];
				unset($url[$posicao]); 
			}
			else
				return 404;
		}
		$metodo = strtolower($request_method).ucfirst($metodo);	
		
		return ['NOME_CONTROLLER'=>$nome_controller,'CONTROLLER'=>$controller,'METODO'=>$metodo,'PARAMETROS'=> $parametros = $url ? array_values($url) : []];
	}

	public function parseUrl($url)
	{
		if(isset($url))
			return explode('/' , filter_var(rtrim($url, '/'),FILTER_SANITIZE_URL));
	}

	private static function find($rotas, $rota_solicitada )
	{
		$retorno = null;
		foreach($rotas as $rota => $parametros):
			if(uppertrim($rota)==uppertrim($rota_solicitada) )
			{
				$retorno = $rotas->{$rota}; 
				break;
			}
		endforeach;
		return $retorno;
	}






}