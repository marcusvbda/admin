<div class="box box-primary">
  <div class="box-header with-border">
    <i class="fa fa-clock-o"></i>
    <h3 class="box-title"> Histórico de importação</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <ul class="products-list product-list-in-box">
      @foreach($importacoes as $imp):
      <li class="item">
        <div class="product-img">
          <i class="fa fa-cloud-download" style="font-size: 50px;"></i>
        </div>
        <div class="product-info">
          <a href="url" class="product-title">{{$imp->arquivo}}            
            <span class="product-description">
              {{dt_format($imp->created_at,'d/m/Y')}}
            </span>
            <div class="row pull-right">
              <div class="col-md-6">
                <span class="label label-primary pull-right">{{$imp->qtde_inserts}} Inserções</span>
              </div>
              <div class="col-md-6">        
                <span class="label label-success pull-right">{{$imp->qtde_updates}} Atualizações</span>
              </div>
            </div>
          </a>
        </div>
      </li>
      @endforeach
      <!-- /.item -->   
    </ul>
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-center">
    <a href="#" class="uppercase">Ver o Histórico completo</a>
  </div>
  <!-- /.box-footer -->
</div>