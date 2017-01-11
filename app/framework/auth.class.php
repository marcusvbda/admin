<?php
use Illuminate\Database\Capsule\Manager as DB;


function CheckAuth()
{	
	if(!isset($_SESSION['dados_usuario']->USUARIO)) 
		getUserFromCookie();

	if(isset($_SESSION['dados_usuario']->usuario)) 
	{
		if(isset($_SESSION['dados_usuario']->app_id))
		{
			if((Auth('app_id')==APP_ID) && ChecarTimeOut(Parametro('timeout_login')))
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

function getUserFromCookie()
{
	if(isset($_COOKIE[md5(__APP_NOME__.'sessao_salva')]))
	{
		$email = base64_decode($_COOKIE[md5(__APP_NOME__.'sessao_salva')]);		
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
			  	where u.email='".$email."'");
		if(count($usuarios)>0)
		{
			$array = ['id'=>$usuarios[0]->id_usuario, 'sexo'=>$usuarios[0]->sexo_usuario ,'admin_rede'=>$usuarios[0]->admin_rede,'rede'=>$usuarios[0]->id_rede,'admin'=>$usuarios[0]->admin,'usuario'=>$usuarios[0]->usuario,
					'email'=>$usuarios[0]->email,'manter_login'=>'S','app_id'=>APP_ID,'serie_empresa'=>$usuarios[0]->serie_empresa_usuario,'razao_empresa'=>$usuarios[0]->razao_empresa,'nome_empresa'=>$usuarios[0]->nome_empresa,'im_empresa'=>$usuarios[0]->im_empresa,'ie_empresa'=>$usuarios[0]->ie_empresa,'cnpj_empresa'=>$usuarios[0]->cnpj_empresa,'nome_rede'=>$usuarios[0]->nome_rede];
			$array['empresa_selecionada'] = remove_repeticao_array(limpa_vazios_array(string_virgulas_array(
					$usuarios[0]->empresa_selecionada)));
			SalvaUsuario($array,true);
			$parametros = query("select * From ".__PREFIXO_BANCO__.Auth('serie_empresa').".parametros");
			$array=array();						
			for ($i=0; $i < count($parametros); $i++):
				$array[$parametros[$i]->parametro] = $parametros[$i]->valor;				
			endfor;
			SalvaParametros($array);	
			SetLogado('S');
		}
	}			
}

// fechou navegador , loga de novo 
//logad0 = S no time out
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
	$_SESSION['dados_usuario']->empresa_selecionada = $empresas;
}


function remove_empresas()
{
	if(count(Auth('empresa_selecionada'))>0)
		unset($_SESSION['dados_usuario']->empresa);
}

function SalvaUsuario($usuario,$lembrar=false)
{
	$usuario['ultima_atividade'] = time();
	$_SESSION['dados_usuario'] = (object) $usuario;
	if($lembrar)
		setUserCookie($usuario['email']);
	else
		CleanUserCookie();
}

function SalvaParametros($parametro)
{
	$_SESSION['dados_usuario']->parametros = (object) $parametro;
}


function ChecarTimeOut($minutos = 15)
{
	if(Auth('manter_login')=="N")
	{
		if (Auth('ultima_atividade') + $minutos * 60 < time()) 
			return false;
		else 
		    return true;
	}
	else
	{
		return true;
	}
}

function AtualizaUltimaAtividade()
{
	$_SESSION['dados_usuario']->ultima_atividade = time();
}

function LimpaUsuario()
{
	SetLogado('N');
	unset($_SESSION['dados_usuario']);
	session_destroy();
	CleanUserCookie();
}

function Auth($variavel="id")
{
	if(isset($_SESSION['dados_usuario']))
	{
		if($_SESSION['dados_usuario']->{$variavel}=="")
			return null;
		else
			return $_SESSION['dados_usuario']->{$variavel};
	}
	else
		return null;
}

function Parametro($variavel="id")
{
	if(isset($_SESSION['dados_usuario']))
	{
		if($_SESSION['dados_usuario']->parametros->{$variavel}=="")
			return null;
		else
			return $_SESSION['dados_usuario']->parametros->{$variavel};
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
	setcookie(md5(__APP_NOME__.'sessao_salva'),base64_encode($email), time()+(3600*24*365),'/');
}

function CleanUserCookie()
{
	setcookie(md5(__APP_NOME__.'sessao_salva'),null,-1,'/');		
}
