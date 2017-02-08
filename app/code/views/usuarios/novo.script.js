$('#btn_confirmar').on('click', function() 
{
  if(!ValidarCampos(["#nome","#email","#sexo","#senha","#confirme_senha"]))
    return msg("Oops","Os campos em vermelho são obrigatórios","error");

  if(!confirmaSenha())
    return msg("Oops","Senhas não conferem !!","error");
    
  var dados = $('#frmusuario').getData();
  email = dados['email'];
  send('POST',"{{asset('usuarios/Restvalidanovoemail')}}",{email:email},function(validou)
  { 
    if(validou)
    {
      send('POST',"{{asset('usuarios/Restvalidanovoemail')}}",{email:email},function(cadastrou)
      {

        send('POST',"{{asset('usuarios/novo')}}",{dados},function(cadastrou)
        {
          if(!cadastrou)
            return msg("oops!","Erro ao gravar este usuário !!","error");

          msg_stop(":)","Cadastrado com sucesso !!",function()
          {
            reload();
          },"success");     
        });

      });
    }
    else
    {
      $('#email').addClass( "error" );      
      msg("oops!","Usuário em uso","error");
    }   
  });   

}); 


function confirmaSenha()
{
  var senha       = $('#senha').val();
  var confirmacao = $('#confirme_senha').val();
  if(senha==confirmacao)
  {
    $('#confirme_senha').removeClass( "error" );   
    $('#senha').removeClass( "error" ); 
    return true;
  }
  else
  {
    $('#confirme_senha').addClass( "error" );    
    $('#senha').addClass( "error" );  
    return false;
  }
}



function trocabotoes()
{
  $('#btn_alterar').toggle(150);
  $('#btn_confirmar').toggle(150);
  $('#btn_cancelar').toggle(150);
  $('#div_risco').toggle(150);
}

function desabilitar_inputs(disabled)
{
  $("#usuario").prop('disabled', disabled);
  $("#email").prop('disabled', disabled);
  $("#admin_checkbox").prop('disabled', disabled);
}