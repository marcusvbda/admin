$('#btn_salvar').click(function()
{
	if(!ValidarCampos(["#descricao"]))
        return msg("Oops","A descrição do grupo de acesso não pode estar em branco !!","error");

	var descricao = $('#descricao').val();
	send("POST","{{asset('usuarios/ValidaNomeGrupoAcesso')}}",{descricao},function(validou)
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


		send("POST","{{asset('usuarios/StoreGrupoAcesso')}}",{descricao @foreach($modulos as $mod),{{$mod->modulo}}@endforeach },function(cadastrou)
		{
			if(cadastrou)
				msg_stop(":)","Grupo de Acesso cadastrado com sucesso",function()
				{
					location.href="{{asset('usuarios/grupos_acesso')}}";
				},"success");
			else
				return msg("Oops","Erro ao cadastrar grupo de acesso !!","error");
		},"{{Request::getToken()}}");

	});
});