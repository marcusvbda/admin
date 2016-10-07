
<?php
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;

function gerarpdf($html ="",$donwload = false,$arq= "PDF_TEMPORARIO", $tamanho='A4',$formato="portrait")
{
	ini_set('max_execution_time', 0);	
	$mpdf = new mPDF('UTF-8','A4');
	$mpdf->pagenumPrefix = 'Página ';
	$mpdf->nbpgPrefix = ' de ';
	$mpdf->nbpgSuffix = ' Pagina(s)';
	$mpdf->SetFooter('{PAGENO}{nbpg}');
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->useSubstitutions=false;
	$mpdf->simpleTables = true;
	$mpdf->WriteHTML(file_get_contents(PASTA_PUBLIC."/template/bootstrap/css/bootstrap.min.css"),1);
	$mpdf->WriteHTML($html);
	if($donwload)
		$mpdf->Output($arq.'.pdf', 'D');
	else
		$mpdf->Output();
	ini_set('max_execution_time', 30);	
}

function gera_cabecalho_relatorio($campos=[])
{
	$cabecalho = "<table class='table-striped' style='width:100%;'>
					<tr>";
	foreach ($campos as $campo =>$campo_real):
		$cabecalho .= "<th>{$campo}</th>";	
	endforeach;
	$cabecalho .= "</tr>";
	return $cabecalho;
}

function gera_table_relatorio($campos,$array)
{
	$corpo = "";	
	foreach ($array as $linha):
		$corpo .= "<tr>";	
		foreach ($campos as $campo => $campo_real):
			$corpo  .="<td>".$linha->{$campo_real}."</td>";
		endforeach;		
		$corpo .= "</tr>";
	endforeach;
	$corpo .= "</table>";
	return $corpo;
}

function prepararelatorio_corpo($corpo,$titulo)
{
	$html = template_relatorio($titulo,$corpo);
	return $html;
}

function prepararelatorio($campo_relatorio,$consulta,$titulo)
{
	$table = gera_cabecalho_relatorio($campo_relatorio); 
	$table .= gera_table_relatorio($campo_relatorio,$consulta);
	$html = template_relatorio($titulo,$table,count($consulta));
	return $html;
}

function template_relatorio($titulo,$corpo)
{
	$data = date('d/m/Y');
	$hora = date('H:i:s');
	$css = PASTA_PUBLIC."/template/bootstrap/css/bootstrap.min.css";
	$template = 
	"
	<html>
		<head>
			<meta charset='utf-8'>
			<title>{$titulo}</title>	
			<style>
				.centro 
				{
					text-align:center;
				}
			</style>
 			<link rel='stylesheet' href='".$css."'>
  			<link rel='icon' href=".FAVICON." type='image/gif'>
  		</head>
		<body>
			<div class='container'>
				<div class='row centro'>
					<h1>{$titulo}</h1>
					<hr>
					<p style='text-align:right;margin-top:0;margin-bottom:0;'>Emissão : {$data}  -  {$hora}</p>
					<hr>
				</div>
					{$corpo}
			</div>	
		</body>
	</html>";
	return $template;
}

function imprimir($conteudo)
{
	if(Parametro('imprimir_pdf')=='S')
		gerarpdf($conteudo);
	else
		echo $conteudo;
	
	if(Parametro('imprimir_direto')=="S")
		echo "<script>window.print();</script>";
}
