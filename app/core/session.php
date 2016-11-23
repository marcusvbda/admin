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
		}

		public function get($metodo,$valida_token = true)
		{
			if(isset($_REQUEST['REQUEST'][$metodo]))
			{
				if($tem_token)
				{
					if (Request::validaToken($_REQUEST['REQUEST'][$metodo]['__TOKEN']))
						unset($_REQUEST['REQUEST'][$metodo]['__TOKEN']);
					else
					{
						echo json_encode("Request indevido:erro 303, Acesso negado!!");
						exit();
					}
				}
				return $_REQUEST['REQUEST'][$metodo];
			}
			else
				return null;
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