<?php
use Illuminate\Database\Capsule\Manager as DB;

function getInfo($valor,$tabela,$campo=1,$operador='=',$comparador=1)
{
	foreach(DB::table($tabela)->where($campo,$operador,$comparador)->get() as $row)
		return $row->{$valor};
}

function mensagem($mensagem= "")
{
	return "<script>alert('$mensagem');</script>";
}

function asset($diretorio = "",$url = "")
{
	return $url = 'http://'.$_SERVER['SERVER_NAME'].'/'.PASTA_PROJETO.'/'.$diretorio;
}

function gerarpdf($html ="",$arq= "PDF_TEMPORARIO",$donwload = false, $tamanho='A4',$formato="portrait")
{
	if(isset($dompdf))
		unset($dompdf);
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);
	$dompdf->setPaper($tamanho, $formato);
	$dompdf->render();
	$dompdf->stream($arq, array("Attachment" => $donwload));
	unset($dompdf);
}

function redirecionar($caminho)
{
    header("location:$caminho");
}

function voltar()
{
	echo '<script>window.history.back();</script>';
}

function limitarTexto($texto, $limite,$adicao =""){
  $contador = strlen($texto);
  if ( $contador >= $limite ) {      
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . $adicao;
      return $texto;
  }
  else{
    return $texto;
  }
} 