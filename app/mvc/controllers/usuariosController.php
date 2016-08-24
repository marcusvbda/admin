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
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";
		if(isset($_GET['pagina']))
			$pagina = $_GET['pagina'];
		else
			$pagina = "1";
      	$tempo_inicio = microtime(true);
		$usuarios =  DB::table('usuarios')
						->whereRaw("excluido='N'and 
								(email like '%$filtro%' or
								 usuario like '%$filtro%')")
							->wherein('empresa',Auth('empresa'))
								->paginate(10, ['*'], "pagina", $pagina);
      	$tempo_consulta = microtime(true) - $tempo_inicio;
      	$qtde_registros = $usuarios->total();  
      	$usuarios->appends(['filtro'=>$filtro])->render();


		echo $this->view('usuarios.index',compact('usuarios','filtro','tempo_consulta','qtde_registros'));
	}

	public function postDestroy()
	{
		if($this->valida_exclusao($_POST['id_usuario']))
		{
			$usuario = $this->model->find($_POST['id_usuario']);
			$usuario->excluido="S";
			$usuario->save();
		}
		redirecionar(asset('usuarios'));
	}

	private function valida_exclusao($id)
	{
		// pensar em uma logica
		return true;
	}

	public function getShow($id)
	{
		if($id=="")
			redirecionar(asset('erros/404'));
		$usuario = DB::table('usuarios')
			->select('usuarios.*','empresas.razao as empresa_razao')
				->join('empresas','empresas.id','=','usuarios.empresa')
					->where('usuarios.id','=',$id)
						->wherein('empresa',Auth('empresa'))
							->get();
		// $usuario = DB::table('usuarios')->find($usuario[0]->id);
		if(count($usuario)==0)
			redirecionar(asset('erros/404'));
		$usuario=$usuario[0];
		echo $this->view('usuarios.show',compact('usuario'));
	}

	public function postEditar()
	{		
		$usuario = DB::table('usuarios')
			->where('id', $_POST['id'])
            	->update($_POST);
		redirecionar(asset("usuarios/show/{$_POST['id']}"));
	}


	public function getUsuarioexiste_editar($email,$id)
	{		
		$usuario = $this->model
			->where('email','=',$email)
				->where('excluido','=','N')
					->where('id','!=',$id)
						->get();

		if(count($usuario)>0)	
		  echo 'SIM';
		else
		  echo 'NAO';
	}


	private function emailemuso($email)
	{
		$email = DB::table('usuarios')
					->where('email','=',$email)
						->where('excluido','=','N')
							->get();
		if(count($email)>0)
			return true;
		else 
			return false;
	}


	public function getNovo()
	{
		echo $this->view('usuarios.novo');		
	}


	public function postStore()
	{
		$empresas = Auth('empresa');
		if(Auth('admin_rede')=="S")
			$empresas  = string_virgulas_array(substr_replace($_POST['empresas'], '', -1));
		$usuario = $_POST;
		$usuario['senha'] = md5($usuario['senha']);
		foreach ($empresas as $empresa):			
			$usuario['empresa'] = $empresa;
			$this->model->create($usuario);
		endforeach;		
		redirecionar(asset('usuarios'));
	}


	public function getEncontrausuario($id)
	{	
		$usuario = $this->model
        	->leftJoin('funcoes', 'funcoes.id', '=', 'usuarios.empresa')
        		->where('usuarios.id','=',$id)
        			->wherein('usuarios.empresa',$empresas)
        				->where('usuarios.excluido','=','N')
		        			->get();
		echo json_encode($usuario);
	}	

	
	public function getLogin()
	{
		LimpaUsuario();
		echo $this->view('usuarios.login',[]);
	}

	public function getSair()
	{
		registralog("Saiu do sistema");
		LimpaUsuario();
		redirecionar(asset('usuarios/login'));
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
					->where('excluido','=','N')
						->get();

		if(count($usuarios)>0)	
		{			
			$array = ['id'=>$usuarios[0]->id,'empresa'=>array($usuarios[0]->empresa), 'sexo'=>$usuarios[0]->sexo ,'admin_rede'=>$usuarios[0]->admin_rede,'admin'=>$usuarios[0]->admin,'usuario'=>$usuarios[0]->usuario,
					'email'=>$usuarios[0]->email,'manter_login'=>$_POST['manter_login'],'app_id'=>APP_ID];			
			SalvaUsuario($array);
			SetLogado('S');
			registralog("Entrou do sistema");
			redirecionar(asset('inicio'));
		}
		else
			voltar();		
	}

	public function getUsuarioexiste($email)
	{		
		$usuario = $this->model
			->where('email','=',$email)
				->where('excluido','=','N')
					->get();

		if(count($usuario)>0)	
		  echo 'SIM';
		else
		  echo 'NAO';
	}

	public function validanovoemail($email,$id=0)
	{		
		if(count($this->model->where('email','=',$email)->where('excluido','=','N')->where('id','!=',$id)->get())>0)	
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
		$usuario = $this->model->where('email','=',$_POST['renov_email'])->get();	   		 
	   	$usuario = $this->model->findOrFail($usuario[0]->id);
	   	$usuario->senha=md5('0123456789');
	   	if($usuario->save())
	   	{
			$email = '<h4 style="text-align:center;">Renovação de senha</h4>';
			$email.= '<span style="text-align:center;">A senha deste usuário foi alterada para <Strong> 0123456789 </strong>,</span>';
			$email.= '<span style="text-align:center;">faça o primeiro <a href="'.asset('login').'">login</a> utilizando esta senha e altere-a.</span>';
			enviarEmail($_POST['renov_email'],'Renovação de senha '.APP_NOME,$email);
		}
		redirecionar(asset(''));
	}

	public function postRelatorio_simples()
	{
		if(isset($_POST['filtro']))
			$filtro = strtoupper($_POST['filtro']);
		else
			$filtro = "";

		$usuarios =  DB::table('usuarios')
						->whereRaw("excluido='N'and 
								(email like '%$filtro%' or
								 usuario like '%$filtro%')")
							->wherein('empresa',Auth('empresa'))
								->get();
		$campo_relatorio = array('Nome'=>'usuario','Email'=>'email','Sexo'=>'sexo','Administrador'=>'admin');

		$html = prepararelatorio($campo_relatorio,$usuarios,"Relatório Simples de Usuários");
        gerarpdf($html);
	}


}