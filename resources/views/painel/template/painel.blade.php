<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('titulo')</title>
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <meta name="_skin" content="{!! parametro('skin') !!}"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->

  <script src="{{asset('public/painel/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

  <link rel="stylesheet" href="{{asset('public/painel/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/painel/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('public/painel/dist/css/skins/_all-skins.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/painel/plugins/iCheck/flat/blue.css')}}">
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="{{asset('public/painel/plugins/morris/morris.css')}}"> -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('public/painel/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('public/painel/plugins/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/painel/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('public/painel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="icon" type="image/png" href="{{asset('public/custom/img')}}/{{env('ICONE_CINZA')}}" />





   <!-- sweetalert -->
   <script src="{{asset('public/libs/sweetalert/sweetalert.min.js')}}"></script>  
   <link rel="stylesheet" type="text/css" href="{{asset('public/libs/sweetalert/sweetalert.css')}}">
   <!-- sweetalert -->
   
   <!-- datatable -->
   <script src="{{asset('')}}public/libs/datatable/custom.datatable.js"></script>
   <script src="{{asset('')}}public/libs/datatable/jquery.dataTables.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/dataTables.bootstrap.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/dataTables.buttons.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/buttons.bootstrap.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/jszip.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/pdfmake.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/vfs_fonts.js"></script>
   <script src="{{asset('')}}public/libs/datatable/buttons.html5.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/buttons.print.min.js"></script>
   <script src="{{asset('')}}public/libs/datatable/buttons.colVis.min.js"></script>
   <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="{{asset('public/libs/datatable/dataTables.bootstrap.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/libs/datatable/custom.css')}}">
   <!-- Theme initialization -->
   
   <!-- mask -->
   <script src="{{asset('')}}public/libs/mask/jquery.maskedinput-1.1.4.pack.js"></script>
   <!-- mask -->

   <!-- validator -->
   <script src="{{asset('')}}public/libs/validate/validator.js"></script>
   <!-- validator -->

   <!-- xcode -->
   <script src="{{asset('public/libs/xCode/xCode.js')}}"></script>  



</head>
<body class="skin-{{parametro('skin')}} sidebar-mini @if(parametro('fix_navbar')) fixed @endif @if(parametro('sidebar_collapse')) sidebar-collapse @endif">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{asset('admin')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img src="{{asset('public/custom/img')}}/{{env('ICONE_CINZA')}}" style="width: 80%">
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="{{asset('public/custom/img')}}/{{env('ICONE_CINZA')}}" style="width: 20%">
      <b>{{env('APP_NAME')}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="qtde_notificacoes"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="txt_notificacoes">

                </ul>
              </li>
              <li class="footer"><a href="#">Ver Todas</a></li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div style="background-color:{{Auth::user()->cor_profile->cor}};color:#e8e2ff;text-align: center;padding-top: 1.5%" class="user-image" >
                  {{Iniciais(Auth::user()->nome.' '.Auth::user()->sobrenome)}}
              </div>  
              <span class="hidden-xs">{{Auth::user()->nome}} {{Auth::user()->sobrenome}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">                
                <p>
                  <small>Função : {{Auth::user()->funcao->descricao}}</small>
                  <small>Email : {{Auth::user()->email}}</small>
                  <small>Grupo de Acesso : {{Auth::user()->grupo_acesso->descricao}}</small>
                  <small>Aniversário : {{dt_format(Auth::user()->dt_nascimento,'d/m')}}</small>
                  <small>Idade : {{calc_idade(Auth::user()->dt_nascimento)}}</small>
                  <small>Sexo : @if(Auth::user()->sexo=='M') Masculino @else Feminino @endif</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  @if(can('configuracoes','get'))
                    <a href="{{asset('admin/config')}}" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i></a>
                  @endif
                  <a href="{{asset('admin/users/show')}}/{{base64_encode(Auth::user()->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Perfil</a>
                </div>
                <div class="pull-right">
                  <button onclick="sair()" class="btn btn-danger btn-sm"><i class="fa fa-sign-out"></i> Sair</button>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">     
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Procurar ...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu principal</li>
          <li>
             <a href="{{asset('admin')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-database"></i> <span>Cadastros</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-users"></i> Usuários
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  @if(can('usuarios','get'))
                    <li><a href="{{asset('admin/users')}}"><i class="fa fa-users"></i> Usuários</a></li>
                  @endif
                  @if(can('grupos_acesso','get'))                
                    <li><a href="{{asset('admin/users/groups')}}"><i class="fa fa-unlock"></i> Grupos Acesso</a></li>
                  @endif                             
                </ul>
              </li>
              <li>
                <a href="#"><i class="fa fa-cubes"></i> Produtos
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <ul class="treeview-menu">
                    @if(can('produtos','get'))                
                      <li><a href="{{asset('admin/products')}}"><i class="fa fa-cubes"></i> Produtos</a></li>
                    @endif   
                  </ul>
                </a>
              </li>
            </ul>
          </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('topo')
   
    <!-- Main content -->
    <section class="content">

        @if(isset($mensagem))
          <div id="msgs">
          @foreach($mensagem as $msg)
            <div class="alert alert-{{$msg['tipo']}} alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-warning"></i> {{$msg['titulo']}}</h4>
              {{$msg['texto']}}
            </div>
          @endforeach
        </div>
        <script type="text/javascript">          
          setTimeout(function() {
              $('#msgs').fadeOut('slow');
          }, 10000); 
        </script>
        @endif
        @yield('conteudo')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão : {{env('VERSAO')}} </b>
    </div>
    <strong><a href="http://xcode.com">XCode Ltda</a></strong> Todos os direitos reservados.
  </footer>

  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('public/painel/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<!-- <script src="{{asset('public/painel/plugins/morris/morris.min.js')}}"></script> -->
<!-- Sparkline -->
<script src="{{asset('public/painel/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('public/painel/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('public/painel/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/painel/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('public/painel/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('public/painel/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('public/painel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('public/painel/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('public/painel/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/painel/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{asset('public/painel/dist/js/pages/dashboard.js')}}"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{asset('public/painel/dist/js/demo.js')}}"></script> -->
</body>
</html>




<script type="text/javascript">
// buscar_notificacoes();

// function buscar_notificacoes()
// {
//     var contador = 0;
//     $('#txt_notificacoes').html(null);
//     xCode.ajax("post","{{asset('admin/dashboard/notifications')}}",{}).then(function(response)
//     {
//         $.each(response, function (key, value) 
//         {   
//             contador++;
//             $('#txt_notificacoes').append(
//             '<li>'+
//             '    <a href="'+value.url+'">'+
//             '        <i class="fa fa-users text-'+value.cor+'"></i>'+value.msg+
//             '     </a>'+
//             '</li>');
//             $('#qtde_notificacoes').html(contador);
//         });        
//     });
// }


// setInterval(function()
// {
//     buscar_notificacoes();
// }, 5000);

function sair()
{
    msg_confirm("Confirmação","Deseja mesmo sair ?",function()
    {
        xCode.ajax("post","{{asset('admin/auth/logout')}}",{}).then(function(response)
        {
            if(response.success)
                reload();
            else
                return msg("Ooops",response.msg,"error");

        });
    },false);
}


function loading()
{
    $('#main_content_body').toggle(150);
    $('#main_content_loading').toggle(150);
}

</script>
