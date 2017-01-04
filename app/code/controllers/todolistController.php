<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class todolistController extends controller
{

	public function __construct()
	{
		// 
	}

	public function getAfazeres()
	{
		$afazeres = query('select * from TodoList where excluido="N" and usuario ='.Auth('id'));
		if(count($afazeres)>0)
			$porcentagem =((count(query('select * from TodoList where excluido="N" and feito="S" and usuario ='.Auth('id')))*100)/count($afazeres));
		else
			$porcentagem = 0;
		$porcentagem = round($porcentagem,2);
		echo json_encode(compact('afazeres','porcentagem'));
	}

	public function postFeito()
	{
		$_POST = Request::get('POST',false);
		$id = $_POST['id'];
		$afazer = DB::table('TodoList')->find($id);
		$feito = "S";
		if($afazer->feito=="S")
			$feito="N";
		query("update TodoList set feito='{$feito}' where id=".$id);
	}	

	public function postAlterar()
	{
		$_POST = Request::get('POST',false);
		$id = $_POST['id'];
		$descricao = $_POST['descricao'];
		query("update TodoList set descricao='{$descricao}' where id=".$id);
	}	

	public function postExcluir()
	{
		$_POST = Request::get('POST',false);
		$id = $_POST['id'];		
		$afazer = DB::table('TodoList')->find($id);		
		query("update TodoList set excluido='S' where id=".$id);
	}	

	public function postNovo()
	{
		$_POST = Request::get('POST',false);
		$descricao = $_POST['descricao'];
		$usuario = Auth('id');
		query("insert into TodoList(descricao,usuario) values('{$descricao}','$usuario')");
	}
	
	
}



		