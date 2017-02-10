<?php
	class Session
	{		
		public function set($campo,$valor)
		{
			unset($_SESSION[md5('GLOBAL')][md5(__APP_NOME__)][$campo]);
			$_SESSION[md5('GLOBAL')][md5(__APP_NOME__)][$campo]=$valor;
		}

		public function delete($campo)
		{
			unset($_SESSION[md5('GLOBAL')][md5(__APP_NOME__)][$campo]);
		}

		public function get($campo)
		{
			if(isset($_SESSION[md5('GLOBAL')][md5(__APP_NOME__)][$campo]))
				return $_SESSION[md5('GLOBAL')][md5(__APP_NOME__)][$campo];
			else
				return null;
		}

		public function destroy()
		{
			unset($_SESSION[md5('GLOBAL')][md5(__APP_NOME__)]);
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
					return REST::response("Request indevido:erro 303, Acesso negado!!");
				else
				{
					unset($_REQUEST['REQUEST'][$metodo]['__TOKEN']);
					return $_REQUEST['REQUEST'][$metodo];
				}
			}
			return REST::response("Request indevido:erro 303, Acesso negado!!");
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


	class REST
	{
		
		public function Response($valor)
		{
			echo json_encode($valor);
			return $valor;
		}
	}

