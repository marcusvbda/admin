<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="utf-8">
  <title>Alive - {{env('APP_NAME')}}</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
  <meta property="og:title" content="">
	<meta property="og:type" content="website">
	<meta property="og:url" content="">
	<meta property="og:site_name" content="">
	<meta property="og:description" content="">

  <!-- Styles -->
  <link rel="stylesheet" href="{{asset('public/landing/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/landing/css/animate.css')}}">
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900|Montserrat:400,700' rel='stylesheet' type='text/css'>
  

  <link rel="stylesheet" href="{{asset('public/landing/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/landing/css/main.css')}}">
  <link rel="icon" type="image/png" href="{{asset('public/custom/img')}}/{{env('FAVICON')}}" />

  <script src="{{asset('public/landing/js/modernizr-2.7.1.js')}}"></script>
  
</head>

<body>

    
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#pricing" class="scroll">Cadastre-se</a></li>
            <li><a href="{{asset('admin/auth/login')}}">Já sou usuário</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
        
    <header>
      <div class="container">
        <div class="row">
          <div class="col-xs-6">
            <a href="index.html"><img src="{{asset('public/custom/img')}}/{{env('ICONE_FULL3')}}" alt="Logo" width="50%"></a>
          </div>
          <div class="col-xs-6 signin text-right navbar-nav">
            <a href="{{asset('admin/auth/login')}}">Entrar</a>
          </div>
        </div>
        
        <div class="row header-info">
          <div class="col-sm-10 col-sm-offset-1 text-center">
            <h1 class="wow fadeIn">Acesso aos seus dados direto da núvem</h1>
            <br />
            <p class="lead wow fadeIn" data-wow-delay="0.5s">Utilizando o admin em conjunto com o FOKUS ADMN, você poderá acessar em qualquer lugar informações sobre seu negócio, utilizando seu smartphone ou computador</p>
            <br />
              
            <div class="row">
              <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="row">
                  <div class="col-xs-6 text-right wow fadeInUp" data-wow-delay="1s">
                    <a href="#be-the-first" class="btn btn-secondary btn-lg scroll">Saiba mais</a>
                  </div>
                  <div class="col-xs-6 text-left wow fadeInUp" data-wow-delay="1.4s">
                    <a href="#invite" class="btn btn-primary btn-lg scroll">Veja uma demonstração</a>
                  </div>
                </div><!--End Button Row-->  
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </header>
    
    <div class="mouse-icon hidden-xs">
				<div class="scroll"></div>
			</div>
    
    <section id="be-the-first" class="pad-xl">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 text-center margin-30 wow fadeIn" data-wow-delay="0.6s">
            <h2>Veja tudo</h2>
            <p class="lead">Acompanhe tudo de perto em 1 clique em qualquer lugar.</p>
          </div>
        </div>
        
        <div class="iphone wow fadeInUp" data-wow-delay="1s">
	        <img src="{{asset('public/landing/img/iphone.png')}}">
        </div>
      </div>
    </section>
    
    <section id="main-info" class="pad-xl">
	    <div class="container">
		    <div class="row">
			    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.4s">
				    <hr class="line purple">
				    <h3>Segurança de informação</h3>
				    <p>O Alive Admin foi desenvolvido utilizando oque existe de mais moderno em desenvolvimento em núvem, visando sempre garantir qualidade de informação e segurança com os dados de nossos clientes.</p>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/laravel.png')}}" title="Laravel Framework 5" width="70px;">
              </div>
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/jquery.png')}}" title="Jquery" width="70px;">
              </div>
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/php.png')}}" title="PHP 7" width="70px;">
              </div>
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/mysql.png')}}" title="MYSQL" width="70px;">
              </div>
            </div>
			    </div>
			    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.8s">
				    <hr  class="line blue">
				    <h3>O futuro é a núvem</h3>
				    <p>Apartir de sincronização entre os sistemas FOKUS ADM e FOKUS SAT, o ALIVE ADMIN permitirá acessar informações de movimentação, faturamento, estoque e muito mais, utilizando uma plataforma segura, intuitiva e custimização afim de facilitar a adminsitração a distancia de seu negócio.</p>
            <hr>
            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <img src="{{asset('public/custom/img/nuvem.png')}}" title="Banco de dados em núvem" width="70px;">
              </div>
              <div class="col-md-4"></div>
            </div>
			    </div>
			    <div class="col-sm-4 wow fadeIn" data-wow-delay="1.2s">
				    <hr  class="line yellow">
				    <h3>Inteligencia</h3>
            <p>O ALIVE ADMIN se basea em dados antigos e novos afim de criar um padrão e negócio automático, desta forma você será notificado com sugestões que facilitarão na decisão administrativa de seu negócio.</p>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/brain.png')}}" title="Inteligencia" width="70px;">
              </div>
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/fast.png')}}" title="Agilidade" width="70px;">
              </div>
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/robot.png')}}" title="Automático" width="70px;">
              </div>
              <div class="col-md-3">
                <img src="{{asset('public/custom/img/eficaz.png')}}" title="Eficaz" width="70px;">
              </div>
            </div>
			    </div>
		    </div>
	    </div>
    </section>
        
        
    <!--Pricing-->
    <section id="pricing" class="pad-lg">
      <div class="container">
        <div class="row margin-40">
          <div class="col-sm-8 col-sm-offset-2 text-center">
            <h2 class="white">Preços</h2>
            <p class="white">Os valores variam de acordo com o tipo de licença que deseja contratar.</p>
          </div>
        </div>
        
        <div class="row margin-50">
          
          <div class="col-sm-4 pricing-container wow fadeInUp" data-wow-delay="1s">
            <br />
            <ul class="list-unstyled pricing-table text-center">
    					<li class="headline"><h5 class="white">Personal</h5></li>
    					<li class="price"><div class="amount">R$200,00<small> mensais</small></div></li>
    					<li class="info">Este pacote dará direito a...</li>
    					<li class="features first">1 usuários de acesso</li>
    					<li class="features">Movimentação dos ultimos 6 meses</li>
    					<li class="features">Apenas 1 empresa</li>
    					<li class="features last btn btn-secondary btn-wide"><a href="#">Iniciar</a></li>
    				</ul>
          </div>
          
          <div class="col-sm-4 pricing-container wow fadeInUp" data-wow-delay="0.4s">
            <ul class="list-unstyled pricing-table text-center">
              <li class="headline"><h5 class="white">Professional</h5></li>
              <li class="price"><div class="amount">R$500,00<small> mensais</small></div></li>
              <li class="info">Este pacote dará direito a...</li>
              <li class="features first">5 usuários de acesso</li>
              <li class="features">Movimentação dos ultimos 12 meses</li>
              <li class="features">Multi empresa (5 empresas)</li>
              <li class="features last btn btn-secondary btn-wide"><a href="#">Iniciar</a></li>
            </ul>
          </div>
          
          <div class="col-sm-4 pricing-container wow fadeInUp" data-wow-delay="1.3s">
            <br />
            <ul class="list-unstyled pricing-table text-center">
              <li class="headline"><h5 class="white">Business</h5></li>
              <li class="price"><div class="amount">R$1000,00<small> mensais</small></div></li>
              <li class="info">Este pacote dará direito a...</li>
              <li class="features first">Sem limite de usuários</li>
              <li class="features">Movimentação completa</li>
              <li class="features">Multi empresa (ilimitada)</li>
              <li class="features last btn btn-secondary btn-wide"><a href="#">Iniciar</a></li>
            </ul>
          </div>
          
        </div>
        
      </div>
    </section>
    
    
    <section id="invite" class="pad-lg light-gray-bg">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 text-center">
            <i class="fa fa-envelope-o margin-40"></i>
            <h2 class="black">Nós entramos em contato</h2>
            <br />
            <p class="black">Preencha o formulários e aguarde o contato de nosso setor comercial</p>
            <br />
            
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form role="form">
                  <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Nome">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Telefone">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg">Solicite contato</button>
                </form>
              </div>
            </div><!--End Form row-->

          </div>
        </div>
      </div>
    </section>

    
    <section id="press" class="pad-sm">
      <div class="container">
        <div class="row margin-30 news-container">
          <div class="text-center">
            <i class="fa fa-users" style="font-size: 50px;"></i>
            <h2 class="black">Principais usuários</h2>
          </div>
          <hr>
          <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 wow fadeInLeft" data-wow-delay="0.8s">
            <a href="#" target="_blank">
            <img class="news-img pull-left" src="{{asset('public/custom/img/frango.jpg')}}" alt="Rede Frango Assado" width="200px">
            <p class="black">Uma das maiores redes de postos de combustiveis e restaurantes da américa latina. <br /> 
            <small><em>Usuário desde 20 de Maio de 2017</em></small></p>
            </a>
          </div>
        </div>
        
        <!-- <div class="row margin-30 news-container">
          <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 wow fadeInLeft" data-wow-delay="1.2s">
            <a href="#" target="_blank">
            <img class="news-img pull-left" src="{{asset('public/landing/img/press-02.jpg')}}" alt="Forbes">
            <p class="black">Uma das maiores redes de postos de combustiveis e restaurantes da américa latina. <br /> 
            <small><em>Cliente desde - 20 de Maio de 2017</em></small></p>
            </a>
          </div>
        </div> -->
        
      </div>
    </section>
    
    
    <footer>
      <div class="container">
        
        <div class="row">
          <div class="col-sm-8 margin-20">
            <ul class="list-inline social">
              <li>Conecte-se a nós</li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
          
          <div class="col-sm-4 text-right">
            <p><small>Copyright &copy; 2017. Todos os direitos reservados. <br>
	            Criador por <a href="http://alive.inf.br">Alive it Soluções em tecnologia</a></small></p>
          </div>
        </div>
        
      </div>
    </footer>
    
    
    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('public/landing/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('public/landing/js/wow.min.js')}}"></script>
    <script src="{{asset('public/landing/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/landing/js/main.js')}}"></script>

   
    </body>
</html>