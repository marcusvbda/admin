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

	public function postJsonPorcentagemGrupo()
	{
		try
		{
			function gerarDados()
			{
				$importacao_id = db::table('importacoes')->orderby('id','desc')->first()->id;
				$vlr_total = query("
				Select
					 SUM(D.VALORNEGOCIACAO) AS vlr_total
					FROM
					 PRODUTOS P,
					 DADOSFATURAMENTO D,
					 GRUPOSPRODUTOS G
					WHERE
					 D.SITUACAO<>'I'
					AND
					 D.EXCLUIDO <>'S'
					AND
					 D.EXCLUIDO <>'C'
					AND
					 D.TIPONOTA<>8
					AND
					 D.NUMERO_PRODUTO = P.CODIGO
					AND
					 P.CODIGO_GRUPOPRODUTO = G.CODIGO","vlr_total");
				$porcentagem_grupo  = query(
				"Select
	                 G.DESCRICAO as grupo,
	                 SUM((D.VALORNEGOCIACAO)*100)/{$vlr_total} AS porcentagem
	                FROM
	                 PRODUTOS P,
	                 DADOSFATURAMENTO D,
	                 GRUPOSPRODUTOS G
	                WHERE      
	                 D.SITUACAO NOT IN('I','S','C')
	                AND
	                 D.TIPONOTA<>8
	                AND
	                 D.NUMERO_PRODUTO = P.CODIGO
	                AND
	                 P.CODIGO_GRUPOPRODUTO = G.CODIGO
	                GROUP BY
	                 G.DESCRICAO");

				db::table('porcentagem_grupo')->truncate();
				foreach ($porcentagem_grupo as $pg) :
					db::table('porcentagem_grupo')->insert(['grupo'=>$pg->grupo,'porcentagem'=>$pg->porcentagem,'importacao_id'=>$importacao_id]);
				endforeach;
				return db::table('porcentagem_grupo')->get();
			}

			$importacao_id = db::table('importacoes')->orderby('id','desc')->first()->id;
			$porcentagem_grupo = db::table('porcentagem_grupo')->where('importacao_id','=',$importacao_id)->get();

			if(count($porcentagem_grupo)<=0)
				$porcentagem_grupo = gerarDados();

			if($porcentagem_grupo[0]->importacao_id!=$importacao_id)
				$porcentagem_grupo = gerarDados();

			if(count($porcentagem_grupo)>0)
			{
				if($porcentagem_grupo[0]->importacao_id===$importacao_id)
				{
					$porcentagem_grupo = db::table('porcentagem_grupo')->where('importacao_id','=',$importacao_id)->get();
					echo json_encode($porcentagem_grupo);
				}
			}
		}
		catch(Exception $e)
		{
			return null;
		}
	}

	public function getIndex()
	{	
		$produtos = DB::table('produtos')
						->where("excluido",'=', 'N')
							->get();
		echo $this->view('produtos.index',compact('produtos'));
	}

	
	public function getShow($id="")
	{
		if($id=="")
			App::erro(404);
		$produto = DB::table('produtos')			
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
												->first();
		if(count($produto)==0)
			App::erro(404);
		registralog("Visualizou o produto :".$id);	

		echo $this->view('produtos.show',compact('produto'));
	}

	public function getTipos()
	{
		$tipos = 
		DB::table('tiposprodutos')
				->where('excluido','=','N')
					->get();
		echo $this->view('produtos.tipos.index',compact('tipos'));
	}

	public function getGrupos()
	{

		$grupos = DB::table('gruposprodutos')
				->where('excluido','=','N')
					->get();
    
		echo $this->view('produtos.grupos.index',compact('grupos'));

	}
}