<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class importacaoController extends controller
{
	protected $arquivo;
	protected $tabelas_importacao = array();
	protected $pasta_importar;
	protected $cnpj_empresa;
	protected $pasta_importados;
	protected $pasta_erro;
	protected $tabela;
	protected $tipo_operacao ="INSERT";
	protected $chaves_primarias = array();
	protected $chaves_com_valor = array();
	protected $valores_chave = array();
	protected $campos_tabela = array();
	protected $query;
	protected $registros = 0;
	protected $inserts = 0;
	protected $updates = 0;
	protected $arquivos_importados = 0;
	

	public function __construct()
	{
		$this->cnpj_empresa = Auth('cnpj_empresa');
		$this->pasta_importar = __DIR__."/../../../public/uploads/importacao/importar/{$this->cnpj_empresa}/";
		$this->pasta_importados = __DIR__."/../../../public/uploads/importacao/importados/{$this->cnpj_empresa}/";
		$this->pasta_erro = __DIR__."/../../../public/uploads/importacao/erro/{$this->cnpj_empresa}/";
		if(!tabela_existe('importacoes'))
		{
			query('create TABLE importacoes (
					  id int(11) NOT NULL,
					  arquivo varchar(100) DEFAULT NULL,
					  importado varchar(1) DEFAULT NULL,
					  usuario int(11) DEFAULT NULL,
					  empresa int(11) DEFAULT NULL,
					  tempo_execucao float DEFAULT NULL,
					  qtde_registros int(11) DEFAULT NULL,
					  qtde_inserts int(11) DEFAULT NULL,
					  qtde_updates int(11) DEFAULT NULL,
					  created_at timestamp NULL DEFAULT NULL,
					  updated_at timestamp NULL DEFAULT NULL
					)');
			query('alter TABLE importacoes ADD PRIMARY KEY (id)');
			query('alter TABLE importacoes  MODIFY id int(11) NOT NULL AUTO_INCREMENT');
		}
	}

	public function postQtde_arquivos($pasta)
	{
	   	echo json_encode($this->Qtde_arquivos($pasta));
	}

	public function Qtde_arquivos($pasta)
	{
		
	   	$this->arq_importar = scandir( __DIR__."/../../../public/uploads/importacao/{$pasta}/{$this->cnpj_empresa}/");
	   	return (count($this->arq_importar)-2);
	}


	public function getImportarManualmente()
	{
		$this->postImportar();
	}

	public function postImportar()
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');

		if($this->existeArquivos())
		{
			$tempo_inicio = microtime(true);
			try
			{
				if(!isset($_POST['arquivo']))
				{
					foreach ($this->arq_importar as $arquivo):
						$this->registros = 0;
						$this->inserts = 0;
						$this->updates = 0;	
						if ($this->validaJSON($arquivo))
						{
							$this->importar($this->arquivo = $arquivo);
							$this->registrar_importacao('S',microtime(true) - $tempo_inicio);
							$this->mover_arquivo('importados');	
							$this->arquivos_importados++;		
						}
	        			registralog("Importou com sucesso o arquivo :".$this->arquivo);
					endforeach;	
				}
				else
				{
					$this->registros = 0;
					$this->inserts = 0;
					$this->updates = 0;	
					if ($this->validaJSON($_POST['arquivo']))
					{
						$this->importar($this->arquivo = $_POST['arquivo']);
						$this->registrar_importacao('S',microtime(true) - $tempo_inicio);
						$this->mover_arquivo('importados');	
						$this->arquivos_importados++;		
					}
	        		registralog("Importou com sucesso o arquivo :".$this->arquivo);
				}				
			}
			catch(exception $e)
			{
				echo json_encode('ERRO');				
				$this->registrar_importacao('N',microtime(true) - $tempo_inicio);
				$this->mover_arquivo('erro');
        		registralog("Erro ao importar arquivo :".$this->arquivo);
			}
		}
		echo json_encode($this->arquivos_importados);
		ini_set('max_execution_time', 30);

	}

	private function registrar_importacao($status,$tempo)
	{
		$this->model = $this->model('importacoes');
		$importacao = new $this->model;
		$importacao->arquivo = $this->arquivo;
		$importacao->importado=$status;
		$importacao->tempo_execucao=$tempo;
		$importacao->qtde_registros=$this->registros;
		$importacao->qtde_inserts=$this->inserts;
		$importacao->qtde_updates=$this->updates;
		$importacao->usuario=Auth('id');
		$importacao->empresa=Auth('empresa')[0];
		$importacao->save();
		unset($importacao);
	}

	private function mover_arquivo($pasta)
	{
		// $pasta = __DIR__."/../../../public/uploads/importacao/$pasta/{$this->cnpj_empresa}/";
		// if (!is_dir($pasta))
		// 	mkdir($pasta);
		// if($pasta!="IMPORTADOS")
		// 	copy($this->pasta_importar.$this->arquivo,$pasta.$this->arquivo);
		// unlink($this->pasta_importar.$this->arquivo);
	}

	private function existeArquivos()
	{
	   	$this->arq_importar = scandir($this->pasta_importar);
	   	if(count($this->arq_importar)>2)
	   		return true;
	   	else
	   		return false;
	}

	private function validaJSON($arquivo)
	{
		$extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
		if (($extensao == 'json') || (strtoupper($extensao) == 'JSON') )
			return true;
		else
			return false;
	}

	private function lerArquivo($arquivo)
	{
		$JSON = stream_get_contents(fopen($arquivo, 'r'));
		// $objeto = (object) json_decode(utf8_encode($JSON));
		// print_r($objeto);exit();
		return (object) json_decode(utf8_encode($JSON));
	}

	private function id_desktop($nome_campo)
	{
		if ((strtoupper($nome_campo)=='CODIGO')||
			(strtoupper($nome_campo)=='ID'))
			return true;
		else
			return false;
	}

	private function pega_nome_chaves_primarias($chave)
	{
		$this->chaves_primarias = (array) $chave;
	}

	private function pega_dados_tabela($linha)
	{		
		unset($this->campos_tabela);
		$linha = (array) $linha;
		unset($linha['chaves_primarias']);
		foreach ($linha as $campo=>$info):
			if(is_array($info))
				$this->campos_tabela[$campo]=$info;
		endforeach;
		return $linha;
	}

	private function pega_valor_chave_primaria($linha)
	{
		unset ($this->chaves_com_valor);
		foreach ($linha as $campo => $valor):	
			foreach ($this->chaves_primarias as $chave):
				if($chave==$campo)
					$this->chaves_com_valor[$campo]=$valor;			
			endforeach;
		endforeach;
	}

	private function define_tabela($tabela)
	{
		array_push($this->tabelas_importacao, $tabela);
		$this->tabela = $tabela;
	}

	private function define_operacao($tabela)
	{
		$this->query = DB::table($tabela)
			->where($this->chaves_com_valor)
					->get();			

		if(count($this->query)>0)
			$this->tipo_operacao='UPDATE';
		else
			$this->tipo_operacao='INSERT';
	}


	private function executa_operacao($linha)
	{
		$linha = (array) $linha;
		switch (strtoupper($this->tipo_operacao)):			
			case 'INSERT':
			    DB::table($this->tabela)->insert($linha);
			    $this->inserts++;
				break;
			case 'UPDATE':
				DB::table($this->tabela)
					->where('sequencia','=',$this->query[0]->sequencia)
						->update($linha);	
				$this->updates++;	
			default:
				break;
		endswitch;
		$this->registros++;
	}

	private function atualizar_tabela($tabela)
	{
		$sql = "";	
		$tabelas = DB::table('INFORMATION_SCHEMA.TABLES')
			->where('TABLE_SCHEMA','=',DB_NOME)
				->where('table_name','=',$tabela)
					->get();
		if(count($tabelas)<=0)
		{
			$sql = "CREATE TABLE $tabela(sequencia int NOT NULL AUTO_INCREMENT, ";				
			foreach ($this->campos_tabela as $campo=>$info):
				foreach ($info as $_info):
					if((strtoupper($_info->tipo)=="CHAR")||(strtoupper($_info->tipo)=="VARCHAR"))
						$sql.="$campo $_info->tipo($_info->tamanho),";
					else
						if((strtoupper($_info->tipo)=="DATE")||(strtoupper($_info->tipo)=="DATETIME"))
							$sql.="$campo varchar(15),";
						else
							$sql.="$campo $_info->tipo,";
				endforeach;

			endforeach;
			$sql.=" PRIMARY KEY (sequencia))";	
			DB::statement($sql);	
		}
		else
		{
			$novas_colunas = array();
			$colunas = DB::select("SHOW COLUMNS FROM $tabela");			
			foreach ($this->campos_tabela as $campo => $valor):
				$contador=0;
				foreach($colunas as $linha):
					if(strtoupper($campo)==(strtoupper($linha->Field)))
						$contador++;
				endforeach;
				if($contador==0)
				{
					$sql="ALTER TABLE $tabela ADD COLUMN ";
					foreach ($valor as $valores => $_val):	
						if((strtoupper($_val->tipo)=="CHAR")||(strtoupper($_val->tipo)=="VARCHAR"))					
							$sql.="$campo $_val->tipo($_val->tamanho) NULL";
						else
							$sql.="$campo $_val->tipo NULL";
					endforeach;
					DB::statement($sql);
				}
			endforeach;			
		}		
	}


	private function criar_tabela($tabela,$chaves_primarias)
	{
		$sql = "";	
		$tabelas = DB::table('INFORMATION_SCHEMA.TABLES')
			->where('TABLE_SCHEMA','=',DB_NOME)
				->where('table_name','=',$tabela)
					->get();
		if(count($tabelas)<=0)
		{
			$sql = "CREATE TABLE $tabela(sequencia int NOT NULL AUTO_INCREMENT, ";	
			foreach ($this->campos_tabela as $campo=>$info):
				if((strtoupper($info->tipo)=="CHAR")||(strtoupper($info->tipo)=="VARCHAR"))	
					$sql.=" $campo {$info->tipo}({$info->tamanho}),";
				else
					$sql.=" $campo {$info->tipo} NULL,";					
			endforeach;
			$sql.=" PRIMARY KEY (sequencia))";			
			DB::statement($sql);
			if(count($chaves_primarias)>0):
				$sql_index = "";
				DB::statement("CREATE INDEX idx_sequencia_{$tabela} on {$tabela}(sequencia);");				
				foreach ($chaves_primarias as $chave):
					DB::statement("CREATE INDEX idx_{$tabela}_{$chave} on {$tabela}($chave);");
				endforeach;
			endif;
		}
		else
		{
			$sql="ALTER TABLE $tabela ADD COLUMN ";
			foreach ($this->campos_tabela as $campo=>$info):
				if((strtoupper($info->tipo)=="CHAR")||(strtoupper($info->tipo)=="VARCHAR"))	
					$sql.=" $campo {$info->tipo}({$info->tamanho})";
				else
					$sql.=" $campo {$info->tipo} NULL";				
			endforeach;
			DB::statement($sql);
		}
	}

	private function importar($arquivo)
	{	
		$primeira_execucao=true;
		$JSON = $this->lerArquivo($this->pasta_importar.$arquivo);
		foreach ($JSON as $tabela => $resultado):
			$primeira_execucao=true;
			foreach ($resultado as $linha):
				$this->define_tabela($tabela);
				if($primeira_execucao)
				{
					$this->pega_nome_chaves_primarias($linha->chaves_primarias);
					$linha = $this->pega_dados_tabela($linha);
				 	$this->atualizar_tabela($tabela);
				}
				else
				{
					$this->pega_valor_chave_primaria($linha);
					$this->define_operacao($tabela);
					$this->executa_operacao($linha);
				}
				$primeira_execucao=false;
			endforeach;
		endforeach;
    }

    public function getDadosImportacoes()
    {
    	$dados['importados'] = $this->Qtde_arquivos('IMPORTADOS');
    	if($dados['importados']>0)
    	{
    		$query = query("select * from importacoes where id = (select max(id) as id from importacoes)");	
	    	if(count($query)>0)
	    		$dados['data_ultima_importacao']=data_formatada($query[0]->created_at);
	    	else
	    		$dados['data_ultima_importacao']='0';
	    }

    	$dados['nao_importados'] = $this->Qtde_arquivos('ERRO');
    	echo json_encode($dados);
    }

    private function getDataGeracaoArquivo($arq)
    {
    	return substr($arq,6,2)."/".substr($arq,4,2)."/".substr($arq,0,4);
    }

    public function Arquivos_Pasta($pasta)
    {
    	$retornos = array();
    	$cont = 0;
    	if($pasta=="TODAS")
    	{
			$arquivos = scandir($this->pasta_importados);	   	
			foreach ($arquivos as $arq):
				if(($arq!=".")&&($arq!="..")):
		       		$retornos[$cont]=(object)['diretorio'=>PASTA_PUBLIC."/uploads/importacao/importados/{$this->cnpj_empresa}/{$arq}",'arquivo'=>$arq,'pasta'=>'IMPORTADOS','data_geracao'=>$this->getDataGeracaoArquivo($arq)];
		       		$cont++;
		       	endif;
			endforeach;
			$arquivos = scandir($this->pasta_erro);	   	
			foreach ($arquivos as $arq):
				if(($arq!=".")&&($arq!="..")):
		       		$retornos[$cont]=(object)['diretorio'=>PASTA_PUBLIC."/uploads/importacao/erro/{$this->cnpj_empresa}/{$arq}",'arquivo'=>$arq,'pasta'=>'ERRO','data_geracao'=>$this->getDataGeracaoArquivo($arq)];
		       		$cont++;
		       	endif;
			endforeach;
			$arquivos = scandir($this->pasta_importar);	   	
			foreach ($arquivos as $arq):
				if(($arq!=".")&&($arq!="..")):
		       		$retornos[$cont]=(object)['diretorio'=>PASTA_PUBLIC."/uploads/importacao/importar/{$this->cnpj_empresa}/{$arq}",'arquivo'=>$arq,'pasta'=>'IMPORTAR','data_geracao'=>$this->getDataGeracaoArquivo($arq)];
		       		$cont++;
		       	endif;
			endforeach;
		}
		else
		{
			$arquivos = scandir(__DIR__."/../../../public/uploads/importacao/{$pasta}/{$this->cnpj_empresa}/");	
			foreach ($arquivos as $arq):
				if(($arq!=".")&&($arq!="..")):
		       		$retornos[$cont]=(object)['diretorio'=>PASTA_PUBLIC."/uploads/importacao/{$pasta}/{$this->cnpj_empresa}/{$arq}",'arquivo'=>$arq,'pasta'=>$pasta,'data_geracao'=>$this->getDataGeracaoArquivo($arq)];
		       		$cont++;
		       	endif;
			endforeach;
		}
	   	return $retornos;
    }


    public function getIndex($pasta="TODAS")
    {
    	if(Auth('admin_rede')=='N')
    	{
	    	$qtde_importar   = $this->Qtde_arquivos("IMPORTAR");
	    	$qtde_erro       = $this->Qtde_arquivos("ERRO");
	    	$qtde_importados = $this->Qtde_arquivos("IMPORTADOS");
	    	$arquivos = $this->Arquivos_Pasta($pasta);
			echo $this->view('importacao.index',compact('arquivos','qtde_importar','qtde_erro','qtde_importados'));
		}
		else
			redirecionar(asset('erros/403'));
    }

    public function postExcluirArquivo()
    {
    	$pasta   = $_POST['pasta'];
    	$arquivo   = $_POST['arquivo'];
		unlink(__DIR__."/../../../public/uploads/importacao/{$pasta}/{$this->cnpj_empresa}/{$arquivo}");
    }

    public function getImportados()
    {
    	$this->getIndex("IMPORTADOS");
    }

    public function getErro()
    {
    	$this->getIndex("ERRO");
    }

    public function getImportar()
    {
    	$this->getIndex("IMPORTAR");
    }

    public function getImportarDoFirebird($tabela)
    {
    	$tabela = strtoupper($tabela);
    	ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');
		if(!tabela_existe($tabela))
		{
			$campos_tabela = $this->query_firebird(
    		"select ".
                 'R.RDB$FIELD_NAME NOME,
                  CASE R.RDB$NULL_FLAG WHEN 1 THEN'.
                  "
                    'SIM'
                  ELSE
                    'NAO'
                  END AS NOT_NULL,
                  CASE WHEN".' RESULT.RDB$CONSTRAINT_TYPE IS NOT NULL THEN'."
                    'SIM'
                  ELSE
                    'NAO'
                  END AS PRIMARY_KEY, ".'
                  F.RDB$FIELD_LENGTH AS TAMANHO,
                  F.RDB$FIELD_PRECISION AS PRECISAO,
                  CASE F.RDB$FIELD_TYPE '."
                    WHEN 7 THEN 'SMALLINT'
                    WHEN 8 THEN 'INTEGER'
                    WHEN 9 THEN 'QUAD'
                    WHEN 10 THEN 'FLOAT'
                    WHEN 11 THEN 'D_FLOAT'
                    WHEN 12 THEN 'DATE'
                    WHEN 13 THEN 'TIME'
                    WHEN 14 THEN 'CHAR'
                    WHEN 16 THEN 'INT64'
                    WHEN 27 THEN 'DOUBLE'
                    WHEN 35 THEN 'TIMESTAMP'
                    WHEN 37 THEN 'VARCHAR'
                    WHEN 40 THEN 'CSTRING'
                    WHEN 261 THEN 'BLOB'
                    ELSE 'UNKNOWN'
                  END AS TIPO, ".'
                  CSET.RDB$CHARACTER_SET_NAME AS CHARSET
                FROM
                  RDB$RELATION_FIELDS R
                  LEFT JOIN RDB$FIELDS F ON (R.RDB$FIELD_SOURCE = F.RDB$FIELD_NAME)
                  LEFT JOIN RDB$CHARACTER_SETS CSET ON F.RDB$CHARACTER_SET_ID = CSET.RDB$CHARACTER_SET_ID
                LEFT JOIN (SELECT
                  B.RDB$FIELD_NAME,
                  A.RDB$CONSTRAINT_TYPE
                FROM
                  RDB$RELATION_CONSTRAINTS A
                  JOIN RDB$INDEX_SEGMENTS B on (B.RDB$INDEX_NAME = A.RDB$INDEX_NAME)
                WHERE
                  A.RDB$RELATION_NAME='."'".$tabela."' ".'
                AND
                  A.RDB$CONSTRAINT_TYPE = '."'PRIMARY KEY'".') RESULT ON (R.RDB$FIELD_NAME=RESULT.RDB$FIELD_NAME)
                WHERE
                  R.RDB$RELATION_NAME='."'".$tabela."'");
	    	$array = array();
	    	$chaves_primarias = array();
	    	foreach ($campos_tabela as $linha):
	    		if(trim(strtolower($linha['NOME']))!="sincro")
	    		{
	    			$array[trim(strtolower($linha['NOME']))]=(object) array("tipo"=>strtoupper(trim($linha['TIPO'])),"tamanho"=>$linha['TAMANHO']);
	    			if(trim(strtolower($linha['PRIMARY_KEY']))=="sim")
	    				array_push($chaves_primarias, trim(strtolower($linha['NOME']))  );
	    		}
	    	endforeach;
	    	$this->campos_tabela = json_decode(json_encode($array));
			$this->criar_tabela($tabela,$chaves_primarias);
		}
    	$resultado = $this->query_firebird("select * from {$tabela}");
     	query("truncate {$tabela}");    

     	$contador = 0;
    	for ($i=0; $i < count($resultado) ; $i++) :
    		unset($resultado[$i]['SINCRO']);
    		DB::table($tabela)->insert($resultado[$i]);
    		if($contador>=500)
    		{
    			clearstatcache(); 
    			$contador=0;
    		}
    		else
    			$contador ++;
    	endfor;
    	echo "Pronto";
    }

    private function query_firebird($sql)
    {
    	$conexao = $this->conectar_firebird();
    	// echo $sql;exit();
    	$sth = $conexao->query($sql);
		return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    private function conectar_firebird($usuario="CAIXA",$senha="2")
    {
    	$banco_de_dados = "C://Users//bdavi//Desktop//banco.DB";
    	$str_conn="firebird:host=localhost;dbname={$banco_de_dados};charset=UTF8";
		return $db = new PDO($str_conn, $usuario, $senha);
    }
}

