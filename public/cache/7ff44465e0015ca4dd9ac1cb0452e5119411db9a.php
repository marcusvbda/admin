<?php $__env->startSection('titulo','Usuários'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Usuários
  <small>Novo usuário</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
  <li><a><i class="glyphicon glyphicon-plus"></i> Novo usuário</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>

<div class="col-md-12">
  <!-- <form action="<?php echo e(asset('usuarios/store')); ?>" method="POST" id="formulario"> -->
    <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Dados do Usuário</p>
        <div class="box-tools pull-right">
        </div>

      
          <div class="row" >
            <div class="col-md-4">
              <input type="text" id="empresas" hidden name="empresas">
              <label>Nome Completo</label>
              <input class="form-control" required type="text" maxlength="50" placeholder="Nome Completo" name="usuario" id="usuario">
            </div>
            <div class="col-md-4">
              <label>Sexo</label>
              <select name="sexo" id="sexo" class="form-control" required>
                <option value="M" selected>Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>  
            <div class="col-md-4">
              <label>Email</label>
              <input class="form-control" required type="email" maxlength="200" placeholder="Email" name="email" id="email">
            </div>          
          </div>
          <div class="row" >
            <div class="col-md-6">
              <label>Senha</label>
              <input class="form-control" required type="password" maxlength="20" placeholder="Senha" name="senha" id="senha">
            </div>
            <div class="col-md-6">
              <label>Confirme a Senha</label>
              <input class="form-control" required type="password" maxlength="20" placeholder="Confirme a Senha" name="confirme_senha" id="confirme_senha">
            </div>          
          </div>      

      </div>      
    </div> 
</div>

<div class="col-md-8" style="display:none;" id="empresas_selecao">
    <div class="box">
      <div class="box-header with-border">
          <p class="title_box">Empresas Selecionadas (<span id="qtde_selecionada">0</span>) : <strong id="nome_rede"></strong></p>     

            
              <div class="row">
                <div class="box-body table-responsive no-padding">  
                  <div class="col-md-12">
                     <table class="table table-striped" id="tabela"></table>
                  </div>
                </div>
              </div>        

        </div>
    </div>
</div> 

<div class="col-md-12" id="div_tipo">
  <div class="box" style="padding-bottom:20px;">
      <div class="box-header with-border">
        <p class="title_box">Tipo de Usuário</p>

        <div class="row">
          <div class="col-md-12">
            <input type="text" id="admin" value="N" hidden="">
            <input onclick="setAdmin('S')" type="radio" name="rd_admin" id="rd_admin" value="S"><span style="margin-right:10px;"> Usuário Administrador</span>
            <input onclick="setAdmin('N')" type="radio" name="rd_admin" id="rd_admin" value="N" checked><span> Usuário Comum</span>
          </div>

        </div>
          
      </div>
    </div>   
</div>

 

<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      <button id="btn_confirmar" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Cadastrar</button>
    </div>
  </div>
</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">

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
        $.get('usuarioexiste/' + $('#email').val(),function(data)
        {
            if(data=='SIM')
            {
              mensagem_validacao("Email em uso por outro usuário !");
              return false;
            }
            else
            {
              cadastrar();
            }            
        });
      }
  }
    
}); 

