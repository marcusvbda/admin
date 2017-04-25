<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ERRO 505</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
       <!-- sweetalert -->
       
            <!-- Theme initialization -->
    </head>
    <body>
        <div class="app blank sidebar-opened">
            <article class="content">
                <div class="error-card global">
                    <div class="error-title-block">
                        <h1 class="error-title">505</h1>
                        <h2 class="error-sub-title">
                            Oops, Você não tem permissão para acessar esta página  :(
                        </h2> 
                    </div>
                    @if(Auth::check())
                    <div class="error-container">
                        <p>Consulte seu grupo de acesso</p>
                        <br>
                        <a class="btn btn-primary btn-sm" href="{{ URL::previous()}}"> <i class="fa fa-angle-left"></i> Voltar</a>
                    </div>
                    @else
                        <div class="error-container">
                            <br>
                            <a class="btn btn-primary btn-sm" href="{{ URL::previous()}}"> <i class="fa fa-angle-left"></i> Voltar</a>
                        </div>
                    @endif
                </div>
            </article>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="{{asset('public/template/js/app.js')}}"></script>

    </body>


</html>

