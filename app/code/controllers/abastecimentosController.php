<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class abastecimentosController extends controller
{

	public function getIndex()
	{	
        $de =  query("select max(dataabastecimento) as data from abastecimentos","data");
		$ate = $de;

		$combustiveis = query("SELECT * FROM produtos WHERE produtos.tipoproduto='C'");
		$bombas = query("select bomba from bomba group by bomba");
		$bicos = query("select * from bomba");
		$bomba = 0;
		$bico= 0;
		$combustivel = 0 ;
		$abastecimentos = query("select 
								a.*,
								DATE_FORMAT(a.dataabastecimento, '%d/%m/%Y') as data_formatada,
								p.descricao as combustivel
							from 
								abastecimentos a
								left join bomba b on b.id = a.id_bomba
								left join tanque t on t.id=b.id_tanque
								left join produtos p on t.numero_produto=p.codigo
							where 
                            a.dataabastecimento BETWEEN '{$de}' and '{$ate}'
                            
							order by a.registro desc");
		echo $this->view('abastecimentos.index',compact('combustiveis','combustivel','bombas','bicos','abastecimentos','de','ate','bico','bomba'));
	}

	public function postIndex()
	{	
		$_POST = Request::get('POST');
		$combustiveis = query("SELECT * FROM produtos WHERE produtos.tipoproduto='C'");
		$bombas = query("select bomba from bomba group by bomba");
		$bicos = query("select * from bomba");
		$bomba = $_POST['bomba'];
		$bico = $_POST['bico'];
		echo $combustivel = $_POST['combustivel'];
		if($combustivel>0)
		{
			$combustivel_nome = query("SELECT * FROM produtos WHERE produtos.codigo='{$combustivel}'");
			$combustivel_nome = $combustivel_nome[0]->descricao;
		}
		else
			$combustivel_nome = 'Todos';
	    print_r($combustivel_nome);

		$de = $_POST['de'];
		$ate = $_POST['ate'];

		 $sql = "select 
										a.*,
										DATE_FORMAT(a.dataabastecimento, '%d/%m/%Y') as data_formatada,
										p.descricao as combustivel
									from 
										abastecimentos a
										join bomba b on b.id = a.id_bomba
										join tanque t on t.id=b.id_tanque
										join produtos p on t.numero_produto=p.codigo
									where 
									a.dataabastecimento BETWEEN '{$de}' and '{$ate}' ";
		if($bico != 0)
			$sql.="and b.numero = {$bico} and ";
		if($bomba != 0)
			$sql.="b.bomba = {$bomba} and ";
		if($combustivel != 0)
			$sql.="t.numero_produto = {$combustivel} ";
		                            
		$sql .="order by a.registro desc";


		$abastecimentos = query($sql);
		echo $this->view('abastecimentos.index',compact('combustiveis','bombas','bicos','abastecimentos','de','ate','bico','bomba','combustivel','combustivel_nome'));
	}

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
