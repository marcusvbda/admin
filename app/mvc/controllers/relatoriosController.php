<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class relatoriosController extends controller
{

	public function getTributacoes_codigos()
	{
		echo $this->view('relatorios.tributacoes_codigos');
	}

	public function postImprimir_tributacoes_codigos()
	{
		$sql = "select p.*,pe.* from produtos p join produto_empresa pe on pe.codigo_produto=p.codigo where p.empresa in(".separa_array_virgulas(Auth('empresa_selecionada')).") ";

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

		$consulta = query($sql);
		
		$corpo = "";
		$html = template_relatorio('Relatório Tributações / Códigos',$corpo);
		gerarpdf($html);
	}
	
}


