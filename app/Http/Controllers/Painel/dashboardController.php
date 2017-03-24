<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Input;
use App\User;
use App\Todolist;
use App\historico;


class dashboardController extends Controller
{ 
  	public function index()
  	{     
      if(Auth::user()->reset_token!=""):
        $mensagem = array(['tipo'=>'danger','titulo'=>'Alguem pode estar tentando descobrir sua senha','texto'=>"  Um email de renovação de senha foi enviado apartir do 'esqueci a senha' com um link de renovação de senha, porém sua senha ainda não foi renovada, aconselhamos trocar a senha do seu email e de seu usuário. Para sua segurança invalidamos o link que foi enviado anteriormente"]);
        User::where('id','=',Auth::user()->id)->update(['reset_token'=>null]);
      endif;


      $historico_usuarios = Historico::where('tipo','=','U')->orderBy('id', 'desc')->take(5)->get();

		  return view('painel.dashboard.index',compact('mensagem','historico_usuarios'));
  	}

    public function putChecartodo()
    {
      try
      {
        DB::beginTransaction();        
        $id = Input::all()['id'];
        $afazer = Todolist::find($id);
        if($afazer->checked=="S")
          $afazer->checked="N";
        else
          $afazer->checked="S";
        $afazer->save();
        DB::commit();       
        return Response::json(['success'=>true,'msg'=>'Todo id :'.$id.' Alterado com sucesso !!']);
      }
      catch(\Exception $e)
      {
        DB::rollback();  
        return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
      }
    }

    public function deleteDestroytodo()
    {
      try
      {
        $id = Input::all()['id'];
        DB::beginTransaction();
        Todolist::where('id','=',$id)->delete();
        resetAutoInc('todolist');
        DB::commit();        
        return Response::json(['success'=>true,'msg'=>'Excluido com sucesso !!!']);
      }
      catch(\Exception $e)
      {
        DB::rollback();  
        return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
      }
    }

    public function postCreatetodo()
    {
      try
      {
        $dados = Input::all();
        if(uppertrim($dados['descricao'])=="")
          return Response::json(-1);
        $dados['usuario_id']=Auth::user()->id;
        DB::beginTransaction();        
        $todo = Todolist::create($dados);
        DB::commit();        
        return Response::json(['success'=>true,'msg'=>"Cadastrado com sucesso !!!","id"=>$todo->id]);
      }
      catch(\Exception $e)
      {
        DB::rollback();  
        return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
      }
    }

    public function putEdittodo()
    {
      try
      {
        $dados = Input::all();
        DB::beginTransaction();        
        Todolist::where('id','=',$dados['id'])->update($dados);
        DB::commit();        
        return Response::json(['success'=>true,'msg'=>"Editado com sucesso !!!"]);
      }
      catch(\Exception $e)
      {
        DB::rollback();  
        return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
      }
    }

    public function postNotifications()
    {
      $dados = array();
      $dados[count($dados)+1]=['cor'=>'aqua','msg'=>'Teste de notificação','url'=>''];
      return Response::json($dados);
    }

}
