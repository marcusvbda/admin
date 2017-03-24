<?php  
use App\User; 
$user_qtde = User::qtde();
$user_porcento = User::porcento($user_qtde);
?>
<div class="col-md-6">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Usuários</span>
        <span class="info-box-number">{{$user_qtde}}</span>
        <div class="progress">
          <div class="progress-bar" style="width: {{$user_porcento }}%"></div>
        </div>
            <span class="progress-description">
              {{$user_porcento}}% Ativos
            </span>
      </div>
    </div>
</div>

<?php  
use App\Produtos; 
$qtde_produtos = Produtos::qtde();
$porcento_estoque_baixo = Produtos::PorcentagemComEstoque($qtde_produtos);
?>

<div class="col-md-6">
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Produtos</span>
        <span class="info-box-number">{{$qtde_produtos}}</span>
        <div class="progress">
          <div class="progress-bar" style="width: {{$porcento_estoque_baixo}}%"></div>
        </div>
            <span class="progress-description">
              {{$porcento_estoque_baixo}}% com estoque baixo
            </span>
      </div>
    </div>
</div>

<div class="col-md-6">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Clientes</span>
        <span class="info-box-number">125</span>
        <div class="progress">
          <div class="progress-bar" style="width: 9%"></div>
        </div>
            <span class="progress-description">
              9% Bloqueados
            </span>
      </div>
    </div>
</div>

<div class="col-md-6">
    <div class="info-box bg-aqua">
      <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{dia_semana(date(" D "))}}</span>
        <span class="info-box-number"><span id="relogio"></span></span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
            <span class="progress-description">
              {{date("d/m/Y")}}
            </span>
      </div>
    </div>
</div>


<script type="text/javascript">
showTimer();
initTimer();
function showTimer() 
{
  var time=new Date();
  var hour=time.getHours();
  var minute=time.getMinutes();
  var second=time.getSeconds();
  if(hour<10)   hour  ="0"+hour;
  if(minute<10) minute="0"+minute;
  var st=hour+":"+minute+":"+second;
  document.getElementById("relogio").innerHTML=st; 
}
function initTimer() 
{
  setInterval(showTimer,1000);
}
</script>