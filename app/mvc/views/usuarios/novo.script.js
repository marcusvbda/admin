$('#btn_confirmar').on('click', function() 
{
  if (($('#usuario').val()=="") || 
      ($('#email').val()=="") || 
      ($('#sexo').val()=="") || 
      ($('#senha').val()=="") || 
      ($('#confirme_senha').val()==""))
  {
    msg("aviso","Todos os campos são obrigatórios para este formulário !");
    return false;
  }  
  else
  {
      if(($('#senha').val())!=($('#confirme_senha').val()))
      {
        msg("aviso","Senhas não conferem !");
        return false;
      }
      else
      {
        $.get('usuarioexiste/' + $('#email').val(),function(data)
        {
            if(data=='SIM')
            {
              msg("aviso","Email em uso por outro usuário !");
              return false;
            }
            else
            {
              msg_confirm('<strong>Confirmação</strong>','Confirma cadastro deste usuário?',"cadastrar()"); 
            }            
        });
      }
  }
    
}); 

function cadastrar()
{
  var usuario = $('#usuario').val();
  var email = $('#email').val();
  var sexo = $('#sexo').val();
  var senha = $('#senha').val();
  var admin = $('#admin').val();
  SEND('POST',"{{asset('usuarios/novo')}}",{ 
                                            usuario:usuario,
                                            email:email,
                                            sexo:sexo,
                                            senha:senha,
                                            admin:admin,
                                          },"{{Request::getToken()}}");
}

$('#admin_checkbox').on('change', function() 
{
  if($('#admin').val()=='S')
    $('#admin').val('N');
  else
    $('#admin').val('S');
}); 

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