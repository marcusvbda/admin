<?php
	class Session
	{		
		public function set($campo,$valor)
		{
			unset($_SESSION['GLOBAL'][$campo]);
			$_SESSION['GLOBAL']=[$campo=>$valor];
		}

		public function get($campo)
		{
			if(isset($_SESSION['GLOBAL'][$campo]))
				return $_SESSION['GLOBAL'][$campo];
			else
				return null;
		}
	}

	class Request
	{		
		public function set($metodo,$valor)
		{
			unset($valor['REQUEST_METHOD']);
			$metodo = strtoupper($metodo);
			unset($_REQUEST['REQUEST'][$metodo]);
			$_REQUEST['REQUEST']=[$metodo=>$valor];
			if((isset($_FILES))&&(count($_FILES)>0))
				$_REQUEST['REQUEST']['FILES']= $_FILES;
		}

		// consultar parametros padroes da função array_param($array,$campo) neste mesmo arquivo
		public function get($metodo,$config = [])
		{
			if(array_param($config,'limpa_campos_vazios'))	
				$_REQUEST['REQUEST'][$metodo] = limparcamposbrancos($_REQUEST['REQUEST'][$metodo]);

			if(!array_param($config,'valida_token'))
				return $_REQUEST['REQUEST'][$metodo];

			if(array_param($config,'valida_token'))
			{
				if(!isset($_REQUEST['REQUEST'][$metodo]['__TOKEN']))
					return JSON::response("Request indevido:erro 303, Acesso negado!!");
				else
				{
					unset($_REQUEST['REQUEST'][$metodo]['__TOKEN']);
					return $_REQUEST['REQUEST'][$metodo];
				}
			}
			return JSON::response("Request indevido:erro 303, Acesso negado!!");
		}

		public function getToken()
		{
			return md5(date("dmyH"));
		}

		public function validaToken($token)
		{
			return ($token==Request::getToken());
		}
	}


	class JSON
	{
		
		public function response($valor)
		{
			echo json_encode($valor);
		}
	}

	function limparcamposbrancos($array)
	{
		foreach ($array as $campo => $value) 
		{
			if(($array[$campo]=="")||(is_null($array[$campo])))
				unset($array[$campo]);
		}
		return $array;
	}

	function array_param($array,$campo)
	{	
		$parametros_padrao = ['valida_token'=>true,'limpa_campos_vazios'=>false];
		if(isset($array[$campo]))
		{
			if($array[$campo])
				return true;
			else
				return false;
		}	
		else
			return $parametros_padrao[$campo];
	}