function cadastrar()
{
  admin_rede = "<?php echo e(Auth('admin_rede')); ?>";
  var form ='<form action="store" method="post">' +
                '<input type="hidden" value="'+$('#usuario').val()+'" name="usuario" />' +
                '<input type="hidden" value="'+$('#email').val()+'" name="email" />' +
                '<input type="hidden" value="'+$('#sexo').val()+'" name="sexo" />' +
                '<input type="hidden" value="'+$('#senha').val()+'" name="senha" />' +
                '<input type="hidden" value="'+$('#admin').val()+'" name="admin" />';
  if(admin_rede="S")
      form +='<input type="hidden" value="'+$('#empresas').val()+'" name="empresas" /><form>';
  else
      form +='</form>';
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


jQuery( document ).ready(function( $ ) 
{
   $('#empresas').val(null); 
  admin_rede = "<?php echo e(Auth('admin_rede')); ?>";
  if(admin_rede=="S")
  {
    $('#empresas_selecao').show();
    $("#div_tipo").removeClass("col-md-12");
    $("#div_tipo").addClass("col-md-4");
    atualiza_tabela_selecao();
  }
});

var qtde_registros = 1;
function atualiza_tabela_selecao()
{ 
  $('#empresas').val(null); 
  var qtde_selecionado = 0;
  var nome_rede = "";
  $.getJSON("../empresa/BuscaEmpresas/", function(data) 
  {
        $("#tabela tr").remove();
      $('#tabela').append(
         '<tr>'+                        
          '<th></th>'+                     
          '<th>Série</th>'+                     
          '<th>Razão Social</th>'+
          '<th>Nome Fantasia</th>'+
          '<th>CNPJ</th>'+
      '</tr>');
      $.each(data, function(index,r)
      {      
        html="";
          if(r.selecionado=="S")   
          {         
            html +='<tr style="background-color:#c4ffc4;" onclick="desmarcar('+r.id+');">'+
              '<td><span style="color:green;" class="glyphicon glyphicon-check"></span></td>';
            qtde_selecionado++;
            $('#empresas').val($('#empresas').val()+r.id+','); 
        }
          else
            html +='<tr style="background-color:#ffd1d1;" onclick="marcar('+r.id+');">'+
              '<td><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>';
            
          html+=  '<td>'+r.serie+'</td>'+
            '<td>'+r.razao+'</td>'+
            '<td>'+r.CNPJ_CPF+'</td>'+
            '<td>'+r.nome+'</td>'+
          '</tr>';
        $('#tabela tr:last').after(html);
        nome_rede = r.nome_rede;      
        qtde_registros++;
      });
      $('#qtde_selecionada').html(qtde_selecionado);
      $('#nome_rede').html(nome_rede);
    }).fail(function(d) {
        msg("ERRO","Erro ao consultar empresas");
    });
}

function desmarcar(id)
{ 
  var qtde_selecionado = 0;
  var nome_rede = "";
  var empresas = $('#empresas').val();
  $.getJSON("../empresa/BuscaEmpresasEspecificas/DESMARCAR/"+'/'+id+'/'+empresas, function(data) 
  {
      $('#empresas').val(null);     
      $("#tabela tr").remove();
      $('#tabela').append(
         '<tr>'+                        
          '<th></th>'+                     
          '<th>Série</th>'+                     
          '<th>Razão Social</th>'+
          '<th>Nome Fantasia</th>'+
          '<th>CNPJ</th>'+
      '</tr>');
      $.each(data, function(index,r)
      {      
        html="";
          if(r.selecionado=="S")   
          {         
            html +='<tr style="background-color:#c4ffc4;" onclick="desmarcar('+r.id+');">'+
              '<td><span style="color:green;" class="glyphicon glyphicon-check"></span></td>';
            qtde_selecionado++;
            $('#empresas').val($('#empresas').val()+r.id+','); 
        }
          else
            html +='<tr style="background-color:#ffd1d1;" onclick="marcar('+r.id+');">'+
              '<td><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>';
            
          html+=  '<td>'+r.serie+'</td>'+
            '<td>'+r.razao+'</td>'+
            '<td>'+r.CNPJ_CPF+'</td>'+
            '<td>'+r.nome+'</td>'+
          '</tr>';
        $('#tabela tr:last').after(html);
        nome_rede = r.nome_rede;      
        qtde_registros++;
      });
      $('#qtde_selecionada').html(qtde_selecionado);
      $('#nome_rede').html(nome_rede);
    }).fail(function(d) {
        msg("ERRO","Erro ao consultar empresas");
    });
}

function marcar(id)
{ 
  var qtde_selecionado = 0;
  var nome_rede = "";
  var empresas = $('#empresas').val();
  $.getJSON("../empresa/BuscaEmpresasEspecificas/MARCAR/"+id+'/'+empresas, function(data) 
  {
      $('#empresas').val(null); 
      $("#tabela tr").remove();
      $('#tabela').append(
         '<tr>'+                        
          '<th></th>'+                     
          '<th>Série</th>'+                     
          '<th>Razão Social</th>'+
          '<th>Nome Fantasia</th>'+
          '<th>CNPJ</th>'+
      '</tr>');
      $.each(data, function(index,r)
      {      
        html="";
          if(r.selecionado=="S")   
          {         
            html +='<tr style="background-color:#c4ffc4;" onclick="desmarcar('+r.id+');">'+
              '<td><span style="color:green;" class="glyphicon glyphicon-check"></span></td>';
            qtde_selecionado++;
            $('#empresas').val($('#empresas').val()+r.id+','); 
        }
          else
            html +='<tr style="background-color:#ffd1d1;" onclick="marcar('+r.id+');">'+
              '<td><span style="color:red;" class="glyphicon glyphicon-unchecked"></span></td>';
            
          html+=  '<td>'+r.serie+'</td>'+
            '<td>'+r.razao+'</td>'+
            '<td>'+r.CNPJ_CPF+'</td>'+
            '<td>'+r.nome+'</td>'+
          '</tr>';
        $('#tabela tr:last').after(html);
        nome_rede = r.nome_rede;      
        qtde_registros++;
      });
      $('#qtde_selecionada').html(qtde_selecionado);
      $('#nome_rede').html(nome_rede);
    }).fail(function(d) {
        msg("ERRO","Erro ao consultar empresas");
    });
}


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>