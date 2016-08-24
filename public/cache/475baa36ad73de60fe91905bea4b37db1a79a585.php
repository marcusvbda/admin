<?php $__env->startSection('titulo','Usuários'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Usuários
  <small>Consulta / Alteração</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a><i class="glyphicon glyphicon-search"></i> Consulta / Alteração</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>

<div class="col-md-12">
    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Dados do Usuário</p>
        <div class="box-tools pull-right">
        </div>

        
          <div class="row" >
            <div class="col-md-4">
              <input type="text" id="id" value="<?php echo e($usuario->id); ?>" hidden>
              <label>Nome Completo</label>
              <input class="form-control" value="<?php echo e($usuario->usuario); ?>" required type="text" maxlength="50" placeholder="Nome Completo" name="usuario" id="usuario" readonly>
            </div>
            <div class="col-md-4">
              <label>Sexo</label>
              <select name="sexo" id="sexo" class="form-control" required readonly>
                <?php if($usuario->sexo=="M"): ?>
                  <option value="M" selected>Masculino</option>
                  <option value="F">Feminino</option>
                <?php else: ?>
                  <option value="M">Masculino</option>
                  <option value="F" selected>Feminino</option>
                <?php endif; ?>
              </select>
            </div>  
            <div class="col-md-4">
              <label>Email</label>
              <input class="form-control" value="<?php echo e($usuario->email); ?>" required type="email" maxlength="200" placeholder="Email" name="email" id="email" readonly>
            </div>          
          </div>          

      </div>      
    </div> 

    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Tipo de Usuário</p>

        <div class="row">
          <div class="col-md-12">
          <?php if($usuario->admin=="N"): ?>
            <input type="text" id="admin" value="N" hidden="">
            <input onclick="setAdmin('S')" type="radio" name="rd_admin" id="rd_admin" value="S" readonly><span style="margin-right:10px;"> Usuário Administrador</span>
            <input onclick="setAdmin('N')" type="radio" name="rd_admin" id="rd_admin" value="N" checked readonly><span> Usuário Comum</span>
          <?php else: ?>
            <input type="text" id="admin" value="S" hidden="">
            <input onclick="setAdmin('S')" type="radio" name="rd_admin" id="rd_admin" value="S" checked readonly><span style="margin-right:10px;"> Usuário Administrador</span>
            <input onclick="setAdmin('N')" type="radio" name="rd_admin" id="rd_admin" value="N" readonly><span> Usuário Comum</span>
          <?php endif; ?>
          </div>

        </div>
          
      </div>
    </div>

   
    <div class="row">
      <div id="btn_visualizacao">
        <div class="col-md-6">
          <button id="btn_alterar" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Alterar</button>
        </div>
      </div>
      <div id="btn_alteracao" style="display:none;">
        <div class="col-md-6">
          <button id="btn_cancelar" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span> Cancelar</button>
          <button id="btn_confirmar" class="btn btn-success"><span class="glyphicon glyphicon-okl"></span> Confirmar</button>
        </div>
      </div>
    </div>

</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">

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
  var form = $('<form action="../editar" method="post">' +
                '<input type="hidden" value="'+$('#usuario').val()+'" name="usuario" />' +
                '<input type="hidden" value="'+$('#id').val()+'" name="id" />' +
                '<input type="hidden" value="'+$('#email').val()+'" name="email" />' +
                '<input type="hidden" value="'+$('#sexo').val()+'" name="sexo" />' +
                '<input type="hidden" value="'+$('#admin').val()+'" name="admin" />' +
              '</form>');
              $('body').append(form);
              $(form).submit();  
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


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>