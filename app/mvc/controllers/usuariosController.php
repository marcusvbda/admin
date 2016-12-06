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

	public function getIndex()
	{
		$usuarios =  DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')
						->where('empresa','=',Auth('serie_empresa'))
							->where('excluido','=',"N")
								->get();
		Controller::view('usuarios.index',compact('usuarios'));
	}

	public function deleteExcluir()
	{
		$USUARIO = Request::get('DELETE');
		if($this->valida_exclusao($USUARIO['id']))
		{
			$usuario = $this->model->find($USUARIO['id']);
			$usuario->excluido="S";
			$usuario->save();
		}
		Route::direcionar(asset('usuarios'));
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
		$_POST = Request::get('POST');
		$empresas_selecionadas = '';
		$empresa = Auth('serie_empresa');

		if(Auth('admin_rede')=="S")
			$empresas_selecionadas =  $_POST['empresas_selecionadas'];
		else
			$empresas_selecionadas =  $empresa;


		$usuario = $_POST;
		$usuario['senha'] = md5($usuario['senha']);	
		$usuario['empresa'] = $empresa;
		$usuario['empresa_selecionada'] = $empresas_selecionadas;
		$this->model->create($usuario);
		Route::direcionar(asset('usuarios'));
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
		$usuarios = query(
			"select 
				u.id as id_usuario,
				u.usuario,
			    u.sexo as sexo_usuario,
			    u.empresa as serie_empresa_usuario,
			    u.empresa_selecionada as serie_empresa_selecionada_usuario,
			    u.admin,
			    u.admin_rede,
			    u.email,
			    u.empresa_selecionada,
			    e.razao as razao_empresa,
			    e.nome as nome_empresa,
			    e.inscricao_municipal as im_empresa,
			    e.inscricao_estadual as ie_empresa,
			    e.CNPJ_CPF as cnpj_empresa,
			    re.id as id_rede,
			    red.nome as nome_rede
			from 
				".BANCO_DE_DADOS_USUARIOS.".usuarios u 
			    join ".BANCO_DE_DADOS_USUARIOS.".empresas e on e.serie=u.empresa
			    join ".BANCO_DE_DADOS_USUARIOS.".redes_empresas re on re.serie_empresa=e.serie
			    join ".BANCO_DE_DADOS_USUARIOS.".redes red on red.id=re.rede
			  	where u.email='".$_POST['email']."' and u.senha='".md5($_POST['senha'])."'			    
			");

		

		if(count($usuarios)>0)	
		{			
			$array = ['id'=>$usuarios[0]->id_usuario, 'sexo'=>$usuarios[0]->sexo_usuario ,'admin_rede'=>$usuarios[0]->admin_rede,'rede'=>$usuarios[0]->id_rede,'admin'=>$usuarios[0]->admin,'usuario'=>$usuarios[0]->usuario,
					'email'=>$usuarios[0]->email,'manter_login'=>$_POST['manter_login'],'app_id'=>APP_ID,'serie_empresa'=>$usuarios[0]->serie_empresa_usuario,'empresa'=>$usuarios[0]->empresa,'razao_empresa'=>$usuarios[0]->razao_empresa,'nome_empresa'=>$usuarios[0]->nome_empresa,'im_empresa'=>$usuarios[0]->im_empresa,'ie_empresa'=>$usuarios[0]->ie_empresa,'cnpj_empresa'=>$usuarios[0]->cnpj_empresa,'nome_rede'=>$usuarios[0]->nome_rede];
	
			$array['empresa_selecionada'] = remove_repeticao_array(limpa_vazios_array(string_virgulas_array($usuarios[0]->empresa_selecionada)));
			SalvaUsuario($array);
			SetLogado('S');
			$parametros = query("select * From ".PREFIXO_BANCO.Auth('serie_empresa').".parametros");
			$array=array();						
			for ($i=0; $i < count($parametros); $i++):
				$array[$parametros[$i]->parametro] = $parametros[$i]->valor;				
			endfor;
			SalvaParametros($array);	
			SetLogado('S');
			Route::direcionar(asset('inicio'));
		}
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