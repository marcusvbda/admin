<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class usuariosController extends controller
{
	protected $model;
	
	public function __construct()
	{
		$this->model = $this->model('usuario');
	}







	public function getFuncoes()
	{
		return $this->view('usuarios.funcoes',[]);
	}
	
	public function getLogin()
	{
		LimpaUsuario();
		return $this->view('usuarios.login',[]);
	}

	public function getSair()
	{
		LimpaUsuario();
		voltar();
	}

	public function getCadastro()
	{
		LimpaUsuario();
		return $this->view('usuarios.cadastro',[]);
	}

	public function getRenovasenha()
	{
		return "aqui executa um processamento para renovar senha";
	}

	public function postLogar()
	{
		$usuarios = $this->model
			->where('email','=',$_POST['email'])
				->where('senha','=',md5($_POST['senha']))
					->get();
		if(count($usuarios)>0)	
		{			
			$array = ['id'=>$usuarios[0]->id,'empresa'=>$usuarios[0]->empresa ,'usuario'=>$usuarios[0]->usuario,'email'=>$usuarios[0]->email];
			SalvaUsuario((object) $array);
			redirecionar(asset(''));
		}
		else
			voltar();
		
	}

	public function getUsuarioexiste($email)
	{		
		$usuario = $this->model
			->where('email','=',$email)
				->get();

		if(count($usuario)>0)	
		  return 'SIM';
		else
		  return 'NAO';
	}

	public function getValidalogin($email,$senha)
	{
		$usuario = $this->model
			->where('email','=',$email)
				->where('senha','=',md5($senha))
					->get();
		if(count($usuario)>0)	
		  return 'SIM';
		else
		  return 'NAO';
	}
}