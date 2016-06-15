<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class usuariosController extends controller
{
	
	public function __construct()
	{
		$this->model = $this->model('usuario');
	}




	public function getIndex()
	{
		echo $this->view('usuarios.index',[]);
	}

	public function getSelectusuarios($filtro = "")
	{
	    $usuarios = $this->model
        	->leftJoin('funcoes', 'funcoes.id', '=', 'usuarios.empresa')
        		->select('funcoes.descricao as funcao','usuarios.*')
        			->where('usuarios.usuario','like',"%$filtro%")
							->where('usuarios.empresa','=',Auth('empresa'))
		        				->get();
		echo json_encode($usuarios);
	}
	public function getEncontrausuario($id)
	{	
		$usuario = $this->model
        	->leftJoin('funcoes', 'funcoes.id', '=', 'usuarios.empresa')
        		->where('usuarios.id','=',$id)
        			->where('usuarios.empresa','=',Auth('empresa'))
		        		->get();
		echo json_encode($usuario);
	}	


	public function getFuncoes()
	{
		echo $this->view('usuarios.funcoes',[]);
	}
	
	public function getLogin()
	{
		LimpaUsuario();
		echo $this->view('usuarios.login',[]);
	}

	public function getSair()
	{
		registralog("Saiu do sistema");
		$this->setlogado(Auth('id'));
		LimpaUsuario();
		redirecionar(asset(''));
	}

	public function getCadastro()
	{
		LimpaUsuario();
		echo $this->view('usuarios.cadastro',[]);
	}

	public function getRenovasenha()
	{
		registralog("Renovou a senha de acesso");
		echo "aqui executa um processamento para renovar senha";
	}

	public function postLogar()
	{
		$usuarios = $this->model
			->where('email','=',$_POST['email'])
				->where('senha','=',md5($_POST['senha']))
					->get();
		if(count($usuarios)>0)	
		{			
			$array = ['id'=>$usuarios[0]->id,'empresa'=>$usuarios[0]->empresa ,'admin'=>$usuarios[0]->admin,
				'grupo_acesso'=>$usuarios[0]->grupo_acesso,'usuario'=>$usuarios[0]->usuario,
					'email'=>$usuarios[0]->email];			
			SalvaUsuario((object) $array);
			$this->setlogado(Auth('id'));
			registralog("Entrou do sistema");
			redirecionar(asset(''));
		}
		else
			voltar();		
	}

	public function Setlogado($id)
	{
		$usuario = $this->model->findOrFail($id);
		if($usuario->logado=="N")
			$usuario->logado="S";
		else
			$usuario->logado="N";
		$usuario->save();
	}
	public function getUsuarioexiste($email)
	{		
		$usuario = $this->model
			->where('email','=',$email)
				->get();

		if(count($usuario)>0)	
		  echo 'SIM';
		else
		  echo 'NAO';
	}

	public function getValidalogin($email,$senha)
	{
		$usuario = $this->model
			->where('email','=',$email)
				->where('senha','=',md5($senha))
					->get();
		if(count($usuario)>0)	
		  echo 'SIM';
		else
		  echo 'NAO';
	}
}