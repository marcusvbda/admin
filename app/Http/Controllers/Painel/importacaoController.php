<?php
namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Response;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Importacoes;
use Input;
use PDO;

class importacaoController extends Controller
{ 
	protected $diretorio_importacao = '/upload/importacao/json/exemplo/';
	protected $arq_importar= null;
	protected $tabelas = null;
	protected $tenant_id = null;
	protected $usuario_id = null;
	protected $qtde_updates = 0;
	protected $qtde_inserts = 0;

  	public function getIndex()
  	{  
  		DB::table('importacoes')->truncate();
  		DB::table('produtos')->truncate();
  		DB::table('gruposprodutos')->truncate();
  		DB::table('tiposprodutos')->truncate();

  		$this->ImportarArquivos();
    }

    private function ImportarArquivos()
    {
    // 	try
  		// {
			$this->tenant_id = Auth::user()->tenant_id;
			$this->usuario_id = Auth::user()->id;

	      	$this->tabelas = $this->listar_tabelas_colunas();
	      	if($this->existeArquivos()):
	      		foreach($this->arq_importar as $arquivo):
	      			$this->qtde_inserts=0;$this->qtde_updates=0;
	  				$this->importarArquivo($this->lerArquivo(public_path().$this->diretorio_importacao.$arquivo),$arquivo);
	      		endforeach;
	      	endif;
	      	return true;
	    // }
	    // catch(\Exception $e)
	    // {
	    //  	return false;
	    // }
    }


    private function existeArquivos()
	{
	   	$this->arq_importar = scandir(public_path().$this->diretorio_importacao);
	   	unset($this->arq_importar[array_search("..", $this->arq_importar)]);
	   	unset($this->arq_importar[array_search(".", $this->arq_importar)]);
	   	if(count($this->arq_importar)>0)
	   	{
	   		return true;
	   	}
	   	else
	   		return false;
	}

    private function listar_tabelas_colunas()
    {
    	$nomeDB = env('DB_DATABASE');
        $campoNomeTabela = "Tables_in_".$nomeDB;
    	$tabelas = DB::select('SHOW TABLES');
        $result = array();
        foreach ($tabelas as $tab):
        	$colunas = array();
            if ($tab->{$campoNomeTabela} !== 'migrations'):
            	$campos = DB::select('SHOW COLUMNS FROM '.$tab->{$campoNomeTabela});  
            	foreach ($campos as $c):            		
            		if (($c->Field !== '_id')
            			&&($c->Field !== 'tenant_id')
            			&&($c->Field !== 'created_at')
            			&&($c->Field !== 'updated_at')
            		):
                		array_push($colunas,$c->Field);
            		endif;
            	endforeach; 
                $result[$tab->{$campoNomeTabela}]=$colunas;
          	endif;
        endforeach;
        return $result;
    }

    private function lerArquivo($arquivo)
	{
		$JSON = stream_get_contents(fopen($arquivo, 'r'));
		return (object) json_decode(utf8_encode($JSON));
	}

	private function importarArquivo($json,$nome_arquivo)
	{
		// percorre os campos do banco de dados e verifica 
		// quais tabelas tem registros no json com o mesmo nome
		// que ela
		try
		{
			$tabelas_importadas = array();
			$dados_insert = array();
			DB::connection()->disableQueryLog();
			DB::beginTransaction();
			foreach ($json as $json_tabela => $rows):
				foreach ($rows as $row):
					if(isset($this->tabelas[$json_tabela])):
						$row = (array) $row;
						if(count(DB::table($json_tabela)
							->where('tenant_id','=',$this->tenant_id)
							->where('codigo','=',$row['codigo'])->first())>0)
						:
							DB::table($json_tabela)
							->where('tenant_id','=',$this->tenant_id)
							->where('codigo','=',$row['codigo'])
							->update($row);
							$this->qtde_updates++;
						else:			
							$row['tenant_id'] = $this->tenant_id;
							array_push($dados_insert,$row);
						endif;						
					endif;
				endforeach;

				$collection = collect($dados_insert);
				$chunks = $collection->chunk(100);
				$chunks->toArray();
				$qtde_inserts = 0;$qtde_updates=0;
				foreach ($chunks as $chunk):
					DB::table($json_tabela)->insert($chunk->toArray());
				endforeach;
				$this->qtde_inserts = count($dados_insert);
			endforeach;
			DB::commit();
			$this->makeImportacoes(['qtde_inserts'=>$this->qtde_inserts,'qtde_updates'=>$this->qtde_updates,'arquivo'=>$nome_arquivo]);
			return true;
		}
		catch(\Exception $e)
		{
			db::rollback();
			echo $e->getMessage();
			return false;
		}
	}

