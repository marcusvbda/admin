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
<body class="skin-green sidebar-mini fixed" cz-shortcut-listen="true">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{asset()}}" class="logo">
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
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-bottom: 20px;">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-danger">1</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você possui {{1}} mensagens</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                                
                <!-- mesagem -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{imagem}}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Nome do remetente
                        <small><i class="fa fa-clock-o"></i> {{ 1 }} dia atrás</small>
                      </h4>
                      <p> texto</p>
                    </a>
                  </li>
                  <!-- mensagem -->



                </ul>
              </li>
              <li class="footer"><a href="#">Ver todas mensagens</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-bottom: 20px;">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger"> {{ 0 }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você tem {{ 0 }} notificações</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li> -->
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todas</a></li>
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="http://msalx.veja.abril.com.br/2015/04/25/2141/pe6Cx/jared-leto-caracterizado-de-coringa-em-primeira-foto-oficial-de-esquadrao-suicida-original.jpeg?1430008851"" class="user-image" alt="User Image">
              <span class="hidden-xs">{{limitarTexto(Auth('usuario'),20)}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="http://msalx.veja.abril.com.br/2015/04/25/2141/pe6Cx/jared-leto-caracterizado-de-coringa-em-primeira-foto-oficial-de-esquadrao-suicida-original.jpeg?1430008851"" class="img-circle" alt="User Image">

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
            <a href="#" data-toggle="control-sidebar" style="padding-bottom: 20px;"><i class="fa fa-gears" ></i></a>
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
      <div class="user-panel">
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Busca...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Principal</li>

        <!-- itens menu -->
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-inbox"></i> <span>Tabelas Auxiliáres</span>
            </a>
            <ul class="treeview-menu">
              <li>
                  <a href="#">
                    <i class="glyphicon glyphicon-user"></i> <span>Funcionários</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('usuarios/funcoes')}}"><i class="glyphicon glyphicon-road"></i> <span>Funções</span></a></li>
                  </ul>
              </li>
            </ul>
          </li>



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
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão</b>00.00.00
    </div>
    <strong><a href="#">SITE DA EMPRESA</a></strong> Todos os direitos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  
    <!-- Tab panes -->
    <div class="tab-content">

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