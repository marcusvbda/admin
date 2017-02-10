<?php
use Illuminate\Database\Capsule\Manager as DB;


function CheckAuth()
{	
	if(!isset($_SESSION[md5(__APP_NOME__)]->usuario)) 
		getUserFromCookie();

	if(isset($_SESSION[md5(__APP_NOME__)]->usuario)) 
	{
		if(isset($_SESSION[md5(__APP_NOME__)]->app_id))
		{
			if(Auth('app_id')==md5(__APP_NOME__))
				return true;
			else
			{
				LimpaUsuario();
				return false;
			}
		}
		else
		{
			LimpaUsuario();
			return false;
		}		
	}
	else
	{

		LimpaUsuario();
		return false;
	}
}

function attempt($dados = [])
{
		if(isset($dados['senha']))
			$usuarios = query(
				"select 
					u.id as id_usuario,
					u.usuario,
				    u.sexo as sexo_usuario,
				    u.empresa as serie_empresa_usuario,
				    u.empresa_selecionada as serie_empresa_selecionada_usuario,
				    u.email,
				    u.empresa_selecionada,
				    e.razao as razao_empresa,
				    e.nome as nome_empresa,
				    e.inscricao_municipal as im_empresa,
				    e.inscricao_estadual as ie_empresa,
				    e.CNPJ_CPF as cnpj_empresa,
				    re.id as id_rede,
				    red.nome as nome_rede,
				    u.grupo_acesso_id 
				from 
					".BANCO_DE_DADOS_USUARIOS.".usuarios u 
				    join ".BANCO_DE_DADOS_USUARIOS.".empresas e on e.serie=u.empresa
				    join ".BANCO_DE_DADOS_USUARIOS.".redes_empresas re on re.serie_empresa=e.serie
				    join ".BANCO_DE_DADOS_USUARIOS.".redes red on red.id=re.rede
				  	where u.email='".$dados['email']."' and u.senha='".md5($dados['senha'])."'
				  	and excluido='N'		    
				");
		else
			$usuarios = query(
				"select 
					u.id as id_usuario,
					u.usuario,
				    u.sexo as sexo_usuario,
				    u.empresa as serie_empresa_usuario,
				    u.empresa_selecionada as serie_empresa_selecionada_usuario,
				    u.email,
				    u.empresa_selecionada,
				    e.razao as razao_empresa,
				    e.nome as nome_empresa,
				    e.inscricao_municipal as im_empresa,
				    e.inscricao_estadual as ie_empresa,
				    e.CNPJ_CPF as cnpj_empresa,
				    re.id as id_rede,
				    red.nome as nome_rede,
				    u.grupo_acesso_id 
				from 
					".BANCO_DE_DADOS_USUARIOS.".usuarios u 
				    join ".BANCO_DE_DADOS_USUARIOS.".empresas e on e.serie=u.empresa
				    join ".BANCO_DE_DADOS_USUARIOS.".redes_empresas re on re.serie_empresa=e.serie
				    join ".BANCO_DE_DADOS_USUARIOS.".redes red on red.id=re.rede
				  	where u.email='".$dados['email']."' and excluido='N'");

		if(count($usuarios)>0)	
		{
			$array = ['id'=>$usuarios[0]->id_usuario, 'sexo'=>$usuarios[0]->sexo_usuario ,'rede'=>$usuarios[0]->id_rede,'usuario'=>$usuarios[0]->usuario,'email'=>$usuarios[0]->email,'manter_login'=>$_POST['manter_login'],'app_id'=>md5(__APP_NOME__),'serie_empresa'=>$usuarios[0]->serie_empresa_usuario,'razao_empresa'=>$usuarios[0]->razao_empresa,'nome_empresa'=>$usuarios[0]->nome_empresa,'im_empresa'=>$usuarios[0]->im_empresa,'ie_empresa'=>$usuarios[0]->ie_empresa,'cnpj_empresa'=>$usuarios[0]->cnpj_empresa,'nome_rede'=>$usuarios[0]->nome_rede,'grupo_acesso_id'=>$usuarios[0]->grupo_acesso_id];
				$array['empresa_selecionada'] = remove_repeticao_array(limpa_vazios_array(string_virgulas_array($usuarios[0]->empresa_selecionada)));
				SalvaUsuario($array,$dados['manter']);
				$parametros = query("select * From ".__PREFIXO_BANCO__.Auth('serie_empresa').".parametros");
				$array=array();						
				for ($i=0; $i < count($parametros); $i++):
					$array[$parametros[$i]->parametro] = $parametros[$i]->valor;				
				endfor;
				SalvaParametros($array);	
				SetLogado('S');
				return true;
		}
		else
			return false;
}

function getUserFromCookie()
{
	if(isset($_COOKIE[md5(__APP_NOME__)]))
	{
		$email = base64_decode($_COOKIE[md5(__APP_NOME__)]);		
		attempt(['email'=>$email,'manter'=>true]);
		conectar(__PREFIXO_BANCO__.Auth('serie_empresa'));
	}			
}

function arrayUnique($myArray){
    if(!is_array($myArray))
        return $myArray;

    foreach ($myArray as &$myvalue){
        $myvalue=serialize($myvalue);
    }

    $myArray=array_unique($myArray);

    foreach ($myArray as &$myvalue){
        $myvalue=unserialize($myvalue);
    }

    return $myArray;

} 

function append_empresa($empresas)
{
	remove_empresas();	
	$_SESSION[md5(__APP_NOME__)]->empresa_selecionada = $empresas;
}


function remove_empresas()
{
	if(count(Auth('empresa_selecionada'))>0)
		unset($_SESSION[md5(__APP_NOME__)]->empresa);
}

function SalvaUsuario($usuario,$lembrar=false)
{
	$_SESSION[md5(__APP_NOME__)] = (object) $usuario;
	if($lembrar)
		setUserCookie($usuario['email']);
	else
		CleanUserCookie();
}

function SalvaParametros($parametro)
{
	$_SESSION[md5(__APP_NOME__)]->parametros = (object) $parametro;
}

function AtualizaUltimaAtividade()
{
	$_SESSION[md5(__APP_NOME__)]->ultima_atividade = time();
}

function LimpaUsuario($set=true)
{
	unset($_SESSION[md5(__APP_NOME__)]);
	if($set)	
		SetLogado('N');
	CleanUserCookie();
}

function Auth($variavel="id")
{
	if(isset($_SESSION[md5(__APP_NOME__)]))
	{
		if($_SESSION[md5(__APP_NOME__)]->{$variavel}=="")
			return null;
		else
			return $_SESSION[md5(__APP_NOME__)]->{$variavel};
	}
	else
		return null;
}

function Parametro($variavel="id")
{
	if(isset($_SESSION[md5(__APP_NOME__)]))
	{
		if($_SESSION[md5(__APP_NOME__)]->parametros->{$variavel}=="")
			return null;
		else
			return $_SESSION[md5(__APP_NOME__)]->parametros->{$variavel};
	}
	else
		return null;
}


function SetLogado($logado = "S")
{
    $usuario = DB::table(BANCO_DE_DADOS_USUARIOS.'.usuarios')->where('id','=',Auth('id'))->update(array('logado'=>$logado));
}


function setUserCookie($email)
{
	setcookie(md5(__APP_NOME__),base64_encode($email), time()+(3600*24*365),'/');
}

function CleanUserCookie()
{
	setcookie(md5(__APP_NOME__),null,-1,'/');		
}

function Access($op,$module)
{
	$consulta = db::table(BANCO_DE_DADOS_USUARIOS.'.config_grupo_acesso as conf')
		->select($op)
			->join(BANCO_DE_DADOS_USUARIOS.'.modulos as mod','mod.id','=','conf.modulo_id')
			->where('conf.grupo_acesso_id','=',Auth('grupo_acesso_id'))
			->where('mod.modulo','=',$module)
			->first();

	if(count($consulta)>0)
	{
		
		$resposta = uppertrim($consulta->{$op});
		
		if(count($resposta)<=0)
			return false;
		if($resposta==uppertrim("S"))
			return true;
		else
			return false;
	}
	else
		return false;
}