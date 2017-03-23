<?php

namespace App\Http\Controllers\Painel\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Redirect;
use Input;
use Mail;

class AuthController extends Controller
{
 
    public function getLogin()
    {
        Auth::logout();
        return view('painel.auth.login');
    }

    public function postLogin(Request $request)
    {
        if($request->ajax()):
            $credentials = $request->only('email', 'senha','remember');
            $credentials['senha'] = md5($credentials['senha']);
            $usuario = User::where('email','=',$credentials['email'])
            ->where('senha','=',$credentials['senha'])
            ->where('ativo','=','S')
            ->first();
            if(isset($usuario)):
                if (Auth::loginUsingId($usuario->id,(uppertrim($credentials['remember'])==uppertrim("TRUE"))   ))
                {
                    historico([
                        "titulo"     =>  "Entrou no sistema",
                        "descricao"  =>  "O usuario ".$credentials['email']." efetuou login no sistema",
                        "tipo"       =>  "U",
                        "ref_id"     =>  $usuario->id
                    ]);
                    return Response::json(['success'=>true,'msg'=>'Logado com sucesso']);
                }
                else

                    return Response::json(['success'=>false,'msg'=>'Erro ao efetuar login']);
            else:
                return Response::json(['success'=>false,'msg'=>'Este usuário não existe ou a senha está incorreta, verifica...']);
            endif;
        else:
            return erro('404');
        endif;
    }

    public function postReset(Request $request)
    {
        if($request->ajax()):
            try
            {
                $credentials = $request->only('usuario');
                $usuario = User::Where('email','=',$credentials['usuario'])->first();
                if(isset($usuario)):
                    $token = md5(uniqid());
                    User::where('id','=',$usuario->id)->update(['reset_token'=>$token  ]);
                    if(!$this->enviar_email_reset($usuario,$token)):  
                        return Response::json(['success'=>false,'msg'=>'Desculpe, não foi possivel enviar o link para '.$usuario->email]);
                    else:
                        return Response::json(['success'=>true,'msg'=>'Um e-mail foi enviado para o email '.$usuario->email.' nele haverá um link para renovar sua senha.']);
                    endif;
                else:
                    return Response::json(['success'=>false,'msg'=>'Este não é um usuário/email cadastrado em nosso sistema']);
                endif;
            }
            catch(Expetion $e)
            {
                return Response::json(['success'=>false,'msg'=>$e]);
            }
        else:
            return erro('404');
        endif;
    }
    
    
    public function postLogout(Request $request)
    {
        if($request->ajax()):
            try
            {
                historico([
                    "titulo"     =>  "Saiu do sistema",
                    "descricao"  =>  "O usuario ".Auth::user()->email." efetuou logoff no sistema",
                    "tipo"       =>  "U",
                    "ref_id"     =>  Auth::user()->id
                ]);
                Auth::logout();                
                return Response::json(['success'=>true,'msg'=>'Logout feito com sucesso']);
            }
            catch(\Exception $e)
            {
                return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
            }
        else:
            return erro('404');
        endif;
    }

    public function getReset()
    {
        Auth::logout();        
        return view('painel.auth.reset');
    }

    public function getNewpass($token)
    {
        $usuario = User::where('reset_token','=', $token)->first();
        if(isset($usuario)):
            return view('painel.auth.newpass',compact('token'));      
        else:
            return erro('404');
        endif;
    }

    public function postNewpass()
    {
        try
        {
            $dados = Input::all();

            $senha = $dados['senha'];
            $token = $dados['reset_token'];
            $usuario = User::where('reset_token','=',$token)->where('senha','=',md5($senha))->first();
            if(count($usuario)>0):
                return Response::json(['success'=>false,'msg'=>'Esta é sua senha atual, digite uma senha diferente']);
            endif;
            $usuario = User::where('reset_token','=',$token)->first();
            User::where('reset_token','=',$token)->update(['senha'=>md5($senha),'reset_token'=>null]);
            historico([
                    "titulo"     =>  "Alterou a senha de acesso",
                    "descricao"  =>  "O usuário portador do email ".$usuario->email." renovou sua senha por meio do 'esqueci minha senha'",
                    "tipo"       =>  "U",
                    "ref_id"     =>  $usuario->id
            ],false);
            return Response::json(['success'=>true,'msg'=>'Sua senha foi alterada com sucesso !!!']);
        }
        catch(Expetion $e)
        {
            return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);return Response::json(['success'=>false,'msg'=>$e->errorInfo[2]]);
        }
    }

 

    private function enviar_email_reset($usuario,$token)
    {
        try
        {
            $dados = ['nome'=>$usuario->nome,'sobrenome'=>$usuario->sobrenome,'link'=>asset('admin/auth/newpass/'.$token),'email'=>$usuario->email];
            Mail::send(['html' => 'painel.emails.reset'], $dados , function($msg) use ($dados)
            {
                $msg->to($dados['email'],$dados['nome'].' '.$dados['sobrenome'])->subject('Renovação de senha '.env('APP_NAME'));
                // $msg->cc(env('MAIL_USERNAME'),env('APP_NAME'));
            });
            historico([
                    "titulo"     =>  "Solicitou link de renovação de senha",
                    "descricao"  =>  "Foi enviado para o email ".$dados['email']." um link de renovação de senha",
                    "tipo"       =>  "U",
                    "ref_id"     =>  $usuario->id
            ],false);
            return true;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }


}
