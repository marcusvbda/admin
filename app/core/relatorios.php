<?php
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;

function gerarpdf($html ="",$donwload = false,$arq= "PDF_TEMPORARIO", $tamanho='A4',$formato="portrait")
{
	ini_set('max_execution_time', 0);
	if(isset($dompdf))
		unset($dompdf);
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);
	$canvas = $dompdf->get_canvas();
    // $canvas->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
	$dompdf->setPaper($tamanho, $formato);
	$dompdf->render();
	$dompdf->stream($arq, array("Attachment" => $donwload));
	unset($dompdf);
	ini_set('max_execution_time', 30);
}

function gera_cabecalho_relatorio($campos=[])
{
	$cabecalho = "<table class='w3-table w3-bordered w3-striped w3-small' style='margin: 0px auto;'>
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
	$template = 
	"
	<html>
		<head>
			<meta charset='utf-8'>
			<title>{$titulo}</title>
			<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>			
  		</head>
		<body>
			<div style='padding:20px;padding-bottom:0;'>
				<h4 style='text-align:center;margin-top:0;'><strong>{$titulo}</strong></h4><hr>
				<p style='text-align:right;margin-top:0;margin-bottom:0;'>Emissão : {$data}  -  {$hora}</p>
				<hr>
			</div>
			<div style='padding:20px;text-align:center;padding-top:0;'>
				{$corpo}
				<hr>
			</div>			
		</body>
	</html>";
	return $template;
}