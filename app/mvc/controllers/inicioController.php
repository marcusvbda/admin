<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;
use Jenssegers\Blade\Blade;

class inicioController extends controller
{

	protected $mensagens;
    public function __construct()
	{
		$this->mensagens = $this->model('mensagem');
	}


	public function getIndex()
	{
		$usuarios=DB::table('usuarios')
			->where('empresa','=',Auth('empresa'))
				->where('excluido','=','N')
					->orderBy('usuario')
						->get();
		$qtde_usuarios_cadastrados = count($usuarios);
		echo $this->view('index',compact('qtde_usuarios_cadastrados'));
	}

	public function getUsuariosChat()
	{
		$usuarios=DB::table('usuarios')
			->where('empresa','=',Auth('empresa'))
				->where('excluido','=','N')
					->where('id','!=',Auth('id'))
						->orderBy('usuario')
							->get();
		echo json_encode($usuarios);
	}	

	public function getMensagens($id)
	{
		$usuario_logado=Auth('id');
		$query = 
			"select 
				u_rem.id as id_remetente,
				u_rem.usuario as remetente,
				u_rem.foto as foto_remetente,
				u_des.id as id_destinatario,
				u_des.usuario as destinatario,
				u_des.foto as foto_destinatario,
				m.mensagem,m.dt_envio
			FROM mensagens m 
				join usuarios u_rem on m.id_remetente=u_rem.id 
				join usuarios u_des on m.id_destinatario=u_des.id 
			where 
			(m.id_remetente=$usuario_logado or m.id_destinatario=$usuario_logado) and 
			(m.id_remetente=$id or m.id_destinatario=$id) order by m.dt_envio desc";
		$mensagens =DB::select( DB::raw($query));
		echo json_encode($mensagens);
	}



	public function getEnviarMensagem($msg,$destinatario)
	{
		$id = DB::table('mensagens')->insertGetId(['id_remetente' =>Auth('id'), 
			'mensagem' => $msg,
			'id_destinatario' => $destinatario,
			'dt_envio'=>date("Y-m-d H:i:s")]);
		echo $id;
	}
}
