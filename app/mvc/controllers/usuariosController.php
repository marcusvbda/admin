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
								->where('usuarios.excluido','=','N')
		        					->get();
		echo json_encode($usuarios);
	}
	public function getEncontrausuario($id)
	{	
		$usuario = $this->model
        	->leftJoin('funcoes', 'funcoes.id', '=', 'usuarios.empresa')
        		->where('usuarios.id','=',$id)
        			->where('usuarios.empresa','=',Auth('empresa'))
        				->where('usuarios.excluido','=','N')
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
		$this->setlogado(Auth('id'),'S');
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
					'email'=>$usuarios[0]->email,'foto'=>$usuarios[0]->foto];			
			SalvaUsuario((object) $array);
			$this->setlogado(Auth('id'),'S');
			registralog("Entrou do sistema");
			redirecionar(asset(''));
		}
		else
			voltar();		
	}

	public function setlogado($id,$status)
	{
		$usuario = $this->model->findOrFail($id);
		$usuario->logado=$status;
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

	public function validanovoemail($email)
	{		
		if(count($this->model->where('email','=',$email)->where('excluido','=','N')->get())>0)	
		  return false; // email ja cadastrado
		else
		  return true;
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

	public function postTrocafotoperfil()
	{	
		$usuario = $this->model->findOrFail($_POST['usuario']);
		$diretorio = 'uploads/fotos_profile/'.'empresa_'.Auth('empresa');
		criardiretorio($diretorio);
		$diretorio .= '/usuario_'.$_POST['usuario'].'/';
		criardiretorio($diretorio);
		$diretorio .= basename($_FILES['nova_foto']['name']);

		if((trim(strtolower($usuario->foto))!=trim('uploads/fotos_profile/user.png'))&&(file_exists($usuario->foto)))
			unlink($usuario->foto);

		if (move_uploaded_file($_FILES['nova_foto']['tmp_name'], $diretorio)) 
		{
		   $usuario->foto=$diretorio;
		   $usuario->save();		
		   registralog('Alterou a foto do perfil');
		} 
		$this->AtualizaSession($_POST['usuario']);
		echo $usuario->foto;
	}

	public function AtualizaSession($id)
	{
		$usuarios = $this->model
			->where('id','=',$id)
				->get();
		if(count($usuarios)>0)	
		{			
			$array = ['id'=>$usuarios[0]->id,'empresa'=>$usuarios[0]->empresa ,'admin'=>$usuarios[0]->admin,
				'grupo_acesso'=>$usuarios[0]->grupo_acesso,'usuario'=>$usuarios[0]->usuario,
					'email'=>$usuarios[0]->email,'foto'=>$usuarios[0]->foto];			
			SalvaUsuario((object) $array);
		}
	}

	public function postAlterar()
	{
		if($this->validanovoemail($_POST['email']))
		{
			$usuario = $this->model->findOrFail($_POST['id']);
			$usuario->email = $_POST['email'];
			$usuario->usuario = $_POST['usuario'];
			$usuario->tipopessoa = $_POST['tipo'];
			$usuario->CPF_CNPJ = $_POST['cgc'];
			$usuario->dtnascimento = $_POST['dt_nascimento'];
			$usuario->admin = $_POST['admin'];		
			if($usuario->save())
			{
				echo "SIM";
				if(Auth('id')==$usuario->id)
					$this->AtualizaSession($usuario->id);
			}
			else
				echo "NAO";
		}
		else
			echo "NAO";
	}

	public function postExcluir()
	{
		//verifica campo em uso
		$usuario = $this->model->findOrFail($_POST['id']);
		$admins_ativos = count($this->model->where('empresa','=',Auth('empresa'))->where('excluido','=','N')->where('admin','=','S')->get());
		if((count($usuario)>0)&&($usuario->logado=="N")&&($admins_ativos>=1))
		{
			registralog("Excluiu usuário id({$usuario->id}), nome({$usuario->usuario}) ");
			$usuario->excluido="S";
			$usuario->save();
			echo "SIM";
		}
		else
			echo "NAO";
	}

	public function postCadastrar()
	{
		if($this->validanovoemail($_POST['email']))
		{
			$_POST['empresa']=Auth('empresa');
			if($this->model->create($_POST))
				echo "SIM";
			else
				echo "NAO";
		}
		else
			echo "NAO";
	}

	public function postDefinirsenha()
	{	
		if($_POST['defseguranca']=='S')
		{
	   		 $usuario = $this->model->where('email','=',$_POST['defemail'])->get();	   		 
	   		 $usuario = $this->model->findOrFail($usuario[0]->id);
	   		 $usuario->senha=md5($_POST['defsenha']);
	   		 $usuario->save();
		}	
		redirecionar(asset(''));
	}

	public function postRenovarSenha()
	{
		$resultado = enviarEmail($_POST['renov_email'],'Renovação de senha '+APP_NOME,'teste');
		if($resultado['resposta'])
			echo "enviou";
		else
			echo "nao enviou -- ".$resultado['erro'];
	}

}