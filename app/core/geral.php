<?php
use Illuminate\Database\Capsule\Manager as DB;

function getInfo($valor,$tabela,$campo=1,$operador='=',$comparador=1)
{
	foreach(DB::table($tabela)->where($campo,$operador,$comparador)->get() as $row)
		return $row->{$valor};
}

function registralog($log = "")
{
	DB::table('log')->insert(['descricao' =>$log, 'usuario' => Auth('id'),'created_at'=>date("Y-m-d H:i:s")]);
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

function criardiretorio($diretorio ="")
{
	if (!is_dir($diretorio))
		mkdir($diretorio);
}

function redimensionarimg($largura="200",$imagem)
{
 	$imagem = imagecreatefromjpeg($imagem);
 	$largura_original = imagesx($imagem);
 	$altura_original = imagesy($imagem);
 	$altura_nova = intval( ( $altura_original * $largura_nova ) / $largura_original );
 	$nova_imagem = imagecreatetruecolor( $largura_nova, $altura_nova );
 	imagecopyresampled( $nova_imagem, $imagem, 0, 0, 0, 0, $largura_nova, $altura_nova, $largura_original, $altura_original );
 	header( 'Content-type: image/jpeg' );
 	return imagejpeg( $nova_imagem, NULL, 80 );
}


function getConfiguracoesGerais($id)
{
	foreach(DB::table('configuracoes_gerais')->where('id','=',$id)->get() as $row)
	$resultado = array('email_adm'=>$row->email_adm,	
							'porta_email_adm'=>$row->porta_email_adm,
								'smtp_email_adm'=>$row->smtp_email_adm,
									'senha_email_adm'=>$row->senha_email_adm,
										'autentica_email_adm'=>$row->autentica_email_adm);
	return $resultado;
}

function enviarEmail($para,$assunto,$texto,$anexo="")
{	
	$configuracoes_gerais = getConfiguracoesGerais(1);
	$mail = new PHPMailer;
	// $mail->SMTPDebug  = 2; 
	$mail->isSMTP();    
	$mail->CharSet = 'UTF-8';                               
	$mail->Host = $configuracoes_gerais['smtp_email_adm'];
	if($configuracoes_gerais['autentica_email_adm']=="S")
		$mail->SMTPAuth = true;  
	else 
		$mail->SMTPAuth = false;  
	$mail->Username = $configuracoes_gerais['email_adm'];            
	$mail->Password = $configuracoes_gerais['senha_email_adm'];                     
	$mail->Port = $configuracoes_gerais['porta_email_adm'];                                    

	$mail->setFrom($configuracoes_gerais['email_adm'],APP_NOME);
	$mail->addAddress($para);    

	if(!$anexo=="")
		$mail->addAttachment($anexo);       

	$mail->isHTML(true);                                

	$mail->Subject = $assunto;
	$mail->Body    = $texto;

	if(!$mail->send()) {
	    return false;
	} else {
	    return true;
	}


}