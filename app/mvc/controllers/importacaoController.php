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
	protected $valores_chave = array();
	protected $query;
	


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
			// ini_set('max_execution_time', 30);
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
		return (object) json_decode($JSON);
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
		$chaves_primarias = array();
		foreach ($chave as $_chave):	
			array_push($chaves_primarias,$_chave);
		endforeach;
		$this->chaves_primarias = $chaves_primarias;
	}

	private function pega_valor_chave_primaria($linha)
	{
		foreach ($this->chaves_primarias as $chave):
			$chaves_com_valores[$chave.'_desktop'] = $linha->{$chave};
			$linha = renomear_posicao_objeto($linha,$chave,$chave.'_desktop');	
		endforeach;
		$this->chaves_primarias =  null;
		$this->chaves_primarias = $chaves_com_valores;
		return $linha;
	}

	private function define_tabela($tabela)
	{
		array_push($this->tabelas_importacao, $tabela);
		$this->tabela = $tabela;
	}

	private function define_operacao($tabela)
	{
		$this->query = DB::table($tabela)
			->where($this->chaves_primarias)
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
		$this->model = $this->model($this->tabela);
		switch (strtoupper($this->tipo_operacao)):			
			case 'INSERT':
				$objeto = new $this->model;
				foreach ($linha as $campo => $valor):
					$objeto->{$campo} = $valor;
					$objeto->save();
				endforeach;
				unset($objeto);
				return true;
				break;
			case 'UPDATE':				
				$this->query = $this->model->findOrFail($this->query[0]->id);
				foreach ($linha as $campo => $valor):
					$this->query->{$campo} = $valor;
					$this->query->save();
				endforeach;
				return true;
			default:
				return false;
				break;
		endswitch;
	}

	private function importar($arquivo)
	{
		$JSON = $this->lerArquivo($this->pasta_importar.$arquivo);
		foreach ($JSON as $tabela => $resultado):		 
			$this->define_tabela($tabela);
			foreach ($resultado as $linha):
				$this->pega_nome_chaves_primarias($linha->chave_primaria);
			 	$linha_atualizada = $this->pega_valor_chave_primaria($linha);
			    $this->define_operacao($tabela);
			    $this->executa_operacao($linha_atualizada);
			endforeach;			
		endforeach;		
    }

}

