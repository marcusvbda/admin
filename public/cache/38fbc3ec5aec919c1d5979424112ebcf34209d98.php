<?php $__env->startSection('titulo','Produtos'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Produtos
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('admin/inicio')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('admin/produtos')); ?>"><i class="glyphicon glyphicon-erase"></i> Produtos</a></li>
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
<script src="<?php echo e(PASTA_PUBLIC); ?>/template/plugins/jQuery/crud.js"></script>
<script type="text/javascript">
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
function abrefechaform()
{
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}
</script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.principal.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>