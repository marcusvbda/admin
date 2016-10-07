<?php
define("BANCO_DE_DADOS", "db_admin_".$_SESSION['dados_usuario']->serie_empresa);
define("BANCO_DE_DADOS_USUARIOS", "db_admin_usuarios");

if (Ja_Logado()) 
{
	define("DB_SERVER",  "localhost:3306");
    define("DB_NOME",    BANCO_DE_DADOS);
    define("DB_USUARIO", "root");
    define("DB_SENHA",   "");
}
else
{
	define("DB_SERVER",  "localhost:3306");
    define("DB_NOME",    BANCO_DE_DADOS_USUARIOS);
    define("DB_USUARIO", "root");
    define("DB_SENHA",   "");
}

function Ja_Logado()
{
	if((isset($_SESSION['dados_usuario']->usuario)) && (isset($_SESSION['dados_usuario']->app_id)) && (Auth('app_id')==APP_ID))
		return true;
	else
		return false;
}
