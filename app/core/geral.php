<?php
use Illuminate\Database\Capsule\Manager as DB;


function getInfo($valor,$tabela,$campo=1,$operador='=',$comparador=1)
{
	foreach(DB::table($tabela)->where($campo,$operador,$comparador)->get() as $row)
		return $row->{$valor};
}

function separa_array_virgulas($array)
{
	$string = "";
	for ($i=0; $i < count($array) ; $i++):
		$string .= $array[$i];
		if($i<count($array)-1)
			$string .= ",";
	endfor;
	return $string;
}

function registralog($log = "")
{
	if(tabela_existe('log'))
		DB::table('log')->insert(['descricao' =>$log, 'usuario' => Auth('id'),'created_at'=>date("Y-m-d H:i:s")]);
	else
		{
			query('create table log (id int(11) NOT NULL, usuario int(11) NOT NULL,  descricao varchar(500) NOT NULL,
						  created_at timestamp NULL DEFAULT NULL, updated_at timestamp NULL DEFAULT NULL)');
			query('alter TABLE log ADD PRIMARY KEY (id)');
			query('alter TABLE log  MODIFY id int(11) NOT NULL AUTO_INCREMENT');
		}
}

function mensagem($mensagem= "")
{
	return "<script>alert('$mensagem');</script>";
}

function asset($diretorio = "",$url = "")
{
	return $url = 'http://'.$_SERVER['SERVER_NAME'].'/'.PASTA_PROJETO.'/'.$diretorio;
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
  if ( $contador >= $limite )
  {   
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . $adicao;
      return $texto;
  }
  else
    return $texto;
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

	if(!$mail->send())
	    return false;
	else
	    return true;
}

function _route($string)
{
	return strtoupper($string);
}

function montar_tabela($cabecalho,$dados)
{
    $tabela = "<table class='table table-striped' style='table-layout: auto;'>";
        $tabela.='<thead>';
            $tabela.='<tr>';
                foreach ($cabecalho as $item =>$campo):
                    $tabela.="<th>$campo</th>";                     
                endforeach;
            $tabela.='</tr>';
        $tabela.='</thead>';
        $tabela.='<tbody>';             
            foreach ($dados as $dado):
                $tabela.='<tr>';
 	               foreach ($cabecalho as $item =>$campo):
                        $tabela.="<td>{$dado->{$item}}</td>";   
                    endforeach; 
                $tabela.='</tr>';
            endforeach;
        $tabela.='</tbody>';
        $tabela .="</table>
        <div class='paginacao'>{$dados->links()}</div>";
        return $tabela;
    }

function primeiro_nome($nome)
{
  	$pos_espaco = strpos($nome, ' ');
	return substr($nome, 0, $pos_espaco);
}

function string_virgulas_array($string)
{
	return explode(',', $string);
}

function limpa_vazios_array($array)
{
	return array_diff( $array , array( '' ) );
}

function object_search($valor,$campo,$objeto)
{
	$posicao = 0;
	for($i=0;$i<count($objeto);$i++):
		if($objeto[$i]->{$campo}==$valor):
			$posicao = $i;
			break;
		endif;
	endfor;
	return $posicao;
}

function add_campo_objeto($campo,$valor,$objeto)
{
	foreach($objeto as $ob):
	    $ob->{$campo} = $valor;
	endforeach;	
	return $objeto;
}


function remove_repeticao_array($array)
{
	$array_aux2 = array();
	$achou = false;
	foreach ($array as $array_original):
		foreach ($array as $array_aux):
			if($array_original==$array_aux)
				$achou = true;
			if($achou)
				array_push($array_aux2, $array_original);
			$achou = false;
		endforeach;
	endforeach;
	return $array_aux2;
}

function data_formatada($data)
{
	$data =  date("d/m/Y", strtotime($data) );
	if($data=='31/12/1969')
		return null;
	else
		return $data;
}

function format_reais($valor)
{
	return 'R$' .' '.number_format($valor, 2);
}

function vazio($variavel)
{
	if ((isset($variavel)) && ($variavel!="") && (trim($variavel)!="") && (!is_null($variavel)))
		return false;
	else
		return true;
}


function query($sql,$campo=null)
{
	if(is_null($campo))
		return  DB::select(DB::raw($sql));
	else
	{
		$query = DB::select(DB::raw($sql));
		return $query[0]->{$campo};
	}
}

function tabela_existe($tabela)
{
	$tabelas =  query("SHOW TABLES LIKE '".$tabela."'");
	if(count($tabelas)>0)
		return true;
	else
		return false;
}

function string_to_date($string,$dias="0")
{
	$dia = substr($string,0,2);
	$mes = substr($string,3,2);
	$ano = substr($string,6,4);
	$data =  $mes."/".$dia."/".$ano;
	$time = strtotime($data);
	return  $newformat = date('Y-m-d', strtotime("{$dias} days", $time));
}