<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class inicioController extends controller
{


	public function getIndex()
	{
		echo $this->view('inicio.index');
		// print_r($_SESSION['dados_usuario']);
	}


	
}


