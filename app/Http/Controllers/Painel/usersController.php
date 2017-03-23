<?php
namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Response;
use Redirect;
use Session;
use Input;
use App\User;
use App\Temas;
use App\Cor_profile;
use App\Funcoes;
use App\Acl\Modulos;
use App\Acl\GruposAcesso;
use App\Acl\Permissoes;
use App\Acl\Acl;

class UsersController extends Controller
{
  	public function getIndex()
	{
		if(cannot('usuarios','get'))
			return erro(505);
		$ativo = "A";
    	$usuarios = user::Tenant()->where('ativo','=','S')->get();		
		return view('painel.usuarios.index',compact('usuarios','ativo'));
	}

	public function postIndex()
	{
		if(cannot('usuarios','get'))
			return erro(505);
		$ativo = Input::all()['mostrar'];
		$usuarios = [];
		if($ativo=="A")
    		$usuarios = User::Tenant()->where('ativo','=','S')->get();	
    	else if($ativo=="T")
    		$usuarios = User::Tenant()->get();	
    	else if($ativo=="I")
    		$usuarios = User::Tenant()->where('ativo','=','N')->get();
		return view('painel.usuarios.index',compact('usuarios','ativo'));
	}


    public function getShow($id)
    {
    	if(  ($id!=Auth::user()->id)&&(cannot('usuarios','get')  ))
			return erro(505);

    	$id = base64_decode($id);
        $usuario = User::search($id)->first();
        if(count($usuario)<=0)
        	return erro(404);

		$funcoes  =  Funcoes::get();
		$cores    =  Cor_Profile::get();
		$grupos   =  GruposAcesso::get();

        return view('painel.usuarios.profile', compact('usuario','funcoes','cores','grupos'));
    }

    public function getCreate()
    {
    	if(cannot('usuarios','post'))
			return erro(505);

		$funcoes =  Funcoes::get();
		$grupos  =  GruposAcesso::get();
		$cores   =  Cor_Profile::get();

    	return view('painel.usuarios.create',compact('cores','funcoes','grupos'));
    }

