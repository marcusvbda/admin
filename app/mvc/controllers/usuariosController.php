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
		print_r(Auth('empresa_selecionada'));
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
						->where('excluido','=',"N")
							->whereRaw("(email like '%$filtro%' or
									 usuario like '%$filtro%')")
								->wherein('empresa',Auth('empresa_selecionada'))
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
        	registralog("Excluiu usuário : ".$_POST['id_usuario']);
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
						->wherein('empresa',Auth('empresa_selecionada'))
							->get();
		// $usuario = DB::table('usuarios')->find($usuario[0]->id);
		if(count($usuario)==0)
			redirecionar(asset('erros/404'));
		$usuario=$usuario[0];
        registralog("Visualizou usuário : ".$id);
		echo $this->view('usuarios.show',compact('usuario'));
	}

	public function postEditar()
	{		
		$usuario = DB::table('usuarios')
			->where('id', $_POST['id'])
            	->update($_POST);
        registralog("Editou usuário : ".$_POST['id']);
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
			$empresas =  remove_repeticao_array(limpa_vazios_array(string_virgulas_array($_POST['empresas_selecionadas'])));
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

	public function postLogar()
	{
		$usuarios = $this->model
			->join('redes_empresas','redes_empresas.empresa','=','usuarios.empresa')
				->select('usuarios.*','redes_empresas.rede')
					->where('usuarios.email','=',$_POST['email'])
						->where('usuarios.senha','=',md5($_POST['senha']))
							->where('usuarios.excluido','=','N')
								->get();

		if(count($usuarios)>0)	
		{			
			$array = ['id'=>$usuarios[0]->id, 'sexo'=>$usuarios[0]->sexo ,'admin_rede'=>$usuarios[0]->admin_rede,'rede'=>$usuarios[0]->rede,'admin'=>$usuarios[0]->admin,'usuario'=>$usuarios[0]->usuario,
					'email'=>$usuarios[0]->email,'manter_login'=>$_POST['manter_login'],'app_id'=>APP_ID];
	
			$array['empresa_selecionada'] = remove_repeticao_array(limpa_vazios_array(string_virgulas_array($usuarios[0]->empresa_selecionada)));
			$array['empresa'] =	array($usuarios[0]->empresa);

			SalvaUsuario($array);
			SetLogado('S');
			registralog("Entrou do sistema");
			$parametros = DB::table('empresa_parametros')
				->join('parametros','parametros.id','=','empresa_parametros.id_parametro')
   							->wherein('empresa',Auth('empresa'))
									->get();
			$array=array();						
			for ($i=0; $i < count($parametros); $i++):
				$array[$parametros[$i]->parametro] = $parametros[$i]->valor;				
			endfor;
			SalvaParametros($array);	
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
		  echo json_encode('SIM');
		else
		  echo json_encode('NAO');
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
			registralog($_POST['defemail']." redefiniu senha para padrão inicial");	
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
			registralog("Enviado email de renovação de senha para :".$_POST['renov_email']);	

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
		registralog("Imprimiu relatório simples de usuários");		
        imprimir($html);
	}


}