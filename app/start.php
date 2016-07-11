<?php

require_once __DIR__."/comum/core/geral.php";
require_once __DIR__."/comum/core/configurador.php";
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/comum/core/app.php";
require_once __DIR__."/comum/core/controller.php";
require_once __DIR__."/comum/core/auth.php";
require_once __DIR__."/comum/middleware/middleware.php";
require_once __DIR__."/../vendor/dompdf/autoload.inc.php";
require_once __DIR__."/../vendor/phpmailer/phpmailer/PHPMailerAutoload.php";
require_once __DIR__."/".DIRETORIO_APP()."/banco_de_dados.php";
require_once __DIR__."/comum/core/database.php";

// criarusuarioteste();



function DIRETORIO_APP()
{
	if(isset($_GET['url']))
	{
		$url = explode('/' , filter_var(rtrim($_GET['url'], '/'),FILTER_SANITIZE_URL));
		return $url[0];
	}
	else
	{
		return "comum";
	}
}