<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ERRO</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="{{asset('public/template/css/vendor.css')}}">
        <link rel="stylesheet" id="theme-style" href="{{asset('public/template/css/app-red.css')}}">
        <link rel="icon" type="image/png" href="{{asset('public/template/assets/img/icon.png')}}" />
        
        <!-- custom -->
        <script src="{{asset('public/template/js/custom.js')}}"></script>  

        <!-- sweetalert -->
        <script src="{{asset('public/template/libs/sweetalert/sweetalert.min.js')}}"></script>  
        <link rel="stylesheet" type="text/css" href="{{asset('public/template/libs/sweetalert/sweetalert.css')}}">
        <!-- sweetalert -->
        
        <script src="{{asset('public/template/js/vendor.js')}}"></script>

        <!-- Theme initialization -->
        
    </head>
    <body>
        <div class="app blank sidebar-opened">
            <article class="content">
                <div class="error-card global">
                    <div class="error-title-block">
                        <h1 class="error-title">{{$erro}}</h1>
                        <h2 class="error-sub-title">
                            {{$txt_erro}}
                        </h2> 
                    </div>
                    @if(Auth::check())
                    <div class="error-container">
                        <p>{{$txt_msg}}</p>
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

