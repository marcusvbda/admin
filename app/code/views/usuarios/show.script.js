@if(Access("DELETE","usuarios"))
  $("#div_alt_excluir").load("{{asset('usuarios/AlterarExcluir')}}",{});
@endif
@if(Access("PUT","usuarios"))
  $("#div_alt_email").load("{{asset('usuarios/AlterarEmail')}}",{});
  $("#div_alt_senha").load("{{asset('usuarios/AlterarSenha')}}",{});

  function editar()
    {
      msg_confirm("Confirmação","Editar Informações deste profile ?",function()
      {
        liberar();
      });
    }

    function cancelaredicao()
    {
      msg_confirm("Cancelar","As alterações serão perdidas ?",function()
      {
        reload();
      });
    } 

    function salvar()
    {
      if(!ValidarCampos(["#usuario"]))
        return msg("Oops","Os campos em vermelho são obrigatórios","error");

      msg_confirm("Salvar","As alterações serão salvas ?",function()
      {
        var dados        = $('#frm_usuario').getData();
        dados['id']={{$usuario->id}};
        send('PUT',"{{asset('usuarios/AlterarUsuario')}}",{dados},function(sucesso)
        {
          if(sucesso)
            msg_stop(":)","Salvo com sucesso !!",function()
            {
              location.href="{{asset('usuarios')}}";
            },'success');
          else
            msg_stop("Oops","Erro ao salvar !!",function()
            {
              reload();
            },"error");
        },"{{Request::getToken()}}");  
      },false);
    }

    function liberar()
    {
      $("#btn_editar_info").hide();
      $("#btn_salvar_info").hide();
      $("#danger_zone").hide();
      $("#btn_salvar_info").toggle(150);
      $("#danger_zone").toggle(150);
      $("#frm_usuario :input").prop('disabled', false);
      $('#div_resumo').toggle(150);
      $('#div_campos').removeClass('col-md-10');
      $('#div_campos').removeClass('col-md-12');
    }
    
@endif
