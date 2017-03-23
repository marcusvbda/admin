<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-bar-chart-o"></i>

    <h3 class="box-title"> Movimentação por Grupo de Produto  %</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">

      <div class="col-md-2 text-center">
        <input type="text" class="knob" value="50" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="#3c8dbc" data-readonly="true">
        <div class="knob-label">Camisetas</div>
      </div>

      <div class="col-md-2 text-center">
        <input type="text" class="knob" value="12" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="#dd4b39" data-readonly="true">
        <div class="knob-label">Calças</div>
      </div>

      <div class="col-md-2 text-center">
        <input type="text" class="knob" value="8" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="#f39c12" data-readonly="true">
        <div class="knob-label">Sapatos</div>
      </div>

      <div class="col-md-2 text-center">
        <input type="text" class="knob" value="10" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="#00a65a" data-readonly="true">
        <div class="knob-label">Acessórios</div>
      </div>

      <div class="col-md-2 text-center">
        <input type="text" class="knob" value="5" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="#fa73f5" data-readonly="true">
        <div class="knob-label">Meias</div>
      </div>

      <div class="col-md-2 text-center">
        <input type="text" class="knob" value="5" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="#943a91" data-readonly="true">
        <div class="knob-label">Bijoterias</div>
      </div>
    
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.box-body -->
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