<?php
class app 
{	
	protected $request = null;
	public function __construct()
	{
		App::PrepareRest();
		$this->request = Route::getParametros(App::getUrl(),$_SERVER['REQUEST_METHOD']);
		$_POST=null;$_GET=null;$_FILES=null;
		$this->request;			
		switch ($this->request) 
		{
			case 505:
				$erro = 505;
				$sub  = "Página Bloqueada !!";
				$subsub  = "Você não tem acesso a esta página :(";
				Controller::view('paginas.erro',compact('erro','sub','subsub'));
				exit;
			case 404:
				$erro = 404;
				$sub  = "Página não encontrada !!";
				$subsub  = "Você deve ter se confundido :(";
				Controller::view('paginas.erro',compact('erro','sub','subsub'));
				exit;
		}
	}

	public function erro($erro)
	{
		switch ($erro) 
		{
			case 505:
				$erro = 505;
				$sub  = "Página Bloqueada !!";
				$subsub  = "Você não tem acesso a esta página :(";
				Controller::view('paginas.erro',compact('erro','sub','subsub'));
				exit;
			case 404:
				$erro = 404;
				$sub  = "Página não encontrada !!";
				$subsub  = "Você deve ter se confundido :(";
				Controller::view('paginas.erro',compact('erro','sub','subsub'));
				exit;
		}
		
	}

	public function PrepareRest()
	{
		if(isset($_POST['REQUEST_METHOD']))
			$_SERVER['REQUEST_METHOD']=uppertrim($_POST['REQUEST_METHOD']);
		else
			$_SERVER['REQUEST_METHOD'] = uppertrim($_SERVER['REQUEST_METHOD']);

		switch ($metodo = $_SERVER['REQUEST_METHOD'])
		{
			case 'GET':
				Request::set('GET',$_GET);
				break;
			case 'POST':
				Request::set('POST',$_POST);
				break;		
			case 'DELETE':
				Request::set('DELETE',$_POST);	
				break;		
			case 'PUT':
				Request::set('PUT',$_POST);		
				break;	
			case 'HEAD':
				Request::set('HEAD',$_POST);				
				break;			
			case 'OPTION':
				Request::set('OPTION',$_POST);				
				break;			
			default:
				return false;
				break;
		}
	}

	public function run()
	{
		if(middleware::liberado($this->request['NOME_CONTROLLER'],$this->request['METODO']))
			Route::executar($this->request['CONTROLLER'],$this->request['METODO'],$this->request['PARAMETROS']);
		else
			App::erro(505);
	}


	public function getUrl()
	{
		if(isset($_GET['url']))
			return $_GET['url'];
	}

}