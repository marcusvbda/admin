<?php
class app 
{	
	protected $request = null;
	public function __construct()
	{
		App::PrepareRest();
		$this->request = Route::getParametros(App::getUrl(),$_SERVER['REQUEST_METHOD']);

		if($this->request==404)
			Route::direcionar(asset('erros/NAO_EXISTE'));
		if($this->request==303)
			Route::direcionar(asset('erros/SEM_PERMISSAO'));
		unset($_POST,$_GET);		
	}

	public function PrepareRest()
	{
		if(isset($_POST['REQUEST_METHOD']))
			$_SERVER['REQUEST_METHOD']=$_POST['REQUEST_METHOD'];

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
	}


	public function getUrl()
	{
		if(isset($_GET['url']))
			return $_GET['url'];
	}

}