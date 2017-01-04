<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class errosController extends controller
{
	
	protected $relatorio_customizado;
	


	public function getSEM_PERMISSAO()
	{
		echo $this->view('erros.bloqueado');
	}

	public function getNAO_EXISTE()
	{
		echo $this->view('erros.nao_existe');
	}
	
	
}

