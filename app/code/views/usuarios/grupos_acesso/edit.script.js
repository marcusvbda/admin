$('#btn_salvar').click(function()
{
	var descricao = $('#descricao').val();
	var id = {{$grupo_acesso->id}};
	if(!ValidarCampos(["#descricao"]))
        return msg("Oops","A descrição do grupo de acesso não pode estar em branco !!","error");
	send("POST","{{asset('usuarios/ValidaNomeGrupoAcesso')}}",{descricao,id},function(validou)
	{
		if(!validou)
		{
			$( "#descricao" ).addClass( "error" );	
			return msg("Oops","Já existem um grupo de acesso com este nome  !!","error");
		}

		
		@foreach($modulos as $mod)
			var {{$mod->modulo}} = $('#{{uppertrim($mod->modulo)}}').getData();
			{{$mod->modulo}}['modulo_id']='{{$mod->id}}';
		@endforeach


		send("PUT","{{asset('usuarios/EditGrupoAcesso')}}",{id,descricao @foreach($modulos as $mod),{{$mod->modulo}}@endforeach},function(alterou)
		{
			if(alterou)
				msg_stop(":)","Grupo de Acesso alterado com sucesso",function()
				{
					location.href="{{asset('usuarios/grupos_acesso')}}";
				},"success");
			else
				return msg("Oops","Erro ao alterar grupo de acesso !!","error");
		},"{{Request::getToken()}}");

	});
});

