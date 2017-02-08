<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class usuariosController extends controller
{
	
	public function __construct()
	{	
		$this->model = Controller::model('usuario');
	}

	public function qtde()
	{
		return  count($usuarios =  DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
						->where('empresa','=',Auth('serie_empresa'))
							->where('excluido','=',"N")
								->get());
	}	
	

	public function getIndex()
	{
		if(!Access("GET","usuarios"))
			return App::erro(505);

		$usuarios =  DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
						->where('empresa','=',Auth('serie_empresa'))
							->where('excluido','=',"N")
								->get();
		Controller::view('usuarios.index',compact('usuarios'));
	}

	public function deleteExcluir()
	{
		try
		{
			if(!Access("DELETE","usuarios"))
				return App::erro(505);

			$USUARIO = Request::get('DELETE');
			DB::beginTransaction();	
			if($this->valida_exclusao($USUARIO['id']))
			{
				$usuario = $this->model->find($USUARIO['id']);
				$usuario->excluido="S";
				$usuario->save();
				if($USUARIO['id']==Auth('id'))
					LimpaUsuario();
			}
			Rest::Response(true);
			db::commit();
		}
		catch(Exception $e)
		{
			Rest::Response(false);
			db::rollback();
		}
	}

	private function valida_exclusao($id)
	{
		// pensar em uma logica
		return true;
	}

	public function getShow($id)
	{
		if($id=="")
			Route::direcionar(asset('erros/404'));

		if(!Access("GET","usuarios"))
			return App::erro(505);
	
		$usuario = DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
				->where('usuarios.id','=',$id)
					->get();
		if(count($usuario)==0)
			Route::direcionar(asset('erros/404'));
		$usuario=$usuario[0];
		Controller::view('usuarios.show',compact('usuario'));
	}

	public function putEditar()
	{		
		if(!Access("PUT","usuarios"))
			return App::erro(505);
		$request = Request::get('PUT');
		$usuario = DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
			->where('id', $request['id'])
            	->update($request);
		Route::direcionar(asset("usuarios/show/{$request['id']}"));
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
		$email = DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
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
		Controller::view('usuarios.novo');		
	}


	public function postNovo()
	{
		try
		{
			if(!Access("POST","usuarios"))
				return REST::Response(false);

			$dados = Request::get('POST')['dados'];
			$dados['senha']=md5($dados['senha']);
			$dados['empresa']=Auth('serie_empresa');
			$dados['empresa']=Auth('serie_empresa');
			DB::beginTransaction();
			$id_usuario = db::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')->insertGetId($dados);
			REST::Response(true);
			// savelog("postStore","usuario","Cadastrou o usuario id ".$id_usuario);			
			DB::commit();
		}
		catch(Exception $e)
		{
			DB::rollBack();
			// savelog("postStore","usuario","Erro ( ".$e." )");				
			REST::Response(false);
		}
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
		Controller::view('usuarios.login',[]);
	}

	public function getSair()
	{
		LimpaUsuario();
		Route::direcionar(asset('usuarios/login'));
	}

	public function postLogar()
	{
		$_POST = Request::get('POST');
		$_POST['manter_login'] = ($_POST['manter_login']=='S');
		if(attempt(['email'=>$_POST['email'],'senha'=>$_POST['senha'],'manter'=>$_POST['manter_login'] ]))		
			Route::direcionar(asset('inicio'));
		else
			Route::voltar();	
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

	public function postRestvalidanovoemail()
	{		
		$request = Request::get('POST',['valida_token'=>false]);
		$email = $request['email'];
		if(isset($request['id']))
		{
			$id = $request['id'];
			$consulta = $this->model->where('email','=',$email)->where('excluido','=','N')->where('id','!=',$id)->get();
		}
		else
			$consulta = $this->model->where('email','=',$email)->where('excluido','=','N')->get();

		if(count($consulta)>0)	
		  Rest::response(false); // email ja cadastrado
		else
		  Rest::response(true);
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
		$_POST = Request::get('POST');
		if($_POST['defseguranca']=='S')
		{
	   		$usuario = $this->model->where('email','=',$_POST['defemail'])->get();	   		 
	   		$usuario = $this->model->findOrFail($usuario[0]->id);
	   		$usuario->senha=md5($_POST['defsenha']);
	   		$usuario->save();
		}	
		Route::direcionar(asset(''));
	}

	public function postRenovarSenha()
	{
		$_POST = Request::get('POST');
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
		Route::direcionar(asset(''));
	}

	public function postRelatorio_simples()
	{
		$_POST = Request::get('POST');
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
        imprimir($html);
	}


}