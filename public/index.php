<?php
session_start();
starter::preparar();
starter::carregar();
$app = new app();
$app->run();


class starter 
{
	public static function carregar()
	{
		foreach (json_decode(file_get_contents(__DIR__.'/../app/framework/_loader_.json')) as $config ):
			foreach ($config as $lib):
				require __DIR__.'/../'.$lib->dir;
			endforeach;
		endforeach;
	}
	public static function preparar()
	{
		$config = json_decode(file_get_contents(__DIR__.'/../config.json'));

		// diretorios
		foreach ($config->diretorios as $nome=>$dir):
			define($nome,__DIR__.'/../'.$dir);
		endforeach;
		define("__ROOT__", __DIR__.'/../');
		define("__PUBLIC__", __DIR__.'/');
		define("__ASSETS__", __PUBLIC__.'assets');
		define("__VENDOR__", __ROOT__.'vendor/');
		define("__APP__", __ROOT__.'app/');
		define("__CODE__", __ROOT__.'app/code/');
		define("__MODULES__", __CODE__.'modules/');
		define("__PREFIXO_BANCO__","db_admin_");

		// parametros
		foreach ($config->parametros as $nome=>$par):
			define($nome,$par);
		endforeach;

		define("APP_ID",md5(__APP_NOME__));
	}
}
date_default_timezone_set('America/Sao_Paulo');





