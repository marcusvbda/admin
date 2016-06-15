<?php $__env->startSection('titulo','Usuários'); ?>

<?php $__env->startSection('topo'); ?>
<h1>Usuários
  <small>Listagem e cadastro</small>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(asset('')); ?>"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="<?php echo e(asset('usuarios')); ?>"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('conteudo'); ?>
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">

      </h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div>
    </div>
    <div class="box-body">
      <!-- conteudo -->

    <div id="alt_insert" style="display:none;" >
      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" id="alt_foto_prof" alt="User profile picture">
              <input type="text" id="id_alt" hidden>
              <h3 class="profile-username text-center" id="alt_nome_prof">Nome do profile</h3>
              <p class="text-muted text-center" id="alt_status_prof">Status do profile</p>
              <p class="text-muted text-center" id="alt_funcao_prof">função do profile</p>
              <p class="text-muted text-center" id="alt_email_prof">email do profile</p>
            </div>
          </div>
        </div>















      <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#atividades" data-toggle="tab" aria-expanded="true">Atividades</a></li>
              <li class=""><a href="#informacoes" data-toggle="tab" aria-expanded="false">Informações</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="atividades">

                <!-- The timeline -->
                <ul class="timeline timeline-inverse" id='timeline_itens'>


                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="informacoes">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
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
          <button class="btn btn-primary" onclick="cadastrar()" id="novo_reg"><span class="glyphicon glyphicon-plus"></span>  Cadastar</button>
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
  admin = document.getElementById('admin').value;
  $("#loading-div").show();
  $("#loading-div").show();  
  $("#tabela").hide();
  var filtro = document.getElementById("filtro").value;
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
          '<td><img  class="img-circle" src="<?php echo e(PASTA_PUBLIC); ?>/template/img/'+result.foto+'" style="width:50px;"></td>'+
          '<td style="padding-top: 22px;">'+result.usuario+'</td>'+
          '<td style="padding-top: 22px;">'+result.email+'</td>'+
          '<td style="padding-top: 22px;">'+result.funcao+'</td>';
      html+='<td class="centro" style="widht:10px;padding-top: 22px;">';
      if(admin=="S")
      {
        html+='<a title="Editar" onclick="alterar('+result.id+')" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>'+
          '<a title="Excluir" onclick="msgexcluir('+result.id+')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>';
      }
      else
      {
        html+='<a disabled title="Necessário permissão de administrador para efetuar esta operação" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>'+
          '<a disabled title="Necessário permissão de administrador para efetuar esta operação" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>';          
      }
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
  document.getElementById('id').value=id;
}

function excluir()
{  
  id = document.getElementById('id').value;
  $.post("../funcoes/excluir",
  {
    id: id
  },
  function(resultado)
  {
    $('#titulo_msg2').html('Aviso');
    if(resultado=="SIM")
      $('#msg_msg2').html('Registro excluido');
    else
      $('#msg_msg2').html('Registro não excluido pois está em uso.');
    $('#mensagem2').modal('show');     
  });
  $("#btn-filtro").click();
}

function alterar(id)
{
  $.ajaxSetup({ cache: false });
  $.getJSON("usuarios/encontrausuario/"+id, function(data)
  {    
    $.each(data, function(index,usuarios)
    {      
      $('#alt_nome_prof').html(usuarios.usuario);
      $('#alt_funcao_prof').html(usuarios.descricao);
      $('#alt_email_prof').html(usuarios.email);
      $('#alt_foto_prof').attr('src','<?php echo e(PASTA_PUBLIC); ?>/template/img/'+usuarios.foto);
      if(usuarios.logado=='S')
        $('#alt_status_prof').html('<i class="fa fa-circle text-success"></i> Online');
      else
        $('#alt_status_prof').html('<i class="fa fa-circle text-danger"></i> Offline');      
      document.getElementById('id_alt').value=usuarios.id;
      montar_timeline(id);
    });
  });
 
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}

function montar_timeline(id)
{
  timeline = "";
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

function cadastrar()
{    
  document.getElementById('descricao_alt').value='';
  document.getElementById('id_alt').value='';
  $('#titulo_alt').html('Cadastrar função');
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
}

$("#usuario_alt").keyup(function(event)
{
    if(event.keyCode == 13)
    {
        $("#btn_confirma_alt").click();
    }
});

function confirmaalteracao()
{
  id        = document.getElementById('id_alt').value;
  descricao = document.getElementById('usuario_alt').value;  
  $('#alterar-modal').modal('hide'); 
  $.post("../funcoes/alterar_inserir",
  {
    id: id,
    descricao: descricao
  },
  function(resultado)
  {
    $('#titulo_msg2').html('Aviso');
    if(resultado=="ALTERADO")
      $('#msg_msg2').html('Registro alterado');
    if((resultado=="NAOALTERADO"))
      $('#msg_msg2').html('Registro não alterado pois está em uso.');
    if(resultado=="INSERIDO")
      $('#msg_msg2').html('Registro inserido');
    if((resultado=="NAOINSERIDO"))
      $('#msg_msg2').html('Registro não inserido, verifique...');
    $('#mensagem2').modal('show');  
  });
  $("#btn-filtro").click();
  abrefechaform();
}

function abrefechaform()
{
  $('#alt_insert').toggle(150);
  $('#grid').toggle(150);
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