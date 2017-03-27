@extends('painel.template.painel')
@section('titulo','Tanques')
@section('topo')
<section class="content-header">
  <h1>
    <i class="fa fa-square"></i>
    Tanques
    <small>Visualização</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{asset('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Tanques</li>
  </ol>
</section>
@stop
@section('conteudo')
<div class="box box-primary">
    <div class="box-header">
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div> 
    </div> 

    <div class="box-body">
        <div class="row">

        @foreach($tanques as $tanque)
          <div class="col-md-3 text-center" title="{{porcentagem($tanque->volumeatual,$tanque->capacidade)}} % da capacidade completa">
            <input type="text" class="knob" value="{{porcentagem($tanque->volumeatual,$tanque->capacidade)}}" data-skin="tron" data-thickness="0.2" data-width="200" data-height="200" data-fgColor="{{randomColor()}}" data-readonly="true">
            <div class="knob-label">
              <p><strong>Tanque {{$tanque->numero}}</strong></p>
              <p><strong>Combustivel : </strong>{{$tanque->produto->descricao}}</p>
              <p><strong>Capacidade : </strong>{{$tanque->capacidade}} {{$tanque->produto->unidade}}</p>
              <p><strong>Volume atual : </strong>{{$tanque->volumeatual}} {{$tanque->produto->unidade}}</p>
            </div>
          </div>
        @endforeach  

      </div>
  </div>

</div>
<script type="text/javascript">
  $(function () {
  /* jQueryKnob */

  $(".knob").knob({
    draw: function () {

      // "tron" case
      if (this.$.data('skin') == 'tron') {

        var a = this.angle(this.cv)  // Angle
            , sa = this.startAngle          // Previous start angle
            , sat = this.startAngle         // Start angle
            , ea                            // Previous end angle
            , eat = sat + a                 // End angle
            , r = true;

        this.g.lineWidth = this.lineWidth;

        this.o.cursor
        && (sat = eat - 0.3)
        && (eat = eat + 0.3);

        if (this.o.displayPrevious) {
          ea = this.startAngle + this.angle(this.value);
          this.o.cursor
          && (sa = ea - 0.3)
          && (ea = ea + 0.3);
          this.g.beginPath();
          this.g.strokeStyle = this.previousColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
          this.g.stroke();
        }

        this.g.beginPath();
        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
        this.g.stroke();

        this.g.lineWidth = 2;
        this.g.beginPath();
        this.g.strokeStyle = this.o.fgColor;
        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
        this.g.stroke();

        return false;
      }
    }
  });
  /* END JQUERY KNOB */

  //INITIALIZE SPARKLINE CHARTS
  $(".sparkline").each(function () {
    var $this = $(this);
    $this.sparkline('html', $this.data());
  });
});
</script>
@stop