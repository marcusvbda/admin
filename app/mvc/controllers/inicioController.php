<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class inicioController extends controller
{
	public function getIndex()
	{
		return $this->view('index',[]);
	}	
}