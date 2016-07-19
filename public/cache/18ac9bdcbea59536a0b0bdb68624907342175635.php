

<?php $__env->startSection('titulo','Usuários'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Usuários
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">

      </h3>
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
    </div>
    <div class="box-body">
      <!-- conteudo -->

    <div id="alt_insert" style="display:none;" >
      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" id="alt_foto_prof">
              <p class="text-muted text-center">
                  <input type="file" name="img_alt[]" id="img_alt"  class="inputfile" multiple>
                  <label for="img_alt" id="trocar_foto"><a>Trocar foto</a></label> 
              </p>

               <div id="campos_prof"> 
                <h3 class="profile-username text-center" id="alt_nome_prof">Nome do profile</h3>
                <p class="text-muted text-center" id="alt_status_prof">Status do profile</p>
                <p class="text-muted text-center" id="alt_funcao_prof">função do profile</p>
                <p class="text-muted text-center" id="alt_email_prof">email do profile</p>                
              </div>
              <p class="text-muted text-center"> <strong><a onclick="abrefechaform()"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a></strong></p>
            </div>
          </div>
        </div>

      <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li id="aba_atividades" class=""><a href="#atividades" data-toggle="tab" aria-expanded="false">Atividades</a></li>
              <li id="aba_informacoes" class="active"><a href="#informacoes" data-toggle="tab" aria-expanded="true">Informações</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="atividades">

                <!-- The timeline -->
                <p class="text-muted text-center"> <strong><a onclick=""><span class="glyphicon glyphicon-align-justify"></span> Log completo</a></strong></p>
                <ul class="timeline timeline-inverse" id='timeline_itens'>


                </ul>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane active" id="informacoes">
                
                    <div class="row">
                      <div class="col-md-12">
                        <input type="text" id="id_alt" hidden>
                        <label>Nome</label>
                        <input type="text" class="form-control"  id="usuario_atl" maxlength="50">
                      </div>
                    </div>
                    <div class="row"> 
                      <div class="col-md-2">
                        <label id="desc_tipo_pessoa_alt">Tipo Pessoa</label><br>
                        <label class="switch">
                          <input type="checkbox" checked id="tipo_pessoa_atl"  onclick="mudarpessoa()"> 
                          <div class="slider round"></div>
                        </label>
                      </div>                    
                      <div class="col-md-7" id="div_desc_cpf_cnpj_atl">
                        <label id="desc_cpf_cnpj_atl">CGC</label>
                        <input type="text" onkeypress="mascara(this)" class="form-control" id="cpf_cnpj_atl" maxlength="30">
                        <input type="text" hidden value='999.999.999-99' id="mascada_cgc_alt">
                      </div>       
                      <div class="col-md-3" id="div_dt_nascimento_atl">
                        <label>Nascimento</label>
                        <input type="text" class="form-control"  id="dt_nascimento_atl" maxlength="200">
                      </div> 
                    </div>
                    <div class="row">           
                      <div class="col-md-10" id="div_email_atl">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email_atl" maxlength="200">
                      </div>                    
                       <div class="col-md-2" id="div_admin_alt">
                        <label>Administrador</label><br>
                        <label class="switch">
                          <input type="checkbox" id="admin_atl"> 
                          <div class="slider round"></div>
                        </label>
                      </div>
                    </div>
                    <div class="row" style="margin-top:25px;">
                      <div class="pull-right"> 
                         <button id="salvarAlt" class="btn btn-primary">Salvar Alterações</button> 
                         <button id="btn_cadastrar" style="display:none;" class="btn btn-primary">Cadastrar</button> 
                      </div>                
                     
                      
                    </div>
                  </div>



              </div>
            <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>


      </div>       
    </div>


    <div id="grid" >   

      <div class="row">
        <div class="col-md-12">
          <div class="input-group input-group-sm" >
            <input type="text" name="table_search" class="form-control pull-right" id="filtro" placeholder="Filtro de busca">
            <input id="id" hidden>
            <div class="input-group-btn">
              <button id="btn-filtro" onclick="buscar()" name="btn-filtro" class="btn btn-default"><i class="fa fa-search"></i></button>
              <input type="text" id="admin" value="<?php echo e(Auth('admin')); ?>" hidden="">
            </div>
          </div>
        </div>
      </div>

      <hr>
      
      <div class="row">
        <div class="col-md-12">

          <div class="box-body table-responsive no-padding">
          <div id="loading-div" style="width:100%;" class="centro">
            <img src="<?php echo e(PASTA_PUBLIC); ?>/template/img/loading.gif">
          </div>
           <table class="table table-striped" id="tabela"></table>
         </div>
        </div>
      </div>
      <div class="row">
        <hr>
        <div class="col-md-12"> 
        <?php if(Auth('admin')=="S"): ?>
          <button class="btn btn-primary" id="novo_reg"><span class="glyphicon glyphicon-plus"></span>  Cadastar</button>
        <?php endif; ?>
        </div>
      </div>

    </div>
     <!-- /.box-header -->
     

    </div>
    <div class="box-footer">
      <!-- rodapé -->
    </div>
  </div>
</div>

<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">

$('#img_alt').on('change', function() {
    nova_foto = $('#img_alt');
    _usuario  = $('#id_alt').val();
    formData = new FormData();
    formData.append('nova_foto', nova_foto[0].files[0]);
    formData.append('usuario', _usuario);

    $.ajax({  
        url: "usuarios/trocafotoperfil",  
        type: 'POST',   
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {  
          $('#alt_foto_prof').attr('src','<?php echo e(PASTA_PUBLIC); ?>/'+data); 
        }  
    });  

}); 

function mascara(t)
 {
   var i = t.value.length;
   var mask = document.getElementById('mascada_cgc_alt').value;
   var saida = mask.substring(1,0);
   var texto = mask.substring(i);

   if (texto.substring(0,1) != saida)
   {
      t.value += texto.substring(0,1);
   }
 }
$("#filtro").keyup(function(event)
{
    if(event.keyCode == 13)
    {
        $("#btn-filtro").click();
    }
});

$( document ).ready(function()
{
    $("#btn-filtro").click();
});

function buscar()
{
  id = <?php echo e(Auth('id')); ?>;
  $("#loading-div").show();
  $("#loading-div").show();  
  $("#tabela").hide();
  filtro = $('#filtro').val();
  $.ajaxSetup({ cache: false });
  $.getJSON("usuarios/selectusuarios/"+filtro, function(data)
  {    
    $("#tabela tr").remove();
    $('#tabela').append(
      '<tr>'+
        '<th></th>'+  
        '<th>Nome</th>'+  
        '<th>Email</th>'+  
        '<th>Função</th>'+   
        '<th class="centro pull-right"></span></th>'+  
      '</tr>');
    $.each(data, function(index,result)
    {      
      html=
      '<tr>'+
          '<td><img  class="img-circle" src="<?php echo e(PASTA_PUBLIC); ?>/'+result.foto+'" style="width:50px;"></td>'+
          '<td style="padding-top: 22px;">'+result.usuario+'</td>'+
          '<td style="padding-top: 22px;">'+result.email+'</td>'+
          '<td style="padding-top: 22px;">'+result.funcao+'</td>';
      html+='<td class="centro" style="widht:10px;padding-top: 22px;">';
      if(($('#admin').val()=="S")||(<?php echo e(Auth('id')); ?>==result.id))
        html+='<a title="Editar" onclick="alterar('+result.id+')" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>';
      else
        html+='<a disabled title="Necessário permissão para efetuar esta operação" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>';

      if(($('#admin').val()=="S")&&(result.logado=="N"))
         html+='<a title="Excluir" onclick="msgexcluir('+result.id+')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>';
      else
         html+='<a  disabled title="Necessário permissão para efetuar esta operação" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>';

       html+='</td>'+
      '</tr>';
      $('#tabela tr:last').after(html);
    });
  });
  $("#tabela").toggle(150);
  $("#loading-div").toggle(150);
}


function msgexcluir(id)
{  
  $('#titulo_msg1').html('Confirmação');
  $('#msg_msg1').html('Deseja excluir este registro ?');
  $('#mensagem1').modal('show');   
  $('#id').val(id);
}

function excluir()
{  
  id = $('#id').val();
  $.post("usuarios/excluir",
  {
    id: id
  },
  function(resultado)
  {
    $('#titulo_msg2').html('Aviso');
    if(resultado=="SIM")
      $('#msg_msg2').html('Registro excluido');
    else
      $('#msg_msg2').html('Registro não excluido.');
    $('#mensagem2').modal('show');     
  });
  $("#btn-filtro").click();
}

function alterar(id)
{
  $('#btn_cadastrar').hide();
  $('#salvarAlt').show();
  $.ajaxSetup({ cache: false });
  $.getJSON("usuarios/encontrausuario/"+id, function(data)
  {    
    $.each(data, function(index,usuarios)
    {      
      $('#alt_nome_prof').html(usuarios.usuario);
      $('#alt_funcao_prof').html(usuarios.descricao);
      $('#alt_email_prof').html(usuarios.email);
      $('#campos_prof').show();
      $('#alt_foto_prof').attr('src','<?php echo e(PASTA_PUBLIC); ?>/'+usuarios.foto);
      if(usuarios.logado=='S')
        $('#alt_status_prof').html('<i class="fa fa-circle text-success"></i> Online');
      else
        $('#alt_status_prof').html('<i class="fa fa-circle text-danger"></i> Offline');     
      $('#id_alt').val(id);
      montar_timeline(id);

      $('#usuario_atl').val(usuarios.usuario);
      $('#tipo_atl').val(usuarios.tipopessoa);
      $('#email_atl').val(usuarios.email);
      if(usuarios.admin=="S")
        $('#admin_atl').prop('checked', true); 
      else
        $('#admin_atl').prop('checked', false); 
      if(usuarios.tipopessoa=="J")
      {
        $('#tipo_pessoa_atl').prop('checked', false);        
        $('#desc_cpf_cnpj_atl').html('CNPJ');
        $('#desc_tipo_pessoa_alt').html('Pessoa jurídica');
        $("#div_desc_cpf_cnpj_atl").removeClass();
        $("#div_desc_cpf_cnpj_atl").addClass('col-md-10');
        $("#div_dt_nascimento_atl").hide();
        $("#mascada_cgc_alt").val('99.999.999/9999-99');
      }
      else
      {
        $('#tipo_pessoa_atl').prop('checked', true);
        $("#div_desc_cpf_cnpj_atl").removeClass();
        $("#div_desc_cpf_cnpj_atl").addClass('col-md-7');
        $("#div_dt_nascimento_atl").show();
        $('#desc_cpf_cnpj_atl').html('CPF');   
        $('#desc_tipo_pessoa_alt').html('Pessoa física'); 
        $("#mascada_cgc_alt").val('999.999.999-99');
      }

      if($('#admin').val()=="S")
      {
        $("#div_email_atl").removeClass();
        $("#div_email_atl").addClass('col-md-10');
        $("#div_admin_alt").show();
      }
      else
      {
        $("#div_email_atl").removeClass();
        $("#div_email_atl").addClass('col-md-12');
        $("#div_admin_alt").hide();
      }

      $('#cpf_cnpj_atl').val(usuarios.CPF_CNPJ);
      $('#dt_nascimento_atl').val(usuarios.dtnascimento);
      
      // foto
    });
  });
 
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}

function mudarpessoa()
{
  $("#cpf_cnpj_atl").val(null);
  if($('#tipo_pessoa_atl').is(':checked'))
  {
    $('#desc_cpf_cnpj_atl').html('CPF');
    $('#desc_tipo_pessoa_alt').html('Pessoa jurídica');
    $("#div_desc_cpf_cnpj_atl").removeClass();
    $("#div_desc_cpf_cnpj_atl").addClass('col-md-7');
    $("#div_dt_nascimento_atl").show();
    $("#mascada_cgc_alt").val('999.999.999-99');
  }
  else
  {  
    $('#desc_cpf_cnpj_atl').html('CNPJ');       
    $('#desc_tipo_pessoa_alt').html('Pessoa física'); 
    $("#div_desc_cpf_cnpj_atl").removeClass();
    $("#div_desc_cpf_cnpj_atl").addClass('col-md-10');
    $("#div_dt_nascimento_atl").hide();
    $("#mascada_cgc_alt").val('99.999.999/9999-99');
  }
}

function montar_timeline(id)
{
  $('#timeline_itens').html('');
  $.ajaxSetup({ cache: false });
  $.getJSON("log/selectlog/"+id, function(data)
  {      
    $.each(data, function(index,log)
    {     
       $('#timeline_itens').append( '<li><i class="fa bg-blue"></i>'+
                                    '<div class="timeline-item">'+ 
                                       '<span class="time"><div id="hr_atividade">'+log.created_at+'</div></span>'+ //formatar
                                       '<div class="timeline-body">'+log.descricao+'</div>'+                     
                                   '</div></li>');
    });
  }); 
}


function abrefechaform()
{
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}


$('#salvarAlt').on('click',function()
{
  dados = new FormData();
  dados.append('id', $('#id_alt').val());
  dados.append('email', $('#email_atl').val());
  dados.append('usuario', $('#usuario_atl').val());
  if($('#tipo_pessoa_atl').is(':checked'))
    dados.append('tipo', 'F');
   else
    dados.append('tipo', 'J');
  dados.append('cgc', $('#cpf_cnpj_atl').val());
  dados.append('dt_nascimento', $('#dt_nascimento_atl').val());
  if($('#admin_atl').is(':checked'))
    dados.append('admin', 'S');
  else
    dados.append('admin', 'N');
  $.ajaxSetup({ cache: false });
  $.ajax({  
        url: "usuarios/alterar",  
        type: 'POST',   
        data: dados,
        processData: false,
        contentType: false,
        success: function (result) 
        {  
          if(result=="NAO")
          {
            $('#titulo_msg2').html('Aviso');
            $('#msg_msg2').html('Registro não alterado');
            $('#mensagem2').modal('show');
          }
          abrefechaform();
          buscar();
        }  
  });  
});


$('#novo_reg').on('click', function() 
{
  limparcampos();
  $('#campos_prof').hide();
  $('#aba_informacoes').hide();
  $('#trocar_foto').hide();
  $('#salvarAlt').hide();
  $('#btn_cadastrar').show();
  $('#aba_atividades').hide();
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
});

function limparcampos()
{
  $('#id_alt').val('');
  $('#usuario_atl').val('');
  $('#id_alt').val('');
  $('#cpf_cnpj_atl').val('');
  $('#email_atl').val('');
  $('#dt_nascimento_atl').val('');
  $('#admin_atl').prop('checked', false); 
  $('#desc_tipo_pessoa_alt').html('Pessoa Física');
  $('#desc_cpf_cnpj_atl').html('CPF');
  $('#alt_foto_prof').attr('src','<?php echo e(PASTA_PUBLIC); ?>/uploads/fotos_profile/user.png');
}



$('#btn_cadastrar').on('click', function() 
{
  if(($('#email_atl').val()!="")&&($('#usuario_atl').val()!=""))
  {
      dados = new FormData();
      dados.append('email', $('#email_atl').val());
      dados.append('usuario', $('#usuario_atl').val());
      
      if($('#tipo_pessoa_atl').is(':checked'))
        dados.append('tipopessoa', 'F');
       else
        dados.append('tipopessoa', 'J');
      dados.append('CPF_CNPJ', $('#cpf_cnpj_atl').val());
      dados.append('dtnascimento', $('#dt_nascimento_atl').val());
      if($('#admin_atl').is(':checked'))
        dados.append('admin', 'S');
      else
        dados.append('admin', 'N');
   
        $.ajax({  
            url: "usuarios/cadastrar",  
            type: 'POST',   
            data: dados,
            processData: false,
            contentType: false,
            success: function (data) {}  
        });
        buscar();
        abrefechaform();
    }
    else
    {
      $('#titulo_msg2').html('Aviso');
      $('#msg_msg2').html('Preencha ao menos o email e o nome do usuário');
      $('#mensagem2').modal('show');     
    }
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        <button type="button" onclick="excluir()" data-dismiss="modal" class="btn btn-primary">Sim</button>
      </div>
    </div>    
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mensagem2" role="dialog">
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title centro">
          <div id="titulo_msg2"></div>
        </h4>
      </div>
      <div class="modal-body">
        <p><div id="msg_msg2"></div></p>
      </div>
      <div  class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
      </div>
    </div>    
  </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>