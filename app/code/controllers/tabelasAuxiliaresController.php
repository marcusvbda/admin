<?php
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;
class tabelasAuxiliaresController extends controller
{



	public function getTabela($tabela)
	{
		return db::table($tabela)->get();
	}

	

}