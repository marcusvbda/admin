<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('titulo')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{PASTA_PUBLIC}}/template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{PASTA_PUBLIC}}/template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="{{PASTA_PUBLIC}}/template/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="{{PASTA_PUBLIC}}/template/bootstrap/css/custom.css">
<style type="text/css"></style></head>
<body class="skin-green sidebar-mini fixed" cz-shortcut-listen="true" style="height:100%;overflow:auto;">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{asset('')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AD</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>AD</b>MIN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>





      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{PASTA_PUBLIC.'/'.Auth('foto')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{limitarTexto(Auth('usuario'),20)}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{PASTA_PUBLIC.'/'.Auth('foto')}}" class="img-circle" alt="User Image">

                <p>
                  {{limitarTexto(Auth('usuario'),20)}}
                  <small>{{Auth('email')}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center pull-right">
                    <a href="#">Amigos</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <button data-toggle="modal" data-target="#sair" class="btn btn-danger">Sair</button>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar" style="padding-bottom: 20px;"><i class="glyphicon glyphicon-envelope" ></i></a>
          </li>
        </ul>
      </div>




    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
      <!-- Sidebar user panel -->
      
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Principal</li>

        <!-- itens menu -->
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-inbox"></i> <span>Cadastros</span>
            </a>
            <ul class="treeview-menu">
              <li>
                  <a href="{{asset('clientes')}}"><i class="glyphicon glyphicon-user"></i> <span>Clientes</span></a>                  
              </li>
              <li>
                  <a href="#">
                    <i class="glyphicon glyphicon-erase"></i> <span>Produtos</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('produtos')}}"><i class="glyphicon glyphicon-erase"></i> <span>Produtos</span></a></li>
                  </ul>
                  @if(Auth('admin')=="S")
                    <a href="{{asset('usuarios')}}"><i class="glyphicon glyphicon-user"></i> <span>Usuários</span></a>   
                  @endif              

              </li>

            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-align-right"></i> <span>Relatórios</span>
            </a>
            <ul class="treeview-menu">
                    <li><a href="{{asset('relatorios/customizados')}}"><i class="glyphicon glyphicon-equalizer"></i> <span>Customizados</span></a></li>
            </ul>
          </li>

          @if(Auth('admin')=='S')
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-wrench"></i> <span>Configurações</span>
            </a>
            <ul class="treeview-menu">
                    <li><a href="{{asset('configuracoes/parametros')}}"><i class="glyphicon glyphicon-wrench"></i> <span>Parametros de sistema</span></a></li>
            </ul>
          </li> 
          @endif



        <!-- itens menu -->

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @yield('topo')
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('conteudo')

    </section>
    <!-- /.content -->
  </div>
</div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão</b> 01.00.00
    </div>
    <strong><a href="#">SITE DA EMPRESA</a></strong> Todos os direitos reservados.
  </footer>
  <!-- Control Sidebar -->


  <aside class="control-sidebar control-sidebar-dark"  >
  
    <!-- Tab panes -->
    <div class="tab-content" > 
        <div id="chat_usuarios">
            <!-- usuarios -->
        </div> 


        <div id="chat_mensagens" style="display:none;">
          <a onclick="fechar_chat()"><span class="glyphicon glyphicon-arrow-left"></span> Lista de usuários</a>

              <input type="number" id="txt_id_destinatario" name="txt_id_destinatario" hidden >
          

          <div class="row">
            <div class="content">
              <div style='overflow-x:none;overflow-y:scroll;height:450px;padding:25px;' id="campo_mensagens">


              </div>
            </div>
          </div>

          <div class="row">
            <div class="content">
              <div class="input-group">
                        <input type="text" name="mensagem" placeholder="Digite a mensagem..." id="txtmsg" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-flat" id="btn_enviar" onclick="enviar()">Enviar</button>
                        </span>
                        </div>
            </div>
          </div>


        </div>
    </div>


  </aside>




  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.0 -->
<script async="" src="//www.google-analytics.com/analytics.js"></script>
<script src="{{PASTA_PUBLIC}}/template/plugins/jQuery/jquery.min.js"></script>


