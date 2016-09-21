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
			$this->linha("<br><strong>{$linha->grupo_produto}</strong>");
			$this->linha("<hr style='margin-top:5;margin-bottom:10;border:solid black 1px;'>");
			$this->linha
			(
				"<div class='col-xs-12 text-left'>
					<strong>Produto. :</strong> {$linha->codigo} : {$linha->descricao} - <strong>NCM :</strong> {$linha->codigo_nbmsh}
				</div>

				<div class='col-xs-3 text-left'>
					<strong>CEST :</strong> {$linha->codigo_cest}
				</div>
				<div class='col-xs-6 text-center'>
					<strong>CST Saída :</strong> {$linha->codigo_st}
				</div>	
				<div class='col-xs-3 text-right'>
					<strong>CST Ent. :</strong> {$linha->codigo_stentrada}
				</div>"		
			);
			$this->linha("<hr style='margin-top:5;margin-bottom:10;border:dashed black 1px;'>");
			if($linha->calculapis=="S"):
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					<strong>CST PIS :</strong> {$linha->cstpis}
				</div>
				<div class='col-xs-6 text-center'>
					<strong>CST PIS Ent. :</strong> {$linha->cstpisentrada}
				</div>	
				<div class='col-xs-3 text-right'>
					<strong>Aliquota PIS :</strong> {$linha->aliquotapis}
				</div>"
			);
			endif;
			if($linha->calculacofins=="S"):
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					<strong>CST COFINS :</strong> {$linha->cstcofins}
				</div>
				<div class='col-xs-6 text-center'>
					<strong>CST COFINS Ent. :</strong> {$linha->cstcofinsentrada}
				</div>	
				<div class='col-xs-3 text-right'>
					<strong>Aliquota COFINS :</strong> {$linha->aliquotacofins}
				</div>"
			);
			endif;
			// $this->linha("<hr style='margin-top:5;margin-bottom:10;border:dashed black 1px;'>");
			
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					<strong>Aliquota ICMS :</strong> {$linha->aliquotaicms}
				</div>	
				<div class='col-xs-6 text-center'>
					<strong>Aliquota ISS :</strong> {$linha->aliquotaiss}
				</div>									
				<div class='col-xs-3 text-right'>
					<strong>Aliquota ICMS Red. :</strong> {$linha->aliquotaicmsreduzida}
				</div>"
			);
			$this->linha
			(										
				"<div class='col-xs-3 text-left'>
					<strong>Aliquota MVA ST :</strong> {$linha->mvast}
				</div>	
				<div class='col-xs-6 text-center'>
					<strong>Aliquota IPI :</strong> {$linha->aliquotaipi}
				</div>									
				<div class='col-xs-3 text-right'>
					<strong>ICMS Outros UF. :</strong> {$linha->icmsoutros}
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


