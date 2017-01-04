@extends('templates.principal.principal')

@section('titulo','Abastecimentos')

@section('topo')
<h1>Abastecimentos
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('admin/inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('admin/abastecimentos')}}"><i class="glyphicon glyphicon-erase"></i> Abastecimentos</a></li>
</ol>
@stop


@section('conteudo')
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
        <p class="title_box"></p>  
      <div class="box-tools pull-right">
        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button></div> -->
      </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <label>Bomba</label>
              <select class="form-control" id="bomba">
                <option selected value="0">Todas</option>
                @foreach($bombas as $bomb)
                  <option value="{{$bomb->bomba}}">BOMBA {{$bomb->bomba}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <label>Bico</label>
              <select class="form-control" id="bico">
                <option selected value="0">Todos</option>
                @foreach($bicos as $bic)
                  <option value="{{$bic->numero}}">BICO {{$bic->numero}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label>Combustível</label>
              <select class="form-control" id="combustivel">
                <option selected value="0">Todos</option>
                @foreach($combustiveis as $comb)
                  <option value="{{$comb->id}}">{{$comb->descricao}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <label>De :</label>
              <input type="date" class="form-control">
            </div>
             <div class="col-md-2">
              <label>Até :</label>
              <input type="date" class="form-control">
            </div>
          </div>
        </div> 


        <div class="row">
          @if(isset($abastecimentos))
            <div class="col-md-12">
                    <br>      
                     <table class="table table-hover" style="font-size: 14px" id="tabela">
                      <thead>
                        <tr style="background-color: #F4F4F4;border-radius: 100px;">
                          <th>Registro</th>
                          <th>Bomba</th>
                          <th>Combustível</th>                
                          <th>Preço</th>
                          <th>Total (Litros)</th>
                          <th>Total (R$)</th>
                          <th>Data</th>
                          <th>Hora</th>
                        </tr>
                      </thead>
                     <tbody>
                        @foreach($abastecimentos as $ab)
                        <tr>
                          <td>{{$ab->registro}}</td>
                          <td>{{$ab->id_bomba}}</td>
                          <td>{{$ab->combustivel}}</td>
                          <td>{{$ab->precounitario}}</td>
                          <td>{{$ab->totallitros}}</td>   
                          <td>{{format_dinheiro('R$',$ab->totaldinheiro)}}</td>       
                          <td>{{$ab->data_formatada}}</td>        
                          <td>{{$ab->horaabastecimento}}</td>       
                        </tr>
                        @endforeach
                     </tbody>
                   </table>
                  <hr> 
            </div>
          @endif
        </div>
      </div>
    </div>
          
  </div>  
</div>


@stop