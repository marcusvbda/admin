<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class relatoriosController extends controller
{

	protected $conteudo;

	public function __construct()
	{
		$this->conteudo = "";
	}

	public function getIndex()
	{
		redirecionar(asset('erros/404'));
	}

	public function getTributacoes_codigos()
	{
		echo $this->view('relatorios.tributacoes_codigos');
	}

	public function postImprimir_tributacoes_codigos()
	{
		$sql = "select p.*,pe.*, gp.descricao as grupo_produto from produtos p 
		join produto_empresa pe on pe.codigo_produto=p.codigo 
		join gruposprodutos gp on p.codigo_grupoproduto=gp.codigo 
		where p.empresa in(".separa_array_virgulas(Auth('empresa_selecionada')).")";

		if (!vazio($_POST['NCM'])):
			$ncm = $_POST['NCM'];
			$sql .= " and p.codigo_nbmsh like '%$ncm%' ";
		endif;

		if (!vazio($_POST['ANP'])):
			$anp = $_POST['ANP'];
			$sql .= " and p.codigoanp like '%$anp%' ";
		endif;

		if (!vazio($_POST['CEST'])):
			$cest = $_POST['CEST'];
			$sql .= " and p.codigo_cest like '%$cest%' ";
		endif;

		if (!vazio($_POST['calcula_pis']))
			$sql .= " and p.calculapis='S' ";
		if (!vazio($_POST['calcula_cofins']))
			$sql .= " and p.calculacofins='S' ";

		$sql .= " order by gp.descricao";
		$consulta = query($sql);

		$this->limpa_conteudo();

		foreach ($consulta as $linha):
			$this->linha("<br>Grupo : {$linha->grupo_produto}");
			$this->linha("<hr style='margin-top:5;margin-bottom:10;border:solid black 1px;'>");
			$this->linha
			(
				"<div class='col-xs-2'>
					Cód. : {$linha->codigo}
				</div>
				<div class='col-xs-8'>
					Descrição : {$linha->descricao}
				</div>
				<div class='col-xs-2'>
					NCM : {$linha->codigo_nbmsh}
				</div>
				<div class='col-xs-2'>
					CEST : {$linha->codigo_cest}
				</div>
				<div class='col-xs-2'>
					CST Saída : {$linha->codigo_st}
				</div>
				<div class='col-xs-2'>
					CST Ent. : {$linha->codigo_stentrada}
				</div>"		
			);
			$this->linha("<hr style='margin-top:5;margin-bottom:10;border:dashed black 1px;'>");
			if($linha->calculapis=="S"):
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					CST PIS : {$linha->cstpis}
				</div>
				<div class='col-xs-4 text-center'>
					CST PIS Ent. : {$linha->cstpisentrada}
				</div>	
				<div class='col-xs-3 text-right'>
					Aliquota PIS : {$linha->aliquotapis}
				</div>"
			);
			endif;
			if($linha->calculacofins=="S"):
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					CST COFINS : {$linha->cstcofins}
				</div>
				<div class='col-xs-4 text-center'>
					CST COFINS Ent. : {$linha->cstcofinsentrada}
				</div>	
				<div class='col-xs-3 text-right'>
					Aliquota COFINS : {$linha->aliquotacofins}
				</div>"
			);
			endif;
			// $this->linha("<hr style='margin-top:5;margin-bottom:10;border:dashed black 1px;'>");
			$this->linha
			(										
				"<div class='col-xs-2'>
					CST Saída : {$linha->codigo_st}
				</div>
				<div class='col-xs-2'>
					CST Ent. : {$linha->codigo_stentrada}
				</div>"	
			);
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					Aliquota ICMS : {$linha->aliquotaicms}
				</div>	
				<div class='col-xs-4 text-center'>
					Aliquota ISS : {$linha->aliquotaiss}
				</div>									
				<div class='col-xs-3 text-right'>
					Aliquota ICMS Red. : {$linha->aliquotaicmsreduzida}
				</div>"
			);
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					Aliquota MVA ST : {$linha->mvast}
				</div>	
				<div class='col-xs-4 text-center'>
					Aliquota IPI : {$linha->aliquotaipi}
				</div>									
				<div class='col-xs-3 text-right'>
					ICMS Outros UF. : {$linha->icmsoutros}
				</div>"
			);
			$this->linha("<hr style='margin-top:5;margin-bottom:10;border:dashed black 1px;'>");
		// break;
		endforeach;
		$html = template_relatorio('Relatório Tributações / Códigos',$this->conteudo);
		imprimir($html);
	}

	private function linha($conteudo)
	{
		$this->conteudo .= "<div class='row'>{$conteudo}</div>";
	}

	private function limpa_conteudo()
	{
		$this->conteudo = "";
	}
	
}


