<?php
use App\Acl\Acl;
use App\Historico;
use JasperPHP\JasperPHP;


function relatorio($modelo,$parametros = array())
{
	try
	{
		// $input =  public_path() . '/relatorios/templates/_modelo_abastecimento.jrxml';
	    $output = public_path() . '/relatorios/temp/' . time();
		$jasper = new JasperPHP;
		// $jasper->compile($input)->execute();

		$input  = public_path() . '/relatorios/templates/'.$modelo.'.jasper';

		$jasper->process(
			$input,
			$output,
			array('pdf'),
			$parametros,	
		    [
		        'driver'   =>  env('JDBC_DRIVER'),
		        'host'     =>  env('JDBC_HOST'),
		        'port'     =>  env('JDBC_PORT'),
		        'username' =>  env('JDBC_USERNAME'),
		        'password' =>  env('JDBC_PASSWORD'),
		        'database' =>  env('JDBC_DATABASE'),
		        'jdbc_dir' => base_path() .'/'. env('JDBC_DIR')
		    ],
			false,
			false
		)->execute();

		$file = $output . '.pdf';
	    $path = $file;
	    
	    if (!file_exists($file)) 
	        return abort(404);
	    $file = file_get_contents($file);

	    // exclui pdf temporário criado
	    unlink($path);
	    
	    return response($file, 200)
	        ->header('Content-Type', 'application/pdf')
	        ->header('Content-Disposition', 'inline;');
	}
	catch(\Exepction $e)
	{
	    throw new \Exception('Erro ao gerar Relatório', 1);
	}
}

function regra_de_3($vlr1,$ref1,$vlr2)
{
	return ($vlr2*$ref1)/$vlr1;
}

function historico($array =[],$logado= true)
{
	try
	{
        DB::beginTransaction();		
		$log = new Historico;
		$log->tipo = $array['tipo'];
		$log->titulo = $array['titulo'];
		$log->descricao = $array['descricao'];
		$log->ref_id = $array['ref_id'];
		if($logado)
		{
			$log->tenant_id = Auth::user()->tenant_id;
			$log->usuario_id = Auth::user()->id;
			$log->autor = Auth::user()->nome;
		}
		else
		{
			$log->tenant_id  = $array['ref_id'];
			$log->usuario_id = $array['ref_id'];
		}
		$log->save();
        DB::commit(); 
		return true;
	}
	catch(\Exepction $e)
	{
        DB::rollback(); 
		return false;
	}
}

function randomColor()
{
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
   	return '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
}


function parametro($nome,$processa = true)
{	
	$result = Auth::user()->empresa->parametro->{$nome};
	if($processa):
		if(($result !="S")&&($result !="N"))
			return $result;
		else
			if($result =="S")
				return true;
			else
				return false;
	else:
		return $result;
	endif;
}

function can($modulo,$permissao)
{	
	return (count(Acl::can($modulo,$permissao)->get())>0);
}
function cannot($modulo,$permissao)
{	
	return !can($modulo,$permissao);
}
function format_reais($valor)
{
	return "R$ ".number_format($valor, parametro('qtde_dec_dinheiro'), ',', '.');
}

function tiramascara($string)
{
	return str_replace(')','',str_replace('(','',str_replace('.','',str_replace('-', '', $string))));
}


function porcentagem($valor,$total)
{
	$porc = regra_de_3($total,100,$valor);
	if(!is_int($porc))
		return number_format($porc, parametro('qtde_dec_porcento') , ',', '.');
	else
		return $porc;
}

function bomdia()
{
	date_default_timezone_set(Auth::user()->timezone);
	$hr = date(" H ");
	if($hr >= 12 && $hr<18) 
	{
		$resp = "Boa tarde";
	}
	else if ($hr >= 0 && $hr <12 )
	{
		$resp = "Bom dia";
	}
	else 
	{
		$resp = "Boa noite";
	}
	return $resp ;
}

function sexo_palavra($concordante,$palavra)
{
	$feminino =false;
	$ultima_concor = uppertrim(substr($palavra, -1));
	if($ultima_concor==uppertrim('A'))
		$feminino=true;
	$fim_palavra = uppertrim(substr($concordante, -2));
	if($feminino):
		switch ($fim_palavra) 
		{
			case "OM":
				return substr($concordante,0,-1)."a";
				break;
			case "MO":
				return substr($concordante,0,-1)."a";
				break;	
			case "DO":
				return substr($concordante,0,-1)."a";
				break;		
			case "UM":
				return substr($concordante,0,-1)."ma";
				break;				
			default:
				return $concordante;
				break;
		}
	else:
		switch ($fim_palavra) 
		{
			case "OA":
				return substr($concordante,0,-1)."om";
				break;
			case "MA":
				return substr($concordante,0,-1)."o";
				break;	
			case "DA":
				return substr($concordante,0,-1)."do";
				break;	
			case "UMA":
				return substr($concordante,0,-1);
				break;			
			default:
				return $concordante;
				break;
		}
	endif;
}


function dia_semana($data)
{
	$diasemana = array('domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado');
	$diasemana_numero = date('w', strtotime($data));
	return $diasemana[$diasemana_numero];
}

function uppertrim($string)
{
	return strtoupper(trim($string));
}   
function lowertrim($string)
{
	return strtoupper(trim($string));
}  
function upper($string)
{
	return strtoupper($string);
}   
function lower($string)
{
	return strtolower($string);
}   

function Iniciais($texto) 
{
	$palavras = explode(" ", $texto);
	$ini = "";
	$qtde = 0;
	foreach ($palavras as $key => $value):
		if(uppertrim($value)!=""):
			if($qtde==2)
				break;
			$ini.=substr($value,0,1);
			$qtde++;
		endif;
	endforeach;
	return uppertrim($ini);
}

function dt_format($data,$formato="d/m/Y")
{
	$data =  date($formato, strtotime($data) );
	if($data=='31/12/1969')
		return null;
	else
		return $data;
}
function calc_idade($data_nasc) 
{
	// $data_nasc=explode('/',dt_format($data_nasc));
	// $data=date('d/m/Y');
	// $data=explode('/',$data);
	// $anos=$data[2]-$data_nasc[2];
	// if($data_nasc[1] > $data[1])
	// 	return $anos-1;
	// if($data_nasc[1] == $data[1])
	// {
	// 	if($data_nasc[0] <= $data[0]) 
	// 	{
	// 		return $anos;
	// 	}
	// 	else
	// 	{
	// 		return $anos-1;
	// 	}
	// }
	// if ($data_nasc[1] < $data[1])
		return 0;
}

function select($sql,$campo=null)
{
	DB::beginTransaction();
	if(is_null($campo))
		return  DB::select(DB::raw($sql));
	else
	{
		$query = DB::select(DB::raw($sql));
		return $query[0]->{$campo};
	}
	DB::rollBack();
}

function resetAutoInc($tabela)
{
	$id = select("select max(id) as max from $tabela","max")+1;
	query("ALTER TABLE $tabela AUTO_INCREMENT = $id" );		
}

function query($sql)
{
	DB::beginTransaction();
	if($sql!=null)
	{
		DB::select(DB::raw($sql));
		DB::commit();
	}
}



function deleteDir($dirPath) 
{
	if (! is_dir($dirPath)) {
	    throw new InvalidArgumentException('$dirPath must be a directory');
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	    $dirPath .= '/';
	}
	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ($files as $file) {
	    if (is_dir($file)) {
	        deleteDir($file);
	    } else {
	        unlink($file);
	    }
	}
	rmdir($dirPath);
}