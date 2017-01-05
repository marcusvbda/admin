<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class relatoriosController extends controller
{


	public function __construct()
	{
		// 
	}

	public function getIndex()
	{
		redirecionar(asset('erros/404'));
	}

	public function getTributacoes_codigos()
	{
		echo $this->view('relatorios.tributacoes_codigos');
	}

	public function postTributacoes_codigos()
	{
		$_POST = Request::get('POST');
		$sql = "select p.*,pe.*, gp.descricao as grupo_produto from produtos p 
		join produto_empresa pe on pe.codigo_produto=p.codigo 
		join gruposprodutos gp on p.codigo_grupoproduto=gp.codigo 
		where 1=1 ";
		$ncm = null;
		$anp = null;
		$cest = null;
		$cst_ent = null;
		$cst_saida = null;


		if (isset($_POST['ncm'])):
			$ncm = $_POST['ncm'];
			if(uppertrim($ncm)!="")
				$sql .= " and p.codigo_nbmsh = '{$ncm}'";
		endif;

		if (isset($_POST['anp'])):
			$anp = $_POST['anp'];
			if(uppertrim($anp)!="")			
				$sql .= " and p.codigoanp = '{$anp}' ";
		endif;

		if (isset($_POST['cest'])):
			$cest = $_POST['cest'];
			if(uppertrim($cest)!="")		
				$sql .= " and p.codigo_cest = '{$cest}'";
		endif;

		if (isset($_POST['CST_entrada'])):
			$cst_ent = $_POST['CST_entrada'];
			if(uppertrim($cst_ent)!="")	
				$sql .= " and p.codigo_stentrada = '{$cst_ent}'";
		endif;

		if (isset($_POST['CST_saida'])):
			$cst_saida = $_POST['CST_saida'];
			if(uppertrim($cst_saida)!="")	
				$sql .= " and p.codigo_st = '{$cst_saida}'";
		endif;

		$sql .= " order by gp.descricao";
		$produtos = query($sql);

		echo $this->view('relatorios.tributacoes_codigos',compact('produtos','cest','ncm','anp','cst','cst_saida','cst_ent'));
	}

}


