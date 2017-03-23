<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Response;
use Redirect;
use Session;
use Input;
use App\Pessoas;
use App\Contatos;

class personsController  extends Controller
{
	private function rules()
  	{
  		return 	[
			        'nome'    => 'required|max:150',     
			        'razao'   => 'max:150',     
			        'CPF_CNPJ'=> 'max:25',     
			        'email'	  => 'email|max:250',     
    			];
  	}
  	private function messsages()
  	{
  		return 	[
			        'nome.required'   =>'O campo nome não deve ser em branco',
	        		'nome.max'        =>'O campo nome deve ter no máximo 150 letras',
	        		'CPF_CNPJ.max'    =>'O campo CPF/CNPJ deve ter no máximo 25 letras',
	        		'email.max'       =>'O campo email deve ter no máximo 250 letras',
	        		'email.email'     =>'O campo email deve ser preenchido com um email válido',
    			];
  	}

	private function validatipo($tipo)
	{
		if((uppertrim($tipo)!="CLIENTES")&&(uppertrim($tipo)!="FORNECEDORES")):
			echo erro(404);
			exit;
		endif;
	}

	public function index($tipo)
	{
		if(cannot('pessoas','get'))
			return erro(505);

		$this->validatipo($tipo);
		$classificacao =  uppertrim(substr($tipo,0,1));
		$ativo = "A";
		switch ($classificacao) 
		{
			case 'F':
    			$pessoas = Pessoas::where('classificacao','=',$classificacao)->where('ativo','=', 'S')->where('nome','!=', 'FORNECEDOR')->get();	
				break;
			case 'C':
    			$pessoas = Pessoas::where('classificacao','=',$classificacao)->where('ativo','=', 'S')->where('nome','!=', 'CLIENTE')->get();	
		}
		return view('painel.pessoas.index',compact('pessoas','ativo','tipo'));
	}


	public function postindex($tipo)
	{
		if(cannot('pessoas','get'))
			return erro(505);
		$this->validatipo($tipo);			
		$classificacao = uppertrim(substr($tipo,0,1));
		$ativo = Input::all()['mostrar'];
		$pessoas = [];
		$padrao = null;
		switch ($classificacao) 
		{
			case 'F':
    			$padrao ='FORNECEDOR';	
				break;
			case 'C':
    			$padrao = 'CLIENTE';	
		}
		if($ativo=="A")
    		$pessoas = Pessoas::where('classificacao','=',$classificacao)->where('ativo','=','S')->where('nome','!=', $padrao)->get();	
    	else if($ativo=="T")
    		$pessoas = Pessoas::where('classificacao','=',$classificacao)->where('nome','!=', $padrao)->get();	
    	else if($ativo=="I")
    		$pessoas = Pessoas::where('classificacao','=',$classificacao)->where('nome','!=', $padrao)->where('ativo','=','N')->get();	
		return view('painel.pessoas.index',compact('pessoas','ativo','tipo'));
	}

	public function show($tipo, $id)
	{	
		if(cannot('pessoas','get'))
			return erro(505);

		$id = base64_decode($id);
		$this->validatipo($tipo);
		$classificacao =  uppertrim(substr($tipo,0,1));
    	$pessoa = Pessoas::where('id','=',$id)->where('classificacao','=',$classificacao)->first();
    	if(count($pessoa)<=0)
    		return erro(404);

    	$contatos = Contatos::where('pessoa_id','=',$pessoa->id)->get();
		return view('painel.pessoas.show',compact('pessoa','contatos','tipo'));
	}

	public function create($tipo)
	{
		if(cannot('pessoas','post'))
			return erro(505);

		$id=null;
		if(isset(Input::all()['id']))
			$id = Input::all()['id'];
		$pessoa = Pessoas::find($id);
		$this->validatipo($tipo);
		$classificacao =  uppertrim(substr($tipo,0,1));		
		return view('painel.pessoas.create',compact('tipo','classificacao','pessoa'));
	}

