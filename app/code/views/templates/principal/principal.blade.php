<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - @yield('titulo')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset()}}/template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset()}}template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="{{asset()}}template/dist/css/skins/_all-skins.min.css">
  <script src="{{asset()}}template/plugins/jQuery/jquery.min.js"></script>
  <script src="{{asset()}}assets/js/custom.js"></script>
  <link rel="stylesheet" href="{{asset()}}template/bootstrap/css/circulos.css">
  <link rel='icon' href="{{asset('template/img/icone.ico')}}" type='image/gif'>


<!-- DATATABLES -->
<script src="{{asset()}}assets/datatables/custom.datatables.js"></script>
<script src="{{asset()}}assets/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset()}}assets/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{asset()}}assets/datatables/dataTables.buttons.min.js"></script>
<script src="{{asset()}}assets/datatables/buttons.bootstrap.min.js"></script>
<script src="{{asset()}}assets/datatables/jszip.min.js"></script>
<script src="{{asset()}}assets/datatables/pdfmake.min.js"></script>
<script src="{{asset()}}assets/datatables/vfs_fonts.js"></script>
<script src="{{asset()}}assets/datatables/buttons.html5.min.js"></script>
<script src="{{asset()}}assets/datatables/buttons.print.min.js"></script>
<script src="{{asset()}}assets/datatables/buttons.colVis.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset()}}assets/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{asset()}}assets/datatables/buttons.bootstrap.min.css">
<!-- DATATABLES -->

<style type="text/css"></style></head>
<body class="sidebar-mini skin-blue sidebar sidebar-collapse" cz-shortcut-listen="true" style="height:100%;overflow:auto;">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{asset('')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img src="{{asset('template/img/icone.ico')}}" width=50></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><img src="{{asset('template/img/icone.ico')}}" width=55>DMIN</b></span>
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
              <span class="hidden-xs">
              @if(Auth('sexo')=="M") 
                Bem vindo,
              @endif
              @if(Auth('sexo')=="F") 
                Bem vinda,              
              @endif
               <strong> {{primeiro_nome(Auth('usuario'))}} </strong>
            </a>
            <ul class="dropdown-menu">
              <!-- User image --> 
              <li class="user-header" style="height:auto">

                <p>
                  {{Auth('usuario')}}
                  <small>{{Auth('email')}}</small>
                </p>
              </li>
              <!-- Menu Body -->
            
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <button data-toggle="modal" data-target="#sair" class="btn btn-danger">Sair</button>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>



       <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- User Account: style can be found in dropdown.less -->
          <?php   
            $qtde_arq  = Controller::exec('importacaoController','qtde_arq',array('importar'));
            $dt_ultima_imp  = Controller::exec('importacaoController','Dt_ultima_imp');
         ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Existe @if(count($qtde_arq)>1){{'m'}}@endif {{$qtde_arq}} arquivo @if(count($qtde_arq)>1){{'s'}}@endif aguardando importação">
              @if(isset($dt_ultima_imp)){{'Ultima importação feita '.$dt_ultima_imp}} @else {'Nunca houve importação de dados'} @endif
              <i class="fa fa-flag-o" style="padding-left: 10px;"></i>
              <span class="label label-danger">{{$qtde_arq}}</span>
            </a>

          </li>
          <!-- Control Sidebar Toggle Button -->
        
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
        @if(Auth('admin')=="S")
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-inbox"></i> <span>Cadastros</span>
            </a>
            <ul class="treeview-menu">
              <li>              
                <a href="{{asset('usuarios')}}"><i class="glyphicon glyphicon-user"></i> <span>Usuários</span></a>   
              </li>
            </ul>
          </li>
        @endif  
        


        <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-align-right"></i> <span>Consultas</span>
            </a>
            <ul class="treeview-menu">
                    <li><a href="{{asset('caixas')}}"><i class="glyphicon glyphicon-indent-left"></i> <span>Caixas</span></a></li>
                    <li><a href="{{asset('clientes')}}"><i class="glyphicon glyphicon-user"></i> <span>Clientes</span></a></li>
                    <li class="treeview">
                      <a href="#">
                        <i class="glyphicon glyphicon-erase"></i> <span>Produtos</span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="{{asset('produtos')}}"><i class="glyphicon glyphicon-erase"></i> <span>Produtos</span></a></li>
                        <li><a href="{{asset('produtos/tipos')}}"><i class="glyphicon glyphicon-erase"></i> <span>Tipos de Produto</span></a></li>
                        <li><a href="{{asset('produtos/grupos')}}"><i class="glyphicon glyphicon-erase"></i> <span>Grupos de Produto</span></a></li>
                      </ul>
                    </li>
                    <li><a href="{{asset('tanques')}}"><i class="glyphicon glyphicon-tasks"></i> <span>Tanques</span></a></li>                 
            </ul>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-list-alt"></i> <span>Relatórios</span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{asset('Abastecimentos')}}"><i class="glyphicon glyphicon-erase"></i> <span>Abastecimentos</span></a></li>
               <li class="treeview">
                <a href="#">
                  <i class="glyphicon glyphicon-erase"></i> <span>Produtos</span>
                </a>
                <ul class="treeview-menu">                 
                  <li><a href="{{asset('relatorios/tributacoes_codigos')}}"><i class="glyphicon glyphicon-erase"></i> <span>Tributações / Códigos</span></a></li>
                </ul>
              </li>                 
            </ul>
          </li>

          @if(Auth('admin_rede')=='S')          
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-road"></i> <span>Multi Empresa</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('multiempresa/Abastecimentos')}}"><i class="glyphicon glyphicon-erase"></i> <span>Abastecimentos</span></a></li>      
            </ul>
          </li>
          @endif

          @if(Auth('admin')=='S')
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-wrench"></i> <span>Configurações</span>
            </a>
            <ul class="treeview-menu">
                 <li><a href="{{asset('empresa')}}"><i class="glyphicon glyphicon-object-align-bottom"></i> <span>Empresa</span></a></li>
                 <li><a href="{{asset('configuracoes')}}"><i class="glyphicon glyphicon-tasks"></i> <span>Parametros de sistema</span></a></li>
            </ul>
          </li> 
          @else
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-wrench"></i> <span>Configurações</span>
              </a>
              <ul class="treeview-menu">
                   <li><a href="{{asset('empresa')}}"><i class="glyphicon glyphicon-object-align-bottom"></i> <span>Empresa</span></a></li>
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
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão</b> 01.00.00
    </div>
    <strong><a href="http://alive.inf.br/">Alive It</a></strong> Todos os direitos reservados.
  </footer>
  <!-- Control Sidebar -->





  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.0 -->

<script src="{{asset()}}template/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{asset()}}template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{asset()}}template/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset()}}template/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset()}}template/dist/js/demo.js"></script>


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
        <button  id="btn_confirmar_mensagem1"  type="button" onclick="" data-dismiss="modal" class="btn btn-primary">Sim</button>
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

<!--  -->