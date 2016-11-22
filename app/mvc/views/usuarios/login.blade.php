@extends('templates.principal.login')

@section('titulo','Login')



@section('conteudo')
<div id="form_login"  >
  <p class="login-box-msg">Entre com os dados para iniciar sua sessão</p>

      <!-- <form action="{{asset('usuarios/logar')}}" method="post" onsubmit="return logar()"> -->
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" id="email" required=""  autocomplete="off" placeholder="Email" style="border:1px solid red;">
          <input type="text" name="email" id="email_valida"  value="NAO" autocomplete="off" style="display: none;"/>
          <!-- <div id="resultado"></div> -->
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="senha" id="senha" required="" maxlength="20" autocomplete="off" placeholder="Senha" style="border:1px solid red;">
          <input type="password" name="password" id="password" id="senha" autocomplete="off" style="display: none;" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <input type="text" id="manter_login" value="N" hidden="">
          <p  class="login-box-msg pull-left" style="padding-left:0px;padding-top:10px;" ><input type="checkbox" id="chk_manter_login">Manter-me logado</p>    
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
    <input type="password" class="form-control" id="senha_nova" required="" maxlength="20" autocomplete="off" placeholder="Senha" style="border:1px solid red;">
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


<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">




   
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


