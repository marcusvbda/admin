<?php
use Illuminate\Database\Capsule\Manager as DB;


function CheckAuth()
{
	if(isset($_SESSION['dados_usuario']->usuario)) 
		return true;
	else
	{
		// LimpaUsuario();
		return false;
	}
}

function SalvaUsuario($usuario =  [])
{
	$_SESSION['dados_usuario'] = (object) $usuario;
}


function LimpaUsuario()
{
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