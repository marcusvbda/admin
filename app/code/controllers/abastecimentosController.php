<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class abastecimentosController extends controller
{

	public function getIndex()
	{	
		$combustiveis = query("SELECT * FROM produtos WHERE produtos.tipoproduto='C'");
		$bombas = query("select bomba from bomba group by bomba");
		$bicos = query("select * from bomba");
		echo $this->view('abastecimentos.index',compact('combustiveis','bombas','bicos'));
	}

	public function postIndex()
	{	
		$abastecimentos = DB::select( DB::raw("select 
								a.*,
								DATE_FORMAT(a.dataabastecimento, '%d/%m/%Y') as data_formatada,
								p.descricao as combustivel
							from 
								abastecimentos a
								join bomba b on b.id = a.id_bomba
								join tanque t on t.id=b.id_tanque
								join produtos p on t.numero_produto=p.codigo
							where 
							1=1
							order by a.registro desc"))->paginate(10);
		echo $this->view('abastecimentos.index',compact('abastecimentos'));
	}

	public function postProcurabicos()
	{
		$bomba = Request::get('POST',['valida_token'=>false])['bomba'];	
		if($bomba==0)
			$bombas = query("select * from bomba");	
		else
			$bombas = query("select * from bomba where bomba={$bomba}");			
		echo json_encode($bombas);
	}

	public function postProcurabomba()
	{
		$bico = Request::get('POST',['valida_token'=>false])['bico'];	
		if($bico==0)
			$bombas = query("select * from bomba group by bomba");	
		else
			$bombas = query("select * from bomba where numero={$bico} group by bomba");			
		echo json_encode($bombas);
	}

	public function postProcuracombustivel()
	{
		$bomba = Request::get('POST',['valida_token'=>false])['bomba'];	
		if($bomba==0)
			$combustivel = query("select * from produtos where produtos.tipoproduto='C'");	
		else			
			$combustivel = query("select * from produtos where codigo = (select numero_produto from tanque where numero =(SELECT id_tanque FROM bomba where bomba={$bomba} group by bomba))");			
		echo json_encode($combustivel);
	}


}
