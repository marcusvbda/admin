<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class caixasController extends controller
{

	public function getIndex()
	{
		$ultimo_caixa = $this->getUltimoCaixa();
		$data_fim = string_to_date($ultimo_caixa->dataabertura);
		$data_inicio = string_to_date($ultimo_caixa->dataabertura,"-10");
		$caixas = query("select * FROM caixa WHERE STR_TO_DATE(dataabertura, '%d/%m/%Y') >= date('".$data_inicio."') and
		STR_TO_DATE(dataabertura, '%d/%m/%Y') <= date('".$data_fim."') order by numero");
		echo $this->view('caixas.index',compact('caixas','data_inicio','data_fim'));	
	}

	public function postIndex()
	{
		$ultimo_caixa = $this->getUltimoCaixa();
		if(!$_POST['data_fim'])
			$data_fim = string_to_date($ultimo_caixa->dataabertura);
		else
			$data_fim = $_POST['data_fim'];

		if(!$_POST['data_inicio'])
			$data_inicio = string_to_date($ultimo_caixa->dataabertura,"-10");
		else
			$data_inicio = $_POST['data_inicio'];

		 $caixas = query("select * FROM caixa WHERE STR_TO_DATE(dataabertura, '%d/%m/%Y') >= date('".$data_inicio."') and
		 STR_TO_DATE(dataabertura, '%d/%m/%Y') <= date('".$data_fim."') order by numero");
		 echo $this->view('caixas.index',compact('caixas','data_inicio','data_fim'));	
	}


	public function getCaixa_especifico($id)
	{
		$caixa = query("select * from caixa where sequencia=".$id);
		$caixa = $caixa[0];
		echo json_encode($caixa);
	}

	private function getUltimoCaixa()
	{
		$ultimo_caixa = query("select * from caixa where id=(select max(id) as id from caixa)");
		return $ultimo_caixa=$ultimo_caixa[0];
	}

	public function getShow($id)
	{
		$caixa = query("select * from caixa where id={$id}",true);
		if(is_null($caixa))
			redirecionar(asset('erros/404'));

		$dias_permanencia = dif_datas($caixa->dataabertura,$caixa->datafechamento);
		$horas_permanencia = dif_horas($caixa->horafechamento,$caixa->horaabertura);
		echo $this->view('caixas.show',compact('caixa','dias_permanencia','horas_permanencia'));		
	}
}

