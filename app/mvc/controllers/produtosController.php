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
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";
		if(isset($_GET['pagina']))
			$pagina = $_GET['pagina'];
		else
			$pagina = "1";

      	$tempo_inicio = microtime(true);		
		$produtos = DB::table('produtos')
						->whereRaw("excluido='N' and 
							(descricao like '%$filtro%' or 
							nomefantasia like '%$filtro%' or
							codigo like '%$filtro%')")
									->paginate(10, ['*'], "pagina", $pagina);
      	$tempo_consulta = microtime(true) - $tempo_inicio;
      	$qtde_registros = $produtos->total();      	
		$produtos->appends(['filtro'=>$filtro])->render();
		echo $this->view('produtos.index',compact('produtos','filtro','tempo_consulta','qtde_registros'));
	}

	public function postRelatorio_simples()
	{     	
		if(isset($_POST['filtro']))
			$filtro = strtoupper($_POST['filtro']);
		else
			$filtro = "";

		$produtos = DB::table('produtos')
						->where('excluido','=','N')
						->whereRaw("(descricao like '%$filtro%' or 
							nomefantasia like '%$filtro%' or
							codigo like '%$filtro%')")
									->get();
		$campo_relatorio = array('Código'=>'codigo','Código Estendido'=>'codigoestendido','Nome'=>'nomefantasia','Descrição'=>'descricao');
		$html = prepararelatorio($campo_relatorio,$produtos,"Relatório Simples de Produtos");
		registralog("Imprimiu relatório simples de produtos");
        imprimir($html);
	}

	public function postRelatorio_simples_tipos()
	{     	
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";

		$tipos = 
		DB::table('tiposprodutos')
				->where('excluido','=','N')
					->whereRaw("descricao like '%$filtro%'")
						->get();

		$campo_relatorio = array('Número'=>'numero','Descrição'=>'descricao','Entradas'=>'entradas','Saidas'=>'saidas');
		$html = prepararelatorio($campo_relatorio,$tipos,"Relatório Simples de Tipos de Produto");
		registralog("Imprimiu relatório simples de Tipos de produtos");
        imprimir($html);
	}


	public function postRelatorio_simples_grupos()
	{     	
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";

		$tipos = 
		$grupos = 
		DB::table('gruposprodutos')
				->where('excluido','=','N')
					->whereRaw("descricao like '%$filtro%'")
						->get();

		$campo_relatorio = array('Código'=>'codigo','Descrição'=>'descricao','Codigo ST'=>'codigo_st','Aliquota IPI'=>'aliquota_ipi','Aliquota ISS'=>"aliquota_iss","Calcula PIS"=>"calcula_pis","Calcula Cofins"=>"calcula_cofins");
		$html = prepararelatorio($campo_relatorio,$tipos,"Relatório Simples de Tipos de Produto");
		registralog("Imprimiu relatório simples de Tipos de produtos");
        imprimir($html);
	}

	public function getShow($id)
	{
		if($id=="")
			redirecionar(asset('erros/404'));
		$produtos = DB::table('produtos')			
		->where('produtos.sequencia','=',$id)
			->where('produtos.excluido','=','N')
				->where('tiposprodutos.excluido','=','N')
					->where('gruposprodutos.excluido','=','N')
						->join('tiposprodutos','tiposprodutos.numero','=','produtos.codigo_tipoproduto')
							->join('gruposprodutos','gruposprodutos.codigo','=','produtos.codigo_grupoproduto')
								->join('produto_empresa','produto_empresa.codigo_produto','=','produtos.codigo')
									->join('situacoestributarias','situacoestributarias.codigo','=','produtos.codigo_st')
										->join('situacoestributarias as sit_entrada','sit_entrada.codigo','=','produtos.codigo_stentrada')
											->select('produtos.*','tiposprodutos.descricao as desc_tipoproduto','gruposprodutos.descricao as desc_grupoproduto','produto_empresa.*','situacoestributarias.descricao as desc_cstsaida','sit_entrada.descricao as desc_cst_entrada')
												->get();
		if(count($produtos)==0)
			redirecionar(asset('erros/404'));
		$produto=$produtos[0];
		registralog("Visualizou o produto :".$id);	

		echo $this->view('produtos.show',compact('produto'));
	}

	public function getTipos()
	{
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";
		if(isset($_GET['pagina']))
			$pagina = $_GET['pagina'];
		else
			$pagina = "1";

      	$tempo_inicio = microtime(true);	

		$tipos = 
		DB::table('tiposprodutos')
				->where('excluido','=','N')
					->whereRaw("descricao like '%$filtro%'")
						->paginate(10, ['*'], "pagina", $pagina);
      	$tempo_consulta = microtime(true) - $tempo_inicio;
      	$qtde_registros = $tipos->total();      	
		$tipos->appends(['filtro'=>$filtro])->render();
		echo $this->view('produtos.tipos',compact('tipos','filtro','tempo_consulta','qtde_registros'));
	}

	public function getGrupos()
	{
		if(isset($_GET['filtro']))
			$filtro = strtoupper($_GET['filtro']);
		else
			$filtro = "";
		if(isset($_GET['pagina']))
			$pagina = $_GET['pagina'];
		else
			$pagina = "1";

      	$tempo_inicio = microtime(true);	

		$grupos = 
		DB::table('gruposprodutos')
				->where('excluido','=','N')
					->whereRaw("descricao like '%$filtro%'")
						->paginate(10, ['*'], "pagina", $pagina);
      	$tempo_consulta = microtime(true) - $tempo_inicio;
      	$qtde_registros = $grupos->total();      	
		$grupos->appends(['filtro'=>$filtro])->render();
		echo $this->view('produtos.grupos',compact('grupos','filtro','tempo_consulta','qtde_registros'));

	}
}