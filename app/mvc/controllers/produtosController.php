<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class produtosController extends controller
{

	public function __construct()
	{
		// $this->model = $this->model('produtos');
	}

	public function getIndex()
	{
		echo $this->view('produtos.index',[]);
	}	


}