    public function postStore()
	{
		$rules= [
			        'nome'          => 'required|max:150',     
			        'sobrenome'     => 'max:200',   
			        'dt_nascimento' => 'required|date',   
			        'senha'         => 'required|max:15',
			        'email'         => 'required|max:250|email|unique:usuarios',
	   			];
    	$messsages=
    			[
			        'nome.required'      =>'O campo nome não deve ser em branco',
			        'nome.max'           =>'O campo nome não deve ter mais do que 150 caracteres',
			        'email.required'     =>'O campo email não deve ser em branco',
			        'email.max'          =>'O campo email não deve ter mais do que 250 caracteres',
			        'email.email'        =>'O email preenchido não é um endereço de email válido',
			        'sobrenome.required' =>'O campo sobrenome não deve ser em branco',
			        'sobrenome.max'      =>'O campo sobrenome não deve ter mais do que 200 caracteres',
			        'dt_nascimento.date' =>'Data de nascimento inválida',
			        'dt_nascimento.required'=>'Data de nascimento é um campo obrigatório',
			        'usuario.required'   =>'O campo usuário não deve ser em branco',			       
			        'email.unique'       =>'Este email já está cadastrado em outro usuário',
			        'senha.required'     =>'O campo senha não deve ser em branco',
			        'senha.max'          =>'O campo senha não deve ter mais do que 200 caracteres'

    			];
		try
		{
			if(cannot('usuarios','post'))
				return Response::json(['success'=>false,'msg'=>'Você não ter permissão para esta operação']);	

	    	$dados = Input::all();	
			$erros =  Validator::make($dados, $rules, $messsages);	    
	    	if ($erros->fails()) 
				return Response::json(['success'=>false,'msg'=>implode ('
				', $erros->errors()->all() )]);
	    	else
	    	{
	    		$dados['senha'] = md5($dados['senha']);
				DB::beginTransaction();

        		$dados['tenant_id'] = Auth::user()->tenant_id;

				$usuario = User::create($dados);
				DB::commit();
				historico([
                    "titulo"     =>  "Cadastrou um usuário",
                    "descricao"  =>  "Cadastrou o usuário portador do email ".$usuario->email,
                    "tipo"       =>  "U",
                    "ref_id"     =>  $usuario->id
            	]);
	    		return Response::json(['success'=>true,'msg'=>'Cadastrado com Sucesso','id'=>base64_encode($usuario->id)]);
	    	}		
		}
		catch(\Exception $e)
		{
			DB::rollBack();			
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);		
		}

	}

	public function putAtivar()
	{
		try
		{
			if(cannot('usuarios','put'))
				return Response::json(['success'=>false,'msg'=>'Você não ter permissão para esta operação !!!']);	

			$dados = Input::all();		
			foreach ($dados['selecionados'] as $id):
				$usuario = User::find($id);
				if($id!=Auth::user()->id):
					if($usuario->ativo=="S")
					{
						User::where('id','=',$usuario->id)->update(['ativo'=>'N']);
						historico([
		                    "titulo"     =>  "Inativou um usuário",
		                    "descricao"  =>  "Inativou o usuário portador do email ".$usuario->email,
		                    "tipo"       =>  "U",
		                    "ref_id"     =>  $usuario->id
		            	]);
		            }
					else
					{
						User::where('id','=',$usuario->id)->update(['ativo'=>'S']);
						historico([
		                    "titulo"     =>  "Ativou um usuário",
		                    "descricao"  =>  "Ativou o usuário portador do email ".$usuario->email,
		                    "tipo"       =>  "U",
		                    "ref_id"     =>  $usuario->id
		            	]);
					}
				endif;
			endforeach;

			return Response::json(['success'=>true,'msg'=>'Ativado/Desativado com sucesso !!!']);	
		}
		catch(\Exception $e)
		{
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);	
		}
	} 

    public function postEdit()
	{
		$rules= [
			        'nome'      => 'required|max:150',     
			        'sobrenome' => 'max:200',
			        'dt_nascimento' => 'required|date',   
			        'email'         => 'required|max:250|email',

	   			];
    	$messsages=
    			[
			        'nome.required'      =>'O campo nome não deve ser em branco',
			        'nome.max'           =>'O campo nome não deve ter mais do que 150 caracteres',
			        'sobrenome.required' =>'O campo sobrenome não deve ser em branco',
			        'sobrenome.max'      =>'O campo sobrenome não deve ter mais do que 200 caracteres',	
			        'dt_nascimento.date' =>'Data de nascimento inválida',
			        'dt_nascimento.required'=>'Data de nascimento é um campo obrigatório',
			        'email.required'     =>'O campo email não deve ser em branco',			        
			        'email.max'          =>'O campo email não deve ter mais do que 250 caracteres',
			        'email.email'        =>'O email preenchido não é um endereço de email válido'
    			];
		try
		{
			if(cannot('usuarios','put'))
				return Response::json(['success'=>false,'msg'=>'Você não ter permissão para esta operação']);	

			$dados = Input::all();	

			$emails = User::where('email','=',$dados['email'])->where('id','!=',$dados['id'])->get();
			if(count($emails)>0)
				return Response::json(['success'=>false,'msg'=>'Este email está sendo usado por outra pessoa']);

		   	$erros =  Validator::make($dados, $rules, $messsages);	    
	    	if ($erros->fails()) 
				return Response::json(['success'=>false,'msg'=>implode ('
				', $erros->errors()->all() )]);
	    	else
	    	{
				DB::beginTransaction();
				User::where('id','=',$dados['id'])->update($dados);
				DB::commit();
				historico([
		            "titulo"     =>  "Alterou um usuário",
		            "descricao"  =>  "Alterou o usuário portador do email ".$dados['email'],
		            "tipo"       =>  "U",
		            "ref_id"     =>  $dados['id']
		        ]);
	    		return Response::json(['success'=>true,'msg'=>'Alterado com Sucesso']);
	    	}
		}
		catch(\Exception $e)
		{
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
			DB::rollBack();	
		}
	}

	public function postValidausuario()
	{
		$dados = Input::all();
		$consulta = User::Tenant()->where('id','=',$dados['id'])->where('email','=',$dados['email'])->get();
		if(count($consulta)>0)
			return Response::json(true);
		else
			return Response::json(false);
	}

	public function postValidasenha()
	{
		$dados = Input::all();
		$consulta = User::where('id','=',$dados['id'])->where('senha','=',md5($dados['senha']))->get();
		if(count($consulta)>0)
			return Response::json(true);
		else
			return Response::json(false);
	}

	public function postValidausuarionovo()
	{
		$dados = Input::all();
		if(isset($dados['id']))		
			$consulta = User::where('id','!=',$dados['id'])->where('usuario','=',$dados['usuario'])->get();
		else
			$consulta = User::where('usuario','=',$dados['usuario'])->get();

		if(count($consulta)>0)
			return Response::json(false);
		else
			return Response::json(true);
	}

	public function putAlterarsenha()
	{
		try
		{
			$dados = Input::all();
			db::beginTransaction();
			$usuario = User::find($dados['id']);
			User::where('id','=',$usuario->id)->update(['senha'=>md5($dados['senha'])]);
			db::commit();
			historico([
		        "titulo"     =>  "Alterou a senha de um usuário",
		        "descricao"  =>  "Alterou a senha do usuário portador do email ".$usuario->email." via alteração de usuários",
		        "tipo"       =>  "U",
		        "ref_id"     =>  $usuario->id
		    ]);
			return Response::json(true);
		}
		catch(\Exception $e)
		{
			return Response::json(false);
			DB::rollBack();		
		}
	}

	public function deleteDestroy()
	{
		try
		{
			if(cannot('usuarios','delete'))
				return Response::json(['success'=>false,'msg'=>'Você não ter permissão para esta operação !!!']);

			$dados = Input::all();
			db::beginTransaction();
			$usuario = User::find($dados['id']);			
			User::where('id','=',$usuario->id)->delete();
			db::commit();
			resetAutoInc('usuarios');
			historico([
		        "titulo"     =>  "Excluiu um usuário",
		        "descricao"  =>  "Excluiu o usuário portador do email ".$usuario->email,
		        "tipo"       =>  "U",
		        "ref_id"     =>  $usuario->id
		    ]);
			return Response::json(true);
		}
		catch(\Exception $e)
		{
			DB::rollBack();	
			return Response::json(false);
		}
	}

	public function postIniciais()
	{
		$dados = Input::all();
		return Response::json(Iniciais($dados['nome']));
	}

	public function postCalculaidade()
	{
		$dados = Input::all();
		$dt_nascimento  = $dados['dt_nascimento'];
		return Response::json(calc_idade($dt_nascimento));
	}


	public function getGroups($metodo = null,$id=0)
	{
		if(is_null($metodo)):
			if(cannot('grupos_acesso','get'))
				return erro(505);

			$grupos = GruposAcesso::all();
			return view('painel.usuarios.grupos_acesso.index',compact('grupos'));
		else:
			switch ($metodo) {
				case 'show':
					if(cannot('grupos_acesso','get'))
						return erro(505);
					$id = base64_decode($id);
					$grupo =   GruposAcesso::find($id);
					$usuarios =   User::Tenant()->where('grupo_acesso_id','=',$id)->get();
					$modulos = Modulos::all();
					if(count($grupo)<=0)
						return erro(404);

					return view('painel.usuarios.grupos_acesso.show',compact('grupo','usuarios','modulos'));
					break;
				
				default:
					# code...
					break;
			}
		endif;
	}

	public function putGroups()
	{
		try
		{
			if(cannot('grupos_acesso','put'))
				return Response::json(['success'=>false,'msg'=>'Você não ter permissão para esta operação']);	
			$dados = Input::all();
			Session(['dados'=>$dados]);
			Session::save();
			$id_grupo = $dados['info']['id'];
			unset($dados['info']['id']);
			db::beginTransaction();
			$grupos_acesso = GruposAcesso::find($id_grupo);
			GruposAcesso::where('id','=',$grupos_acesso->id)->update($dados['info']);
			$permissoes = $this->processar_permissoes($dados['permissoes']);

			foreach ($permissoes as $id => $valor):
				Acl::where('grupo_acesso_id','=',$id_grupo)->where('permissao_id','=',$id)->update(['valor'=>$valor]);
			endforeach;
			db::commit();	
			historico([
		        "titulo"     =>  "Alterou um grupo de acesso",
		        "descricao"  =>  "Alterou o grupo de acesso '".$grupos_acesso->descricao."'",
		        "tipo"       =>  "G",
		        "ref_id"     =>  $grupos_acesso->id
		    ]);	
			return Response::json(["success"=>true,"msg"=>"Alterado com sucesso",'id'=>base64_encode($id_grupo)]);
		}
		catch(\Exception $e)
		{
			DB::rollBack();					
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}

	public function getGroupscreate()
	{
		if(cannot('grupos_acesso','post'))
			return erro(505);
		$modulos = Modulos::all();
		return view('painel.usuarios.grupos_acesso.create',compact('modulos'));
	}

	public function postGroups()
	{
		try
		{
			if(cannot('grupos_acesso','post'))
				return Response::json(['success'=>false,'msg'=>'Você não ter permissão para esta operação']);

			$dados = Input::all();
			$tenant_id = Auth::user()->tenant_id;
			db::beginTransaction();
			$grupos_acesso = GruposAcesso::create($dados['info']);
			$permissoes = $this->processar_permissoes($dados['permissoes']);
			foreach ($permissoes as $id => $valor):
				Acl::insert(['permissao_id' => $id,'grupo_acesso_id'=>$grupos_acesso->id,'valor'=>$valor,'tenant_id'=>$tenant_id]);
			endforeach;
			db::commit();	
			historico([
		        "titulo"     =>  "Cadastrou um grupo de acesso",
		        "descricao"  =>  "Cadastrou o grupo de acesso '".$grupos_acesso->descricao."'",
		        "tipo"       =>  "G",
		        "ref_id"     =>  $grupos_acesso->id
		    ]);
			return Response::json(["success"=>true,"msg"=>"Cadastrado com sucesso",'id'=>base64_encode($grupos_acesso->id)]);
		}
		catch(\Exception $e)
		{
			DB::rollBack();					
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}

	private function processar_permissoes($input_permissoes)
	{
		foreach (Permissoes::all() as $permissao):
			if(isset($input_permissoes[$permissao->id]))
				$input_permissoes[$permissao->id]="S";
			else
				$input_permissoes[$permissao->id]="N";
		endforeach;
		return $input_permissoes;
	}

	public function deleteGroupdestroy()
	{
		try
		{
			if(cannot('grupos_acesso','delete'))
				return Response::json(['success'=>false,'msg'=>'Você não ter permissão para esta operação']);

			$dados = Input::all();
			db::beginTransaction();
			Acl::whereIn('grupo_acesso_id',$dados['selecionados'])->delete();
			GruposAcesso::whereIn('id',$dados['selecionados'])->delete();
			db::commit();
			resetAutoInc('grupo_acesso_permissoes');
		    historico([
		        "titulo"     =>  "Excluiu grupos de acesso",
		        "descricao"  =>  "Excluiu os grupos de acesso '".implode($dados['selecionados'],',')."'",
		        "tipo"       =>  "G",
		        "ref_id"     =>  0
		    ]);
			return Response::json(['success'=>true,'msg'=>'Excluido com sucesso']);
		}
		catch(\Exception $e)
		{
			DB::rollBack();	
			return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
		}
	}


 

}
