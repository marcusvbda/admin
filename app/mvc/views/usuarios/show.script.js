$('#btn_alterar').on('click', function() 
{
    $('#usuario').attr('readonly', false);
    $('#email').attr('readonly', false);
    $('#sexo').attr('readonly', false);
    $('#rd_admin').attr('readonly', false);
    $('#btn_visualizacao').toggle(150);
    $('#btn_alteracao').toggle(150);
}); 

$('#btn_cancelar').on('click', function() 
{
    $('#usuario').attr('readonly', true);
    $('#email').attr('readonly', true);
    $('#sexo').attr('readonly', true);
    $('#rd_admin').attr('readonly', true);
    $('#btn_alteracao').toggle(150);    
    $('#btn_visualizacao').toggle(150);
}); 


$('#btn_confirmar').on('click', function() 
{
  if (($('#usuario').val()=="") || 
      ($('#email').val()=="") || 
      ($('#sexo').val()=="") || 
      ($('#senha').val()=="") || 
      ($('#confirme_senha').val()==""))
  {
    mensagem_validacao("Todos os campos são obrigatórios para este formulário !");
    return false;
  }  
  else
  {
      if(($('#senha').val())!=($('#confirme_senha').val()))
      {
        mensagem_validacao("Senhas não conferem !");
        return false;
      }
      else
      {
        email = $('#email').val();
        id = $('#id').val();
        $.get('../Usuarioexiste_editar/'+email+'/'+id,function(data)
        {
            if(data=='SIM')
            {
              mensagem_validacao("Email em uso por outro usuário !");
              return false;
            }
            else
            {
              alterar();
            }            
        });
      }
  }    
}); 


function alterar()
{
  var usuario = $("#usuario").val();
  var id = $("#id").val();
  var email = $("#email").val();
  var sexo = $("#sexo").val();
  var admin = $("#admin").val();
  SEND('PUT',"{{asset('usuarios/editar')}}",{usuario:usuario,id:id,email:email,sexo:sexo,admin:admin});
}


function mensagem_validacao(msg)
{
  $('#titulo_msg2').html('Aviso');
  $('#msg_msg2').html(msg);
  $('#mensagem2').modal('show'); 
}

$('#admin_checkbox').on('change', function() 
{
  if($('#admin').val()=='S')
    $('#admin').val('N');
  else
    $('#admin').val('S');
}); 

function setAdmin(adm)
{
  $('#admin').val(adm);
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