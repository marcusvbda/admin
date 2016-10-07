<?php
class middleware
{
	public function middleware_geral($controller, $metodo)
	{	
		$rota_requerida = _route($controller.'@'.$metodo);
		if ($this->RotaLiberada($rota_requerida))
		  	return true;
		else
		{
			if(CheckAuth())
			{
				if($this->RotaProtegida($rota_requerida))
				{
					if(Auth('admin')=="S")
						return true;
					else
						redirecionar(asset('erros/403'));
				}
				else
					return true;
			}
			else
				redirecionar(asset('usuarios/login'));
		}
	}

	private function RotaLiberada($rota_requerida)
	{
		$rotas_liberadas = rotas_liberadas();
		if(in_array($rota_requerida,$rotas_liberadas))
			return true;
		else
			return false;
	}

	private function RotaProtegida($rota_requerida)
	{
		$rotas_protegida = rotas_protegidas();
		if(in_array($rota_requerida,$rotas_protegida))
			return true;
		else
			return false;
	}

}