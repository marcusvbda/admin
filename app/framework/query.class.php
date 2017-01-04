<?php

use Illuminate\Database\Capsule\Manager as Capsule;


define("BANCO_DE_DADOS_USUARIOS", __PREFIXO_BANCO__."usuarios");

if (Ja_Logado()) 
{
	define("BANCO_DE_DADOS", __PREFIXO_BANCO__.$_SESSION['dados_usuario']->serie_empresa);
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



$capsule = new Capsule;

$capsule->addConnection([
	'driver'=>'mysql',
	'database'=>DB_NOME,
	'host'=>DB_SERVER,
	'username'=>DB_USUARIO,
	'password'=>DB_SENHA,
	'charset'=>'utf8',
	'collation'=>'utf8_unicode_ci',
	'prefix'=>''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();