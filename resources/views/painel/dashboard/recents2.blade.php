<div class="box box-primary">
  <div class="box-header with-border">
    <i class="fa fa-clock-o"></i>
    <h3 class="box-title"> Histórico de pessoas</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
        <tr>
          <th>Data</th>
          <th>Autor</th>
          <th>Tipo</th>
          <th>Titulo</th>
        </tr>
        </thead>
        <tbody>
          @foreach($historico_pessoas as $hist)
          <tr title="{{$hist->descricao}}">
            <td>{{dt_format($hist->created_at,'d/m/Y')}}</td>
            <td><strong>{{$hist->autor}}</strong></td>
            <td>
              @if($hist->tipo=="F")
                <span class="label label-primary">Fornecedor</span>
              @elseif($hist->tipo=="C")
                <span class="label label-success">Cliente</span>
              @endif
            </td>
            <td><strong>{{$hist->titulo}}</strong></td>     
          </tr>
          @endforeach       
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-center">
    <a href="#" class="uppercase">Ver Todo Histórico</a>
  </div>
  <!-- /.box-footer -->
</div>