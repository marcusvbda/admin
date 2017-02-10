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

	public function deleteExcluirGrupoAcesso()
	{					
		try
		{
			if(!Access("DELETE","grupo_acesso"))
				return REST::Response(false);

			$id = Request::get('DELETE')['id'];	
			DB::beginTransaction();			

			db::table(BANCO_DE_DADOS_USUARIOS.'.grupo_acesso')->where('id','=',$id)->update(['excluido'=>'S']);
			DB::commit();		
			REST::Response(true);		
		}
		catch(Exception $e)
		{
			DB::rollBack();			
			REST::Response(false);	
		}
	}

	public function getGrupos_Acesso()
	{
		if(!Access("GET","grupos_acesso"))
			return App::erro(505);

		$grupos =  DB::table(BANCO_DE_DADOS_USUARIOS.'.grupo_acesso')->where("excluido","=","N")->get();
		Controller::view('usuarios.grupos_acesso.index',compact('grupos'));
	}

	public function getCreate_Grupos_Acesso()
	{
		if(!Access("POST","grupos_acesso"))
			return App::erro(505);
		$modulos = db::table(BANCO_DE_DADOS_USUARIOS.'.modulos')->where("habilitado","=","S")->get();
		Controller::view('usuarios.grupos_acesso.create',compact('modulos'));
	}

	public function postValidaNomeGrupoAcesso()
	{
		$request    = Request::get('POST',['valida_token'=>false]);
		$_SESSION['dados']=$request;
		$descricao  = $request['descricao'];
		if(isset($request['id']))
		{
			$grupos = db::table(BANCO_DE_DADOS_USUARIOS.'.grupo_acesso')->where('excluido','=','N')->where('descricao','=',$descricao)->where('id','!=',$request['id'])->get();
		}
		else
			$grupos = db::table(BANCO_DE_DADOS_USUARIOS.'.grupo_acesso')->where('excluido','=','N')->where('descricao','=',$descricao)->get();

		if(count($grupos)>0)
			REST::Response(false);
		else
			REST::Response(true);
	}

	public function putEditGrupoAcesso()
	{
		try
		{
			if(!Access("PUT","grupos_acesso"))
				return REST::Response(false);

			$dados = Request::get('PUT');
			$id_grupo = $dados['id'];
			unset($dados['id']);
			$descricao = $dados['descricao'];
			unset($dados['descricao']);	
			DB::beginTransaction();			
			$dados = $this->processadadosGrupoAcesso($dados,$id_grupo);	
				db::table(BANCO_DE_DADOS_USUARIOS.'.config_grupo_acesso')->where('grupo_acesso_id','=',$id_grupo)->delete();
				db::table(BANCO_DE_DADOS_USUARIOS.'.grupo_acesso')->where('id','=',$id_grupo)->update(['descricao'=>$descricao]);
			foreach ($dados as $key => $value):
				db::table(BANCO_DE_DADOS_USUARIOS.'.config_grupo_acesso')->insert($value);
			endforeach;
			DB::commit();			
			REST::Response(true);			
		}
		catch(Exception $e)
		{
			REST::Response(false);		
			DB::rollBack();			
		}
	}

	public function postStoreGrupoAcesso()
	{
		try
		{
			if(!Access("POST","usuarios"))
				return REST::Response(false);

			$dados = Request::get('POST');
			$descricao = $dados['descricao'];
			unset($dados['descricao']);	
			DB::beginTransaction();			
			$id_grupo = db::table(BANCO_DE_DADOS_USUARIOS.'.grupo_acesso')->insertGetId(['descricao'=>$descricao]);
			$dados = $this->processadadosGrupoAcesso($dados,$id_grupo);	
			foreach ($dados as $key => $value):
				db::table(BANCO_DE_DADOS_USUARIOS.'.config_grupo_acesso')->insert($value);
			endforeach;
			DB::commit();			
			REST::Response(true);			
		}
		catch(Exception $e)
		{
			REST::Response(false);		
			DB::rollBack();				
		}
	}

	private function processadadosGrupoAcesso($dados,$id)
	{
		foreach ($dados as $key => $value):
			foreach ($value as $key2 => $value2):
				if(uppertrim($key2)!=uppertrim('MODULO')):
					if(uppertrim($value2) == uppertrim('ON'))
						$dados[$key][$key2]=uppertrim('S');
				endif;
				$dados[$key]['grupo_acesso_id']=$id;
			endforeach;
		endforeach;
		return $dados;
	}

	public function getShowGrupoAcesso($id=null)
	{
		if($id==null)
			return App::Erro(404);

		if(!Access("GET","grupos_acesso"))
			return App::Erro(505);

		$grupo_acesso = db::table(BANCO_DE_DADOS_USUARIOS.'.grupo_acesso')->where('excluido','=','N')->where('id','=',$id)->first();
		if(count($grupo_acesso)==0)
			return App::Erro(404);

		$modulos = db::table(BANCO_DE_DADOS_USUARIOS.'.modulos')->where("habilitado","=","S")->get();
		
		Controller::view('usuarios.grupos_acesso.edit',compact('grupo_acesso','modulos'));
	}





	public function qtde()
	{
		return  count($usuarios =  DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
						->where('empresa','=',Auth('serie_empresa'))
							->where('excluido','=',"N")
								->get());
	}	

	public function postAlterarEmail()
	{
		if(!Access("PUT","usuarios"))
			return App::erro(505);
		Controller::view('usuarios.auxiliares.alt_email_usuario');
	}

	public function postAlterarSenha()
	{
		if(!Access("PUT","usuarios"))
			return App::erro(505);
		Controller::view('usuarios.auxiliares.alt_senha_usuario');
	}

	public function postAlterarExcluir()
	{
		if(!Access("DELETE","usuarios"))
			return App::erro(505);
		Controller::view('usuarios.auxiliares.alt_excluir_usuario');
	}

	public function postRestvalidaemail()
	{		
		$request = Request::get('POST',['valida_token'=>false]);
		$email = $request['email'];
		$id = $request['id'];
		if(isset($request['senha']))
		{
			$consulta = $this->model
			->where('id','=',$id)
			->where('email','=',$email)
			->where('senha','=',md5($request['senha']))
			->where('excluido','=','N')->get();

		}
		else
			$consulta = $this->model->where('id','=',$id)->where('email','=',$email)->where('excluido','=','N')->get();
		if(count($consulta)>0)	
		  Rest::response(true); 
		else
		  Rest::response(false);
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
			Route::direcionar(asset("usuarios"));
			db::commit();
		}
		catch(Exception $e)
		{
			Route::direcionar(asset("usuarios/show/").$USUARIO['id']);
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
			$dados['empresa_selecionada']=separa_array_virgulas(Auth('empresa_selecionada'));
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
		Controller::view('usuarios.login.login',[]);
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
			Route::direcionar(asset(''));
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

	public function putAlteraEmail()
	{	
		try
		{
			$request = Request::get('PUT');
			$email = $request['email'];
			$id = $request['id'];
			DB::beginTransaction();
			$this->model->where('excluido','=','N')->where('id','=',$id)->update(['email'=>$email]);
			DB::commit();
			Rest::response(true);
		}
		catch(Exception $e)
		{
			Rest::response(false);		
			DB::rollback();	
		}
	}

	public function putAlterarSenha()
	{	
		try
		{
			$request = Request::get('PUT');
			$senha = md5($request['senha']);
			$id = $request['id'];
			DB::beginTransaction();
			$this->model->where('excluido','=','N')->where('id','=',$id)->update(['senha'=>$senha]);
			DB::commit();
			Rest::response(true);
		}
		catch(Exception $e)
		{
			Rest::response(false);		
			DB::rollback();	
		}
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

	public function putAlterarUsuario()
	{
		try
		{
			if(!Access("PUT","usuarios"))
				return REST::Response(false);

			$dados = Request::get('PUT')['dados'];
			DB::beginTransaction();
			$this->model->where('id','=',$dados['id'])->update($dados);
			// if($dados['info']['id']==Auth::get('id')):				
			// 	Auth::save(Auth::get('usuario'),Auth::get('lembrar'));
			// endif;
			DB::commit();
			REST::response(true);						
		}
		catch(Exception $e)
		{
			REST::response(false);		
			DB::rollBack();
		}	
	}



}