<?php
use Illuminate\Database\Capsule\Manager as DB;


function CheckAuth()
{
	if(isset($_SESSION['dados_usuario']->usuario)) 
	{
		if(isset($_SESSION['dados_usuario']->app_id))
		{
			if((Auth('app_id')==APP_ID) && ChecarTimeOut(90))
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

function append_empresa($empresas )
{
	remove_empresas();
	$_SESSION['dados_usuario']->empresa = $empresas;
}


function remove_empresas()
{
	if(count(Auth('empresa'))>0)
		unset($_SESSION['dados_usuario']->empresa);
}

function SalvaUsuario($usuario)
{
	$usuario['ultima_atividade'] = time();
	$_SESSION['dados_usuario'] = (object) $usuario;
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

function AtualizaSession($id)
{
	$usuarios = DB::table('usuarios')
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

function SetLogado($logado = "S")
{
	$usuario = DB::table('usuarios')->where('id','=',Auth('id'))->update(array('logado'=>$logado));
}


function AtualizarAuth()
{
	$usuarios = DB::table('usuarios')->where('id','=',Auth('id'))->get();
	if(count($usuarios)>0)	
	{			
		$array = ['id'=>$usuarios[0]->id,'empresa'=>array($usuarios[0]->empresa), 'sexo'=>$usuarios[0]->sexo,
		'admin_rede'=>$usuarios[0]->admin_rede,'admin'=>$usuarios[0]->admin,'usuario'=>$usuarios[0]->usuario,
		'email'=>$usuarios[0]->email,'manter_login'=>Auth('manter_login'),'app_id'=>APP_ID];			
		SalvaUsuario($array);
	}

}