<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class inicioController extends controller
{
	public function getIndex()
	{
		$qtde_usuarios_cadastrados=count(DB::table('usuarios')->where('empresa','=',Auth('empresa'))->where('excluido','=','N')->get());
		echo $this->view('index',compact('qtde_usuarios_cadastrados'));
	}	


}