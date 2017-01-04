
// foca no proximo ao dar enter
$("#email").keyup(function(event){
  if(event.keyCode == 13){
    $( "#senha" ).focus();
  }
});

//clica no entrar quando da enter
$("#senha").keyup(function(event){
    if(event.keyCode == 13){
        $("#btn_entrar").click();
    }
});

$("#chk_manter_login").keyup(function(event){
    if(event.keyCode == 13){
        $("#btn_entrar").click();
    }
});

// verifica usuario
$("input[name='email']").on('keyup', function()
{
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;
    $.getJSON('usuarioexiste/' + email,function(data)
    {
      if(data=='NAO')
      {
        document.getElementById("email").style.border = "1px solid red";
        document.getElementById("email_valida").value="NAO";
        // $('#resultado').html('Usuário não cadastrado');
      }
      else
      {
        document.getElementById("email").style.border = "1px solid green";   
        document.getElementById("email_valida").value="SIM";    
        $('#resultado').html('');
      }
    });
});

$("#chk_manter_login").on('change', function()
{
    if($('#manter_login').val()=='S')
      $('#manter_login').val("N");
    else
      $('#manter_login').val("S");
});

// verifica senha
$("input[name='senha']").on('keyup', function(){
    var senha = document.getElementById("senha").value;
    if(senha.length>=4)
      document.getElementById("senha").style.border = "1px solid green";
    else
      document.getElementById("senha").style.border = "1px solid red";
});


$('#senha_nova').on('keyup', function()
{
    senha = $('#senha_nova').val();
    if(senha.length>=4)
    {
      document.getElementById("senha_nova").style.border = "1px solid green";
      confirmarsenhanova($('#senha_nova').val(),$('#repita_senha_nova').val());
    }
    else
      document.getElementById("senha_nova").style.border = "1px solid red";
});

$('#repita_senha_nova').on('keyup', function()
{
    senha = $('#repita_senha_nova').val();
    if(senha.length>=4)
    {
      document.getElementById("repita_senha_nova").style.border = "1px solid green";
      confirmarsenhanova($('#senha_nova').val(),$('#repita_senha_nova').val());
    }
    else
      document.getElementById("repita_senha_nova").style.border = "1px solid red";
});

function confirmarsenhanova(senha,repita)
{
  if((senha==repita)&&(senha.length>=4)&&(repita.length>=4))
  {
    document.getElementById("repita_senha_nova").style.border = "1px solid green";    
    $('#btn_definir_Senha').removeAttr('disabled');
  }
  else
  {
    document.getElementById("repita_senha_nova").style.border = "1px solid red";
    $('#btn_definir_Senha').attr('disabled','disabled');
  }
}


$('#btn_definir_Senha').on('click',function()
{  
  var form = $('<form action="Definirsenha/" method="post">' +
                '<input type="hidden" value="'+$('#email').val()+'" name="defemail" />' +
                '<input type="hidden" value="S" name="defseguranca" />' +
                '<input type="hidden" value="'+$('#senha_nova').val()+'" name="defsenha" />' +
              '</form>');
              $('body').append(form);
              $(form).submit();  
  });


function logar()
{
  if((document.getElementById("senha").value=="")||(document.getElementById("email").value=="")||(document.getElementById("senha").length<4)||(document.getElementById("email_valida").value=='NAO'))
  {
    return false;
  }
  else
  {
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;
    $.get('Validalogin/' + email + '/' + senha,function(resultado)
    {
          if(resultado=='NAO')
          {
            $('#titulo_msg1').html('Aviso');
            $('#msg_msg1').html('Senha incorreta!');
            $('#mensagem1').modal('show'); 
          }
          else
          {
            if(senha=='0123456789')
            {
              $('#titulo_msg1').html('Aviso importante');
              $('#msg_msg1').html('Este é seu primeiro acesso, por favor defina qual será sua senha de acesso');
              $('#mensagem1').modal('show'); 
              $('#form_nova_senha').toggle(150);
              $('#form_login').toggle(150);
              $('#sublink').html('<a onclick="voltaraologin()" > Voltar ao login</a>')
            }
            else
            {
              SEND("POST","{{asset('usuarios/logar')}}",{email:email,senha:senha,manter_login:$('#manter_login').val()},"{{Request::getToken()}}");
            }
          }
    });
  }
}

$("#renova_email").on('keyup', function(){
    email = $("#renova_email").val();
    $.get('usuarioexiste/' + email,function(data)
    {
      if(data=='NAO')
      {
        document.getElementById("renova_email").style.border = "1px solid red";
        $('#btn_renovar_senha').attr('disabled','disabled');
      }
      else
      {
        document.getElementById("renova_email").style.border = "1px solid green";  
        $('#btn_renovar_senha').removeAttr('disabled');        
      }
    });
});

function voltaraologin()
{
  $('#form_nova_senha').hide();
  $('#form_esqueci_senha').hide();
  $('#form_login').show();
  $('#sublink').html('<a id="esquecisenha" onclick="esquecisenha();" >Esqueci a senha</a></div>');
}

function esquecisenha()
{
  $('#form_login').toggle(150);
  $('#form_esqueci_senha').toggle(150);
  $('#sublink').html('<a onclick="voltaraologin()" > Voltar ao login</a>')
}

$("#btn_renovar_senha").on('click', function(){
  var form = $('<form action="RenovarSenha/" method="post">' +
              '<input type="hidden" value="'+ $('#renova_email').val()+'" name="renov_email" />' +
              '</form>');
  $('body').append(form);
  $(form).submit();  
});
