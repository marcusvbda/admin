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

		$filtro = strtoupper($filtro);
      	$tempo_inicio = microtime(true);		
		$produtos = DB::table('produtos')
						->whereRaw("excluido='N' and 
							(descricao like '%$filtro%' or 
							nomefantasia like '%$filtro%' or
							codigo like '%$filtro%')")
								->wherein('empresa',Auth('empresa_selecionada'))
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
								->wherein('empresa',Auth('empresa_selecionada'))
									->get();
		$campo_relatorio = array('Código'=>'codigo','Código Estendido'=>'codigoestendido','Nome'=>'nomefantasia','Descrição'=>'descricao');
		$html = prepararelatorio($campo_relatorio,$produtos,"Relatório Simples de Produtos");
		registralog("Imprimiu relatório simples de produtos");
        gerarpdf($html);

	}

	public function getShow($id)
	{
		if($id=="")
			redirecionar(asset('erros/404'));
		$produtos = DB::table('produtos')			
				->where('sequencia','=',$id)
					->where('excluido','=','N')
						->wherein('empresa',Auth('empresa_selecionada'))
							->get();
		if(count($produtos)==0)
			redirecionar(asset('erros/404'));
		$produto=$produtos[0];
		registralog("Visualizou o produto :".$id);	

		echo $this->view('produtos.show',compact('produto'));
	}


}