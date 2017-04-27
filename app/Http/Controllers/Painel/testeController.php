<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use App\Abastecimentos;
use JasperPHP\JasperPHP;


class testeController extends Controller
{ 
  	public function getIndex()
    {
    	return relatorio('_modelo_abastecimento',[]);
	}

}


