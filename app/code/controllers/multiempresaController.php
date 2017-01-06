<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class multiempresaController extends controller
{
		
	function __construct()
	{
		if(auth('admin_rede')!="S")
			Route::direcionar(asset('erros/SEM_PERMISSAO'));
	}

    public function union($sql)
    {
    	$resultado = "";
		for ($i=0; $i < count($emp_selec = auth('empresa_selecionada')); $i++):
			$sql = str_replace('__TABELA__', __PREFIXO_BANCO__.$emp_selec[$i] , $sql);
			if(($i<=count($emp_selec)-1)&&($i!=0))
    			$resultado.=' union '.$sql;
    		else
    			$resultado.=$sql;    			
		endfor;
    	return $resultado;
    }

	public function getAbastecimentos()
	{	

		$de           = query(multiempresaController::union("select max(dataabastecimento) as data from __TABELA__.abastecimentos"),"data");
		$ate = $de;
		$combustiveis = query(multiempresaController::union("select * from produtos WHERE __TABELA__.produtos.tipoproduto='C'"));
		$bombas       = query(multiempresaController::union("select bomba from __TABELA__.bomba group by bomba"));
		$bicos        = query(multiempresaController::union("select * from __TABELA__.bomba"));
		$bomba = 0;
		$bico= 0;
		$combustivel = 0 ;

		foreach (auth('empresa_selecionada') as $empresa):
			$banco_de_dados = 'db_admin_'.$empresa;
			$razao_empresa = query("select * from db_admin_usuarios.empresas where serie={$empresa}",'razao');

			$abastecimentos{$empresa} = query("select 
										a.*,
										DATE_FORMAT(a.dataabastecimento, '%d/%m/%Y') as data_formatada,
										p.descricao as combustivel,
										'{$empresa}' as serie_empresa,
										'{$razao_empresa}' as razao_empresa
									from 
										{$banco_de_dados}.abastecimentos a
										left join {$banco_de_dados}.bomba b on b.id = a.id_bomba
										left join {$banco_de_dados}.tanque t on t.id=b.id_tanque
										left join {$banco_de_dados}.produtos p on t.numero_produto=p.codigo
									where 
		                            a.dataabastecimento BETWEEN '{$de}' and '{$ate}'		                            
									order by a.registro desc");	
		endforeach;
		$resultado = array();
		foreach (auth('empresa_selecionada') as $empresa):
			$resultado = array_merge($resultado,$abastecimentos{$empresa});
		endforeach;
		$abastecimentos = $resultado;

		echo $this->view('multiempresa.abastecimentos',compact('combustiveis','combustivel','abastecimentos','de','ate'));
	}

	public function postAbastecimentos()
	{	
		$_POST = Request::get('POST');

		$combustiveis = query(multiempresaController::union("select * from produtos WHERE __TABELA__.produtos.tipoproduto='C'"));
		$combustivel = $_POST['combustivel'];

		$de = $_POST['de'];
		$ate = $_POST['ate'];

		foreach (auth('empresa_selecionada') as $empresa):
			$banco_de_dados = 'db_admin_'.$empresa;
			$razao_empresa = query("select * from db_admin_usuarios.empresas where serie={$empresa}",'razao');

							$sql=   "select 
										a.*,
										DATE_FORMAT(a.dataabastecimento, '%d/%m/%Y') as data_formatada,
										p.descricao as combustivel,
										'{$empresa}' as serie_empresa,
										'{$razao_empresa}' as razao_empresa
									from 
										{$banco_de_dados}.abastecimentos a
										left join {$banco_de_dados}.bomba b on b.id = a.id_bomba
										left join {$banco_de_dados}.tanque t on t.id=b.id_tanque
										left join {$banco_de_dados}.produtos p on t.numero_produto=p.codigo
									where 
		                            a.dataabastecimento BETWEEN '{$de}' and '{$ate}'";

	
			if($combustivel != 0)
				$sql.=" and t.numero_produto = {$combustivel} ";
			                            
			$sql .="order by a.registro desc";
			$abastecimentos{$empresa}  = query($sql);
		endforeach;
		$resultado = array();
		foreach (auth('empresa_selecionada') as $empresa):
			$resultado = array_merge($resultado,$abastecimentos{$empresa});
		endforeach;
		$abastecimentos = $resultado;

		echo $this->view('multiempresa.abastecimentos',compact('combustiveis','abastecimentos','de','ate','combustivel','combustivel_nome'));
	}
}