	private function makeImportacoes($array = [])
	{
		$imp = new Importacoes();
		$imp->qtde_inserts=$array['qtde_inserts']; 
		$imp->qtde_updates=$array['qtde_updates']; 
		$imp->arquivo=$array['arquivo']; 
		$imp->tenant_id=$this->tenant_id; 
		$imp->usuario_id=$this->usuario_id; 
		$imp->save();
	}

	private function getoperacao($tabela,$codigo)
	{
		if(count(DB::table($tabela)->where('codigo','=',$codigo)->where('tenant_id','=',$this->tenant_id)->get())>0)
			return "UPDATE";
		else
			return "INSERT";
	}

	private function query_firebird($sql)
    {
    	$conexao = $this->conectar_firebird();
    	$sth = $conexao->query($sql);
		return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    private function conectar_firebird($usuario="CAIXA",$senha="caixa")
    {
    	$banco_de_dados = "C://Aliveit//bd//DBUNIAO.DB";
    	$str_conn="firebird:host=localhost;dbname={$banco_de_dados};charset=UTF8";
		return $db = new PDO($str_conn, $usuario, $senha);
    }

    public function getCriarjson($tabela)
    {
    	switch ($tabela) 
    	{
    		case 'produtos':
    			$this->exemplo_json_produtos();
    			break;
    		case 'gruposprodutos':
    			$this->exemplo_json_gruposprodutos();
    			break;
    		case 'tiposprodutos':
    			$this->exemplo_json_tiposprodutos();
    			break;
    		default:
    			# code...
    			break;
    	}
    }

    private function exemplo_json_produtos()
    {
    	$consulta = $this->query_firebird("select * from produtos");	
    	$json['produtos'] = array();
    	foreach ($consulta as $row):
    		 array_push($json['produtos'],[
    		 		'codigo'         =>   $row['CODIGO'],
    		 		'codigobarras'   =>   $row['CODIGOBARRAS'],
    		 		'descricao'      =>   $row['DESCRICAO'],
    		 		'nome'           =>   $row['NOMEFANTASIA'],
    		 		'unidade'        =>   $row['UNIDADE'],
    		 		'unidadeentrada' =>   $row['UNIDADEENTRADA'],
    		 		'cst_entrada'    =>   $row['CODIGO_STENTRADA'],
    		 		'tipoproduto'    =>   $row['TIPOPRODUTO'],
    		 		'cst_saida'      =>   $row['CODIGO_ST'],
    		 		'estoque'        =>   $row['ESTOQUE'],
    		 		'precovenda'     =>   $row['PRECOVENDA'],
    		 		'custoatual'     =>   $row['CUSTOATUAL'],
    		 		'grupoproduto_codigo' =>  $row['CODIGO_GRUPOPRODUTO'],
    		 		'tipoproduto_codigo'  =>  $row['CODIGO_TIPOPRODUTO'],
    		 		'ncm'            =>  $row['CODIGO_NBMSH'],
    		 		'anp'            =>  $row['CODIGOANP'],
    		 		'cest'           =>  $row['CODIGO_CEST'],
    		 		'ultimavenda'    =>  $row['ULTIMAVENDA']
    		 	]);
    	endforeach;
		echo json_encode($json);
    }
    private function exemplo_json_gruposprodutos()
    {
    	$consulta = $this->query_firebird("select * from gruposprodutos");	
    	$json['gruposprodutos'] = array();
    	foreach ($consulta as $row):
    		 array_push($json['gruposprodutos'],[
    		 		'codigo'         =>   $row['CODIGO'],
    		 		'descricao'      =>   $row['DESCRICAO']
    		 	]);
    	endforeach;
		echo json_encode($json);
    }
    private function exemplo_json_tiposprodutos()
    {
    	$consulta = $this->query_firebird("select * from tiposprodutos");	
    	$json['tiposprodutos'] = array();
    	foreach ($consulta as $row):
    		 array_push($json['tiposprodutos'],[
    		 		'codigo'         =>   $row['NUMERO'],
    		 		'descricao'      =>   $row['DESCRICAO']
    		 	]);
    	endforeach;
		echo json_encode($json);
    }


}
