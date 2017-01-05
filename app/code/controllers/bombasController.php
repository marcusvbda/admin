<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class bombasController extends controller
{


	public function postprocurabicos()
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

	public function postProcuracombustivelporbico()
	{
		$bico = Request::get('POST',['valida_token'=>false])['bico'];	
		if($bico==0)
			$combustivel = query("select * from produtos where produtos.tipoproduto='C'");	
		else			
			$combustivel = query("select * from produtos where codigo = (select numero_produto from tanque where numero =(SELECT id_tanque FROM bomba where numero={$bico} group by bomba))");			
		echo json_encode($combustivel);
	}

	public function postProcurarbombacombustivel()
	{
		$comb = Request::get('POST',['valida_token'=>false])['combustivel'];	
		if($comb==0)
			$bombas = query("select * from bomba group by bomba");	
		else			
			$bombas = query("select * from bomba where id_tanque = (select id from tanque where numero_produto = (select codigo from produtos where codigo = {$comb})) group by bomba");			
		echo json_encode($bombas);
	}

	public function postProcurarbicocombustivel()
	{
		$comb = Request::get('POST',['valida_token'=>false])['combustivel'];	
		if($comb==0)
			$bombas = query("select * from bomba");	
		else			
			$bombas = query("select * from bomba where id_tanque = (select id from tanque where numero_produto = (select codigo from produtos where codigo = {$comb}))");			
		echo json_encode($bombas);
	}


}
