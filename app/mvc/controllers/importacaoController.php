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
		if($this->existeArquivos())
		{
			$tempo_inicio = microtime(true);
			try
			{
				foreach ($this->arq_importar as $arquivo):
					$this->registros = 0;
					$this->inserts = 0;
					$this->updates = 0;	
					if ($this->validaJSON($arquivo))
					{
						ini_set('max_execution_time', 0);
						$this->importar($this->arquivo = $arquivo);
						$this->registrar_importacao('S',microtime(true) - $tempo_inicio);
						$this->mover_arquivo('importados');	
						$this->arquivos_importados++;		
					}
        			registralog("Importou com sucesso o arquivo :".$this->arquivo);
				endforeach;
			}
			catch(exception $e)
			{
				echo json_encode('ERRO');				
				$this->registrar_importacao('N',microtime(true) - $tempo_inicio);
				$this->mover_arquivo('erro');
        		registralog("Erro ao importar arquivo :".$this->arquivo);
			}
			ini_set('max_execution_time', 30);
		}
		echo json_encode($this->arquivos_importados);
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
		$pasta = __DIR__."/../../../public/uploads/importacao/$pasta/{$this->cnpj_empresa}/";
		if (!is_dir($pasta))
			mkdir($pasta);
		copy($this->pasta_importar.$this->arquivo,$pasta.$this->arquivo);
		unlink($this->pasta_importar.$this->arquivo);
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
    	$qtde_importar   = $this->Qtde_arquivos("IMPORTAR");
    	$qtde_erro       = $this->Qtde_arquivos("ERRO");
    	$qtde_importados = $this->Qtde_arquivos("IMPORTADOS");
    	$arquivos = $this->Arquivos_Pasta($pasta);
		echo $this->view('importacao.index',compact('arquivos','qtde_importar','qtde_erro','qtde_importados'));
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

}

