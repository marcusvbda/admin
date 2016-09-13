<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class tanquesController extends controller
{

	protected $mensagens;

	public function getIndex()
	{
		$tanques=DB::table('tanque')
			->join('produtos','produtos.codigo','=','tanque.numero_produto')
				->select('tanque.capacidade','tanque.volumeatual','tanque.id','produtos.nomefantasia','tanque.sequencia')
					->wherein('tanque.empresa',Auth('empresa_selecionada'))->orderby('tanque.id')
						->get();
		echo $this->view('tanques.index', compact('tanques'));
	}
	
}



		