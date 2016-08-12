<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class importacaoController extends controller
{
	protected $arquivo;
	protected $tabelas_importacao = array();
	protected $pasta_importar;
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
	


	public function getIndex()
	{
		if($this->existeArquivos())
		{
			$tempo_inicio = microtime(true);
			try
			{
				ini_set('max_execution_time', 0);
				foreach ($this->arq_importar as $arquivo):
				if ($this->validaJSON($arquivo))
					$this->importar($this->arquivo = $arquivo);
				endforeach;
				$this->registrar_importacao('S',microtime(true) - $tempo_inicio);
				$this->mover_arquivo('importados');					
			}
			catch(exception $e)
			{
				$this->registrar_importacao('N',microtime(true) - $tempo_inicio);
				$this->mover_arquivo('erro');
			}
			ini_set('max_execution_time', 30);
		}
	}

	private function registrar_importacao($status,$tempo)
	{
		$this->model = $this->model('importacoes');
		$importacao = new $this->model;
		$importacao->arquivo = $this->arquivo;
		$importacao->importado=$status;
		$importacao->tempo_execucao=$tempo;
		$importacao->usuario=Auth('id');
		$importacao->empresa=Auth('empresa');
		$importacao->save();
		unset($importacao);
	}

	private function mover_arquivo($pasta)
	{
		$cnpj_empresa = DB::table('empresas')->find(Auth('empresa'))->CNPJ_CPF;
		$pasta_importar = __DIR__."/../../../public/uploads/importacao/importar/{$cnpj_empresa}/";
		$pasta =          __DIR__."/../../../public/uploads/importacao/$pasta/{$cnpj_empresa}/";
		if (!is_dir($pasta))
			mkdir($pasta);
		copy($pasta_importar.$this->arquivo,$pasta.$this->arquivo);
		unlink($pasta_importar.$this->arquivo);
	}

	private function existeArquivos()
	{
		$cnpj_empresa = DB::table('empresas')->find(Auth('empresa'))->CNPJ_CPF;
		$this->pasta_importar = __DIR__."/../../../public/uploads/importacao/importar/{$cnpj_empresa}/";
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
				// $this->chaves_com_valor[$chave] = $linha->{$chave};	
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
				->where('empresa','=',Auth('empresa'))
					->get();			

		if(count($this->query)>0)
			$this->tipo_operacao='UPDATE';
		else
			$this->tipo_operacao='INSERT';
	}


	private function executa_operacao($linha)
	{
		$linha = (array) $linha;
		$linha['empresa']=Auth('empresa');
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
			$sql.="empresa int NOT NULL,PRIMARY KEY (sequencia))";	
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
		echo json_encode(['qtde_registros'=>$this->registros,'qtde_inserts'=>$this->inserts,'qtde_updates'=>$this->updates]);
    }

}