<script src="{{PASTA_PUBLIC}}/template/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{PASTA_PUBLIC}}/template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{PASTA_PUBLIC}}/template/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{PASTA_PUBLIC}}/template/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{PASTA_PUBLIC}}/template/dist/js/demo.js"></script>


</body></html>





<!-- Modal -->
  <div class="modal fade" id="sair" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmação</h4>
        </div>
        <div class="modal-body">
          <p>Deseja mesmo sair do sistema ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
          <a href="{{asset('usuarios/sair')}}" class="btn btn-danger" >Sim</a>
        </div>
      </div>
      
    </div>
  </div>


  
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
      <div  class="modal-footer" id="btn_msg1">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        <button  id="btn_confirmar_mensagem1"  type="button" onclick="excluir()" data-dismiss="modal" class="btn btn-primary">Sim</button>
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
        <button  id="btn_voltar_mensagem2" type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
      </div>
    </div>    
  </div>
</div>


<script type="text/javascript">
$("#txtmsg").keyup(function(event)
{
    if(event.keyCode == 13)
    {
        $("#btn_enviar").click();
    }
});

// setInterval(function(){ atualizachat($('#txt_id_destinatario').val())}, 10000);
// carrega usuarios
// $(document).ready(function() 
// {
//   $('#chat_usuarios').html('');
//   $.getJSON("inicio/UsuariosChat", function(data)
//   {
//     $.each(data, function(usuarios,us)
//     {
//       $('#chat_usuarios').append(
//         '<a onclick="abrir_chat('+us.id+')">'+
//            '<img  class="img-circle" src="{{PASTA_PUBLIC}}/'+us.foto+'" style="width:40px;">'+us.usuario+
//         '</a>'+
//         '<br>');
//     });
//   });
// });

function abrir_chat(id)
  {
    $('#campo_mensagens').html(null);
    $('#txt_id_destinatario').val(id);
    atualizachat(id);
    $('#chat_usuarios').toggle(150);
    $('#chat_mensagens').toggle(150);
    $("#campo_mensagens").animate({ scrollTop: 9999 }, "slow");
  } 

  function fechar_chat()
  {
    $('#chat_usuarios').toggle(150);
      $('#chat_mensagens').toggle(150);
  } 

  function atualizachat(id)
  {
    var usuario_logado = {{Auth('id')}};
    $('#campo_mensagens').html(null);
    $.getJSON("inicio/mensagens/"+id, function(data)
      {     
        $.each(data, function(mensagens,msg)
        {      
          if(msg.id_destinatario==usuario_logado)
          {
            $('#campo_mensagens').append(
              '<div class="direct-chat-msg">'+
                            '<div class="direct-chat-info clearfix">'+
                              '<span class="direct-chat-name pull-left">'+msg.remetente+'</span>'+
                            '<span class="direct-chat-timestamp pull-right">'+msg.dt_envio+'</span>'+
                            '</div>'+
                          '<img class="direct-chat-img" src="{{PASTA_PUBLIC}}/'+msg.foto_remetente+'" alt="message user image">'+
                          '<div class="direct-chat-text">'+
                            msg.mensagem+
                        '</div>'+
                      '</div>'
              );
          }
          else
          {
            $('#campo_mensagens').append(
              '<div class="direct-chat-msg right">'+
                        '<div class="direct-chat-info clearfix">'+
                          '<span class="direct-chat-name pull-right">'+msg.remetente+'</span>'+
                          '<span class="direct-chat-timestamp pull-left">'+msg.dt_envio+'</span>'+
                        '</div>'+
                        '<img class="direct-chat-img" src="{{PASTA_PUBLIC}}/'+msg.foto_remetente+'" alt="message user image">'+
                        '<div class="direct-chat-text">'+
                           msg.mensagem+
                        '</div>'+
                      '</div>'
              );
          } 
            
        });
    });
  }

  function enviar()
  {
    $.getJSON("inicio/EnviarMensagem/"+$('#txtmsg').val()+'/'+$('#txt_id_destinatario').val(), function(data)
    {
        atualizachat($('#txt_id_destinatario').val());
        $("#campo_mensagens").animate({ scrollTop: 9999 }, "slow");
    });
    $("#txtmsg").val(null);

  }
</script>
