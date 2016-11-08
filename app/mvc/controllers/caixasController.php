<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class caixasController extends controller
{

	public function getIndex()
	{
		$ultimo_caixa = $this->getUltimoCaixa();
		$data_fim = string_to_date($ultimo_caixa->dataabertura);
		$data_inicio = string_to_date($ultimo_caixa->dataabertura,"-10");
		$caixas = query("select *,
		  DATE_FORMAT(dataabertura, '%d/%m/%Y') as dataabertura_formatada,
		  DATE_FORMAT(datafechamento, '%d/%m/%Y') as datafechamento_formatada
		   FROM caixa WHERE dataabertura >= date('".$data_inicio."') and
		dataabertura <= date('".$data_fim."') order by numero desc");
		echo $this->view('caixas.index',compact('caixas','data_inicio','data_fim'));	
	}

	public function postIndex()
	{
		$ultimo_caixa = $this->getUltimoCaixa();
		if(!$_POST['data_fim'])
			$data_fim = string_to_date($ultimo_caixa->dataabertura);
		else
			$data_fim = $_POST['data_fim'];

		if(!$_POST['data_inicio'])
			$data_inicio = string_to_date($ultimo_caixa->dataabertura,"-10");
		else
			$data_inicio = $_POST['data_inicio'];

		 $caixas = query("select *,
		  DATE_FORMAT(dataabertura, '%d/%m/%Y') as dataabertura_formatada,
		  DATE_FORMAT(datafechamento, '%d/%m/%Y') as datafechamento_formatada
		   FROM caixa WHERE dataabertura >= date('".$data_inicio."') and
		dataabertura <= date('".$data_fim."') order by numero desc");
		 echo $this->view('caixas.index',compact('caixas','data_inicio','data_fim'));	
	}


	public function getCaixa_especifico($id)
	{
		$caixa = query("select *,
		  DATE_FORMAT(dataabertura, '%d/%m/%Y') as dataabertura_formatada,
		  DATE_FORMAT(datafechamento, '%d/%m/%Y') as datafechamento_formatada 
		  from caixa where sequencia=".$id);
		$caixa = $caixa[0];
		echo json_encode($caixa);
	}

	private function getUltimoCaixa()
	{
		$ultimo_caixa = query("select * from caixa where id=(select max(id) as id from caixa)");
		return $ultimo_caixa=$ultimo_caixa[0];
	}

	public function getShow($numero)
	{				
		$caixa = query("select *,
		  DATE_FORMAT(dataabertura, '%d/%m/%Y') as dataabertura_formatada,
		  DATE_FORMAT(datafechamento, '%d/%m/%Y') as datafechamento_formatada
		  from caixa where numero={$numero}",false);
		if(is_null($caixa))
			redirecionar(asset('erros/404'));

		$manutencoes = query("Select DATE_FORMAT(m.datalancamento, '%d/%m/%Y') as data_formatada,  m.* from manutencaocaixa m where m.id_caixa={$caixa->id}");
		$manutencoes_agrupadas = query("select sum(m.valor) as valor,m.tipo from manutencaocaixa m where m.id_caixa={$caixa->id} group by m.tipo");
		$vlr_manutencoes = array('R'=>0,'I'=>0);
		 foreach ($manutencoes_agrupadas as $ma):
		    $vlr_manutencoes[$ma->tipo]+=$ma->valor;
		endforeach;


		$vlr_total = query(
			"Select
				 SUM(D.VALORNEGOCIACAO) AS vlr_total
				FROM
				 CAIXA C,
				 PRODUTOS P,
				 DADOSFATURAMENTO D,
				 GRUPOSPRODUTOS G
				WHERE
				 C.NUMERO={$numero}
				AND
				 D.ID_CAIXA = C.ID
				AND
				 D.NUMERO_EMPRESACLIENTE=C.NUMERO_EMPRESA
				AND
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
				 P.CODIGO_GRUPOPRODUTO = G.CODIGO
				GROUP BY
				 C.NUMERO
			",'vlr_total');

		    $porcentagem_grupo  = query(
			"Select
                 G.DESCRICAO as grupo,
                 SUM((D.VALORNEGOCIACAO)*100)/{$vlr_total} AS porcentagem,
				 SUM(D.QUANTIDADE) AS QUANTIDADE,
                 SUM(D.VALORNEGOCIACAO) AS VALORNEGOCIACAO,
                 P.TIPOPRODUTO
                FROM
                 CAIXA C,
                 PRODUTOS P,
                 DADOSFATURAMENTO D,
                 GRUPOSPRODUTOS G
                WHERE
                 C.NUMERO={$numero}
                AND
                 D.ID_CAIXA = C.ID
                AND
                 D.NUMERO_EMPRESACLIENTE=C.NUMERO_EMPRESA
                AND
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
                 P.CODIGO_GRUPOPRODUTO = G.CODIGO
                GROUP BY
                 G.DESCRICAO,
                 P.TIPOPRODUTO");

		     $agrupado = query(
		    	"Select
				     C.NUMERO AS NUMERO_CAIXA,
				     P.CODIGO_GRUPOPRODUTO AS NUMERO_GRUPOPRODUTO,
				     P.TIPOPRODUTO,
				     G.DESCRICAO,
				     D.NUMERO_PRODUTO,
				     D.DESCRICAO_PRODUTO,
				     SUM(D.QUANTIDADE) AS QUANTIDADE,
				     SUM(D.VALORNEGOCIACAO) AS VALORNEGOCIACAO
				    FROM
				     CAIXA C,
				     PRODUTOS P,
				     DADOSFATURAMENTO D,
				     GRUPOSPRODUTOS G
				    WHERE
				     C.NUMERO={$numero}
				    AND
				     D.ID_CAIXA = C.ID
				    AND
				     D.NUMERO_EMPRESACLIENTE=C.NUMERO_EMPRESA
				    AND
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
				     P.CODIGO_GRUPOPRODUTO = G.CODIGO
				    GROUP BY
				     P.CODIGO_GRUPOPRODUTO,
				     P.TIPOPRODUTO,
				     G.DESCRICAO,
				     D.NUMERO_PRODUTO,
				     D.DESCRICAO_PRODUTO,
				     C.NUMERO
				    ORDER BY
				      P.TIPOPRODUTO,
				      P.CODIGO_GRUPOPRODUTO
				      ");



		    $tem_combustiveis = false;
		    foreach ($porcentagem_grupo as $ag):
		    	if($ag->TIPOPRODUTO=="C")
		    	{
		    		$tem_combustiveis=true;
		    		break;
		    	}
		    endforeach;

		    $total_prazo = query("select sum(d.valornegociacao) as total from dadosfaturamento d
					where d.id_caixa={$caixa->id} and d.recebido='N' and d.excluido='N'","total");

		    $cupons = query("
					   select
			                d.*,
							DATE_FORMAT(d.datalancamento, '%d/%m/%Y') as data_formatada
			            from  
			            	dadosfaturamento d 
			            where 
			            	d.id_caixa={$caixa->id} and d.excluido in('N','P','C')
			            group by 
			                d.numeronota
			            order by
			                d.numeronota
						");
		   

		    if($tem_combustiveis):
		    	$vlr_total_combustiveis = 0;
		    	foreach ($agrupado as $ag):
		    	if($ag->TIPOPRODUTO=="C")
		    	{
		    		$vlr_total_combustiveis+=$ag->VALORNEGOCIACAO;
		    	}
		   		endforeach;
			    $ag_combustiveis = query(
			    	"Select
	                     G.DESCRICAO,
	                     D.NUMERO_PRODUTO,
	                     D.DESCRICAO_PRODUTO,
	                     SUM(D.QUANTIDADE) AS QUANTIDADE,
	                     SUM(D.VALORNEGOCIACAO) AS VALORNEGOCIACAO,
	                     SUM((D.VALORNEGOCIACAO)*100)/{$vlr_total_combustiveis} AS porcentagem
	                    FROM
	                     CAIXA C,
	                     PRODUTOS P,
	                     DADOSFATURAMENTO D,
	                     GRUPOSPRODUTOS G
	                    WHERE
	                     C.NUMERO={$numero} and P.tipoproduto='C'
	                    AND
	                     D.ID_CAIXA = C.ID
	                    AND
	                     D.NUMERO_EMPRESACLIENTE=C.NUMERO_EMPRESA
	                    AND
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
	                     P.CODIGO_GRUPOPRODUTO = G.CODIGO
	                    GROUP BY
	                     G.DESCRICAO,
	                     D.NUMERO_PRODUTO,
	                     D.DESCRICAO_PRODUTO,
	                     C.NUMERO
					      ");
			endif;


		$dias_permanencia = dif_datas($caixa->dataabertura,$caixa->datafechamento);
		$horas_permanencia = dif_horas($caixa->horafechamento,$caixa->horaabertura);


		echo $this->view('caixas.show',compact('caixa','dias_permanencia','horas_permanencia','porcentagem_grupo','agrupado','vlr_total','combustiveis','tem_combustiveis','ag_combustiveis','vlr_manutencoes','manutencoes_agrupadas','manutencoes','cancelamentos','total_prazo','cupons','abastecimentos'));		
	}

	public function postDocumento()
	{
		$documento = $_POST['documento'];
		$resposta['cupom'] = query("
				select 
					d.*,cond.descricao as nome_condpgto,
					DATE_FORMAT(d.datanegociacao, '%d/%m/%Y') as datanegociacao_formatada,
					DATE_FORMAT(d.emissao, '%d/%m/%Y') as dataemissao_formatada,
					DATE_FORMAT(d.vencimento, '%d/%m/%Y') as datavencimento_formatada,
					f.nome as funcionario,
					p.descricao as nome_produto,
					a.id_bomba,a.totallitros,a.totaldinheiro,a.precounitario
				from 
					dadosfaturamento d
				left join 
					condicaopagamento cond on cond.codigo=d.numero_condpgto
				left join
					funcionarios f on d.numero_funcionario=f.numero
				left join 
					produtos p on p.codigo=d.numero_produto
				left join 
					abastecimentos a on a.id=d.id_abastecimento
				where numeronota={$documento}");
		echo json_encode($resposta);
	}
}

