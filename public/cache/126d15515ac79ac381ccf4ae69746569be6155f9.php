<?php $__env->startSection('titulo','Login'); ?>

<?php $__env->startSection('topo'); ?>
<h1>
  Nome da página
  <small>Subtitulo</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Pagina em branco</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<p class="login-box-msg">Entre para iniciar sua sessão</p>

    <!-- <form action="<?php echo e(asset('usuarios/logar')); ?>" method="post" onsubmit="return logar()"> -->
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
    <!-- </form> -->


<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
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
            var form = $('<form action="logar/" method="post">' +
            '<input type="hidden" value="'+email+'" name="email" />' +
            '<input type="hidden" value="'+senha+'" name="senha" />' +
            '</form>');
            $('body').append(form);
            $(form).submit();
          }
    });
  }
}

   
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('sublink'); ?>
<div class="pull-left"><a href="<?php echo e(asset('usuarios/renovasenha')); ?>" " >Esqueci a senha</a></div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('templates.principal.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>