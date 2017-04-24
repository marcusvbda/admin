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
    protected $diretorio_importar = '/upload/importar/';
	protected $diretorio_importados = '/upload/importados/';
	protected $arq_importar= null;
	protected $tabelas = null;
	protected $tenant_id = null;
	protected $usuario_id = null;
	protected $qtde_updates = 0;
	protected $qtde_inserts = 0;

  	public function getIndex()
  	{          
        ini_set('max_execution_time', 280); //3 minutes
  		$this->ImportarArquivos();
    }

    public function getReset()
    {
        DB::table('abastecimentos')->truncate();
        DB::table('importacoes')->truncate();
        DB::table('produtos')->truncate();
        DB::table('gruposprodutos')->truncate();
        DB::table('tiposprodutos')->truncate();
        DB::table('tanque')->truncate();
        DB::table('bomba')->truncate();
        DB::table('caixa')->truncate();
        DB::table('dadosfaturamento')->truncate();
        return Redirect::to('admin/import');
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
                    if(uppertrim(substr($arquivo,strlen($arquivo)-5,strlen($arquivo)))=='.JSON'):
    	      			$this->qtde_inserts=0;$this->qtde_updates=0;
    	  				if($this->importarArquivo($this->lerArquivo(public_path().$this->diretorio_importar.$arquivo),$arquivo)):
                            $this->mover($arquivo);
                            header("Refresh: 0;"); 
                        endif;
                    endif;
	      		endforeach;
	      	endif;
	      	return true;
	    // }
	    // catch(\Exception $e)
	    // {
	    //  	return false;
	    // }
    }

    private function mover($arquivo)
    {
        copy(public_path().$this->diretorio_importar.$arquivo, public_path().$this->diretorio_importados.$arquivo);
        unlink(public_path().$this->diretorio_importar.$arquivo);
    }

    private function existeArquivos()
	{
	   	$this->arq_importar = scandir(public_path().$this->diretorio_importar);
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
    	$banco_de_dados = "C://Aliveit//bd//DBMASTERSELSC.DB";
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
            case 'tanque':
                $this->exemplo_json_tanque();
                break;
            case 'bomba':
                $this->exemplo_json_bomba();
                break;
            case 'abastecimentos':
                $this->exemplo_json_abastecimentos();
                break;
            case 'caixa':
                $this->exemplo_json_caixa();
                break;
            case 'dadosfaturamento':
                $this->exemplo_json_dadosfaturamento();
                break;
            case 'manutencaocaixa':
                $this->exemplo_json_manutencaocaixa();
                break;
            case 'funcionarios':
                $this->exemplo_json_funcionarios();
                break;
            case 'gruposprodutos':
                $this->exemplo_json_gruposprodutos();
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
    private function exemplo_json_tanque()
    {
        $consulta = $this->query_firebird("select * from tanque");   
        $json['tanque'] = array();
        foreach ($consulta as $row):
             array_push($json['tanque'],[
                    'codigo'         =>   $row['ID'],
                    'numero'         =>   $row['NUMERO'],
                    'capacidade'     =>   $row['CAPACIDADE'],
                    'volumeatual'    =>   $row['VOLUMEATUAL'],
                    'produto_codigo' =>   $row['NUMERO_PRODUTO']
                ]);
        endforeach;
        echo json_encode($json);
    }
    private function exemplo_json_bomba()
    {
        $consulta = $this->query_firebird("select * from bomba");  
        $json['bomba'] = array();
        foreach ($consulta as $row):
             array_push($json['bomba'],[
                    'codigo'         =>   $row['ID'],
                    'numero'         =>   $row['NUMERO'],
                    'tanque_codigo'  =>   $row['ID_TANQUE'],
                    'bomba'          =>   $row['BOMBA'],
                    'encerrante'     =>   $row['ENCERRANTEATUAL']
                ]);
        endforeach;
        echo json_encode($json);
    }
    private function exemplo_json_abastecimentos()
    {
        $consulta = $this->query_firebird("select * from abastecimentos");  
        $json['abastecimentos'] = array();
        foreach ($consulta as $row):
             array_push($json['abastecimentos'],[
                    'registro'       =>   $row['REGISTRO'],
                    'codigo'         =>   $row['ID'],
                    'bomba_codigo'   =>   $row['ID_BOMBA'],
                    'caixa_codigo'   =>   $row['ID_CAIXA'],
                    'total_dinheiro' =>   $row['TOTALDINHEIRO'],
                    'total_litros'   =>   $row['TOTALLITROS'],
                    'preco'          =>   $row['PRECOUNITARIO'],
                    'data'           =>   $row['DATAABASTECIMENTO'],
                    'hora'           =>   $row['HORAABASTECIMENTO']
                ]);
        endforeach;
        echo json_encode($json);
    }
    private function exemplo_json_caixa()
    {
        $consulta = $this->query_firebird("select * from caixa");  
        $json['caixa'] = array();
        foreach ($consulta as $row):
             array_push($json['caixa'],[
                    'codigo'           =>   $row['ID'],
                    'numero'           =>   $row['NUMERO'],
                    'funcionario'      =>   $row['NOME_FUNCIONARIO'],
                    'situacao'         =>   $row['SITUACAO'],
                    'valor_inicial'    =>   $row['VALORINICIAL'],
                    'data_abertura'    =>   $row['DATAABERTURA'],
                    'hora_abertura'    =>   $row['HORAABERTURA'],
                    'data_fechamento'  =>   $row['DATAFECHAMENTO'],
                    'hora_fechamento'  =>   $row['HORAFECHAMENTO']
                ]);
        endforeach;
        echo json_encode($json);
    }

    private function exemplo_json_dadosfaturamento()
    {
        $consulta = $this->query_firebird("select * from dadosfaturamento");  
        $json['dadosfaturamento'] = array();
        foreach ($consulta as $row):
             array_push($json['dadosfaturamento'],[
                    'codigo'            =>    $row['ID'],
                    'produto_codigo'    =>    $row['NUMERO_PRODUTO'],
                    'valorproduto'      =>    $row['VALORPRODUTO'],
                    'datanegociacao'    =>    $row['DATANEGOCIACAO'],
                    'hora'              =>    $row['HORA'],
                    'quantidade'        =>    $row['QUANTIDADE'],
                    'valorunitario'     =>    $row['VALORUNITARIO'],
                    'motorista'         =>    $row['MOTORISTA'],
                    'placa'             =>    $row['PLACA'],
                    'numeronota'        =>    $row['NUMERONOTA'],
                    'emissao'           =>    $row['EMISSAO'],
                    'caixa_codigo'      =>    $row['ID_CAIXA'],
                    'excluido'          =>    $row['EXCLUIDO'],
                    'nomecliente'       =>    $row['NOME_CLIENTE'],
                    'datacancelamento'  =>    $row['DATACANCELAMENTO'],
                    'valordesconto'     =>    $row['VALORDESCONTO'],
                    'valoracrescimo'    =>    $row['VALORACRESCIMO'],
                    'valortotalcupom'   =>    $row['VALORTOTALCUPOM']
                ]);
        endforeach;
        echo json_encode($json);
    }

    private function exemplo_json_manutencaocaixa()
    {
        $consulta = $this->query_firebird("select * from manutencaocaixa where excluido='N' ");  
        $json['manutencaocaixa'] = array();
        foreach ($consulta as $row):
             array_push($json['manutencaocaixa'],[
                    'codigo'     =>    $row['ID'],
                    'caixa_codigo'   =>    $row['ID_CAIXA'],
                    'tipo'       =>    $row['TIPO'],
                    'documento'  =>    $row['DOCUMENTO'],
                    'data'       =>    $row['DATALANCAMENTO'],
                    'hora'       =>    $row['HORA'],
                    'funcionario_codigo'   =>    $row['NUMERO_FUNCIONARIO'],
                    'descricao'   =>    $row['DESCRICAO'],
                    'classificacao'   =>    $row['CLASSIFICACAO'],
                    'valor'       =>    $row['VALOR']
                ]);
        endforeach;
        echo json_encode($json);
    }

    private function exemplo_json_funcionarios()
    {
        $consulta = $this->query_firebird("select * from funcionarios");  
        $json['funcionarios'] = array();
        foreach ($consulta as $row):
             array_push($json['funcionarios'],[
                    'codigo'   =>    $row['NUMERO'],
                    'nome'     =>    $row['NOME'],
                    'usuario'  =>    $row['USUARIO']
                ]);
        endforeach;
        echo json_encode($json);
    }

    
}
