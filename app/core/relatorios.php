
<?php
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;

function gerarpdf($html ="",$donwload = false,$arq= "PDF_TEMPORARIO", $tamanho='A4',$formato="portrait")
{
	ini_set('max_execution_time', 0);	
	$mpdf = new mPDF();
	$mpdf->pagenumPrefix = 'Página ';
	$mpdf->nbpgPrefix = ' de ';
	$mpdf->nbpgSuffix = ' Pagina(s)';
	$mpdf->SetFooter('{PAGENO}{nbpg}');
	$css = file_get_contents(PASTA_PUBLIC."/template/bootstrap/css/bootstrap.min.css");
	$mpdf->WriteHTML($css,1);
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
	$html = template($titulo,$corpo);
	return $html;
}

function prepararelatorio($campo_relatorio,$consulta,$titulo)
{
	$table = gera_cabecalho_relatorio($campo_relatorio); 
	$table .= gera_table_relatorio($campo_relatorio,$consulta);
	$html = template($titulo,$table,count($consulta));
	return $html;
}

function template($titulo,$corpo)
{
	$data = date('d/m/Y');
	$hora = date('H:i:s');
	// $template = 
	// "
	// <html>
	// 	<head>
	// 		<meta charset='utf-8'>
	// 		<title>{$titulo}</title>
	// 		<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>			
 //  		</head>
	// 	<body>
	// 		<div style='padding:20px;padding-bottom:0;'>
	// 			<h4 style='text-align:center;margin-top:0;'><strong>{$titulo}</strong></h4><hr>
	// 			<p style='text-align:right;margin-top:0;margin-bottom:0;'>Emissão : {$data}  -  {$hora}</p>
	// 			<hr>
	// 		</div>
	// 		<div style='padding:20px;text-align:center;padding-top:0;'>
	// 			{$corpo}
	// 			<hr>
	// 		</div>			
	// 	</body>
	// </html>";

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
				".file_get_contents(PASTA_PUBLIC."/template/bootstrap/css/bootstrap.min.css")."
			</style>	
  		</head>
		<body>
			<div class='container'>
				<div class='row centro'>
					<h1>{$titulo}</h1>
					<hr>
					<p style='text-align:right;margin-top:0;margin-bottom:0;'>Emissão : {$data}  -  {$hora}</p>
					<hr>
				</div>
				<div class='row centro'>
					{$corpo}
				</div>
			</div>	
		</body>
	</html>";
	return $template;
}