	public function store()
	{
		try
		{
			if(cannot('pessoas','get'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);

			$dados = Input::all();			
		   	$erros =  Validator::make($dados, $this->rules(), $this->messsages());	    
	    	if ($erros->fails()) 
				return Response::json(['success'=>false,'msg'=>implode ('
				', $erros->errors()->all() )]);
	    	else
	    	{
				DB::beginTransaction();		
				$pessoa = Pessoas::create($dados);
				switch ($pessoa->classificacao) 
				{
					case 'F':
						historico([
				        "titulo"     =>  "Cadastrou um fornecedor",
				        "descricao"  =>  "Cadastrou o fornecedor '".$pessoa->nome."'",
				        "tipo"       =>  $pessoa->classificacao,
				        "ref_id"     =>  $pessoa->id
				    	]);
						break;
					case 'C':
						historico([
				        "titulo"     =>  "Cadastrou um cliente",
				        "descricao"  =>  "Cadastrou o cliente '".$pessoa->nome."'",
				        "tipo"       =>  $pessoa->classificacao,
				        "ref_id"     =>  $pessoa->id
				    	]);
						break;
				}
				DB::commit();		
	    		return Response::json(['success'=>true,'msg'=>'Cadastrado com Sucesso!!','codigo'=>base64_encode($pessoa->id)]);
	    	}
					
		}
		catch(\Exception $e)
		{
			DB::rollback();			
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}

	public function storecontatos()
	{
		try
		{
			if(cannot('pessoas','post'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);

			$dados = Input::all();
			$dados['codigo']=$this->getNovoCodigoContato($dados['pessoa_id']);
			$dados['tenant_id']=Auth::user()->tenant_id;
			DB::beginTransaction();	
			db::table('contatos')->insert($dados);
			DB::commit();	
			return Response::json(["success"=>true,"msg"=>"Cadastrado com sucesso !!!"]);			
		}
		catch(\Exception $e)
		{
			DB::rollback();			
			return Response::json(["success"=>false,"msg"=>$e->errorInfo[2]]);	
		}
	}

	public function edit()
	{
		try
		{
			if(cannot('pessoas','put'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);

			$dados = Input::all();
			$id = $dados['id'];
			$erros =  Validator::make($dados, $this->rules(), $this->messsages());	    
	    	if ($erros->fails()) 
				return Response::json(['success'=>false,'msg'=>implode ('
				', $erros->errors()->all() )]);
	    	else
	    	{
	    		DB::beginTransaction();		
	    		$pessoa = Pessoas::find($id);
				Pessoas::where('id','=',$pessoa->id)->update($dados);
				DB::commit();	
				switch ($pessoa->classificacao) 
				{
					case 'C':
						historico([
					        "titulo"     =>  "Alterou um cliente ",
					        "descricao"  =>  "Alterou o cliente '".$pessoa->nome."'",
					        "tipo"       =>  $pessoa->classificacao,
					        "ref_id"     =>  $pessoa->id
						]);
						break;
					case 'F':
						historico([
					        "titulo"     =>  "Alterou um fornecedor ",
					        "descricao"  =>  "Alterou o fornecedor '".$pessoa->nome."'",
					        "tipo"       =>  $pessoa->classificacao,
					        "ref_id"     =>  $pessoa->id
						]);
						break;
				}
				
	    		return Response::json(['success'=>true,'msg'=>'Editado com Sucesso!!','id'=>$pessoa->id]);
	    	}
		}
		catch(\Exception $e)
		{
			DB::rollback();			
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}

	public function bloquear()
	{
		try
		{
			if(cannot('pessoas','put'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);
	    	DB::beginTransaction();	

			$dados = Input::all();			
			foreach ($dados['selecionados'] as $id):
				$pessoa = Pessoas::find($id);
				if($pessoa->bloqueado=="S")
				{
					Pessoas::where('id','=',$pessoa->id)->update(['bloqueado'=>'N']);
					switch ($pessoa->classificacao) 
					{
						case 'C':
							historico([
						        "titulo"     =>  "Desbloqueou um cliente ",
						        "descricao"  =>  "Desbloqueou o cliente '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
						case 'F':
							historico([
						        "titulo"     =>  "Bloqueou um fornecedor ",
						        "descricao"  =>  "Bloqueou o fornecedor '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
					}
					
				}
				else
				{
					Pessoas::where('id','=',$id)->update(['bloqueado'=>'S']);
					switch ($pessoa->classificacao) 
					{
						case 'C':
							historico([
						        "titulo"     =>  "Bloqueou um cliente ",
						        "descricao"  =>  "Bloqueou o cliente '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
						case 'F':
							historico([
						        "titulo"     =>  "Bloqueou um fornecedor ",
						        "descricao"  =>  "Bloqueou o fornecedor '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
					}
				}
			endforeach;
	    	DB::commit();	

			return Response::json(["success"=>true,"msg"=>"Bloqueado/Desbloqueado com sucesso"]);
		}
		catch(\Exception $e)
		{
	    	DB::rollback();		
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}  

	public function ativar()
	{
		try
		{
			if(cannot('pessoas','put'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);
	    	DB::beginTransaction();	

			$dados = Input::all();			
			foreach ($dados['selecionados'] as $id):
				$pessoa = Pessoas::find($id);
				if($pessoa->ativo=="S")
				{
					Pessoas::where('id','=',$pessoa->id)->update(['ativo'=>'N']);
					switch ($pessoa->classificacao) 
					{
						case 'C':
							historico([
						        "titulo"     =>  "Inativou um cliente ",
						        "descricao"  =>  "Inativou o cliente '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
						case 'F':
							historico([
						        "titulo"     =>  "Desativou um fornecedor ",
						        "descricao"  =>  "Desativou o fornecedor '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
					}
					
				}
				else
				{
					Pessoas::where('id','=',$id)->update(['ativo'=>'S']);
					switch ($pessoa->classificacao) 
					{
						case 'C':
							historico([
						        "titulo"     =>  "Ativou um cliente ",
						        "descricao"  =>  "Ativou o cliente '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
						case 'F':
							historico([
						        "titulo"     =>  "Ativou um fornecedor ",
						        "descricao"  =>  "Ativou o fornecedor '".$pessoa->nome."'",
						        "tipo"       =>  $pessoa->classificacao,
						        "ref_id"     =>  $pessoa->id
							]);
							break;
					}
				}
			endforeach;
			db::commit();
			return Response::json(["success"=>true,"msg"=>"Ativado/Desativado com sucesso"]);
		}
		catch(\Exception $e)
		{
			db::rollback();
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}  

	public function excluir()
	{
		try
		{
			if(cannot('pessoas','delete'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);

			$dados = Input::all();
			db::beginTransaction();
			db::table('contatos')->whereIn('pessoa_id',$dados['selecionados'])->delete();
			Pessoas::whereIn('id',$dados['selecionados'])->delete();
			db::commit();
			resetAutoInc('pessoas');
			
			// historico

			return Response::json(['success'=>true,'msg'=>"Excluido com sucesso !!!"]);
		}
		catch(\Exception $e)
		{
			DB::rollBack();	
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}

	public function contatosdestroy()
	{
		try
		{
			if(cannot('pessoas','delete'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);

			$dados = Input::all();
			db::beginTransaction();
			db::table('contatos')->whereIn('id',$dados['contatos_selecionados'])->delete();
			db::commit();
			resetAutoInc('contatos');
			return Response::json(['success'=>true,'msg'=>"Excluido com sucesso !!!"]);
		}
		catch(\Exception $e)
		{
			DB::rollBack();	
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}

	public function getContato($id)
	{
		return Response::json(db::table('contatos')->find($id));
	}

	public function contatosedit()
	{
		try
		{
			if(cannot('pessoas','put'))
				return Response::json(['success'=>false,'msg'=>'Você não tem permissão para esta operação !!!']);
			
			$dados = Input::all();
			db::beginTransaction();
			db::table('contatos')->where('id','=',$dados['id'])->update($dados);
			db::commit();
			return Response::json(['success'=>true,'msg'=>'Editado com sucesso !!!']);
		}
		catch(\Exception $e)
		{
			DB::rollBack();	
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}
}	
