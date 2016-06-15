<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class logController extends controller
{
	
	public function __construct()
	{
		$this->model = $this->model('log');
	}

	public function getSelectlog($usuario)
	{
	    $log = $this->model
        	->where('usuario','=',$usuario)
		        ->orderBy('created_at','desc')
		        	->take(10)
		        		->get();
		echo json_encode($log);
	}

}