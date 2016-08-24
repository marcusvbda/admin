<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class inicioController extends controller
{

	protected $mensagens;
    public function __construct()
	{
        // AtualizarAuth();
		$this->mensagens = $this->model('mensagem');
	}

	public function getIndex()
	{
		echo $this->view('index');
	}
	
}
