@extends('templates.principal.login')

@section('titulo','Login')

@section('topo')
<h1>
  Nome da página
  <small>Subtitulo</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Pagina em branco</a></li>
</ol>
@stop


@section('conteudo')
<div id="form_login"  >
  <p class="login-box-msg">Entre para iniciar sua sessão</p>

      <!-- <form action="{{asset('usuarios/logar')}}" method="post" onsubmit="return logar()"> -->
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" id="email" required=""  autocomplete="off" placeholder="Email" style="border:1px solid red;">
          <input type="text" name="email" id="email_valida"  value="NAO" autocomplete="off" style="display: none;"/>
          <!-- <div id="resultado"></div> -->
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="senha" id="senha" required="" minlength="4" maxlength="20" autocomplete="off" placeholder="Senha" style="border:1px solid red;">
          <input type="password" name="password" id="password" id="senha" autocomplete="off" style="display: none;" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">        
          <!-- /.col -->
          <div class="col-xs-4 pull-right">
            <button onclick="logar()" id="btn_entrar" class="btn btn-primary btn-block btn-flat">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
</div>




<div id="form_nova_senha" style="display:none;">
  <p class="login-box-msg">Defina sua senha de acesso, lembrando que a mesma deve ter no mínimo 4 e no máximo 20 caracteres.</p>
  <div class="form-group has-feedback">
    <input type="password" class="form-control" id="senha_nova" required="" minlength="4" maxlength="20" autocomplete="off" placeholder="Senha" style="border:1px solid red;">
  </div>
  <div class="form-group has-feedback">
    <input type="password" class="form-control" name="repita_senha_nova" id="repita_senha_nova" required="" minlength="4" maxlength="20" autocomplete="off" placeholder="Repita a senha" style="border:1px solid red;">
  </div>
  <div class="row">   
    <div class="col-xs-6 pull-right">
      <button id="btn_definir_Senha" disabled class="btn btn-primary btn-block btn-flat">Definir senha</button>
    </div>
  </div>
</div>





<div id="form_esqueci_senha" style="display:none;">
  <p class="login-box-msg">Digite o email para que seja enviada um link de renovação de senha.</p>
  <div class="form-group has-feedback">
    <input type="email" class="form-control" id="renova_email" minlength="4" maxlength="200" autocomplete="off" placeholder="Email" style="border:1px solid red;">
    <input type="text" hidden value="NAO" id="renova_email_valida" name="">
  </div>
  <div class="row">   
    <div class="col-xs-6 pull-right">
      <button id="btn_renovar_senha" disabled class="btn btn-primary btn-block btn-flat">Enviar email</button>
    </div>
  </div>
</div>
    <!-- </form> -->


<script src="{{PASTA_PUBLIC}}/{{APP_DIR}}/template/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">

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

// verifica usuario
$("input[name='email']").on('keyup', function(){
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;
    $.get('usuarioexiste/' + email,function(data)
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
              var form = $('<form action="logar/" method="post">' +
              '<input type="hidden" value="'+email+'" name="email" />' +
              '<input type="hidden" value="'+senha+'" name="senha" />' +
              '</form>');
              $('body').append(form);
              $(form).submit();
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




   
</script>





<!-- Modal -->
<div class="modal fade" id="mensagem1" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title centro">
          <div id="titulo_msg1"></div>
        </h4>
      </div>
      <div class="modal-body">
        <p><div id="msg_msg1"></div></p>
      </div>
      <div  class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Voltar</button>
      </div>
    </div>    
  </div>
</div>


@stop

@section('sublink')
<div class="pull-left" id="sublink"><a id="esquecisenha" onclick="esquecisenha();" >Esqueci a senha</a></div>
@stop


