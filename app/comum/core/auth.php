<?php
function CheckAuth()
{
	if(isset($_SESSION['dados_usuario']))
		return true;
	else
		return false;
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