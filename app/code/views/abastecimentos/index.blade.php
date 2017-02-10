@extends('templates.principal.principal')

@section('titulo','Abastecimentos')

@section('topo')
<h1>Abastecimentos
  <small>Listagem</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{asset('inicio')}}"><i class="fa fa-dashboard"></i> Início</a></li>
  <li><a href="{{asset('abastecimentos')}}"><i class="glyphicon glyphicon-erase"></i> Abastecimentos</a></li>
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
                @if($bomba>0)
                  <option value="0">Todas</option>
                  <option selected value="{{$bomba}}">BOMBA {{$bomba}}</option>                  
                @else
                  <option @if($bomba==0){{'selected'}}@endif value="0">Todos</option>
                  @foreach($bombas as $bomb)
                    <option  value="{{$bomb->bomba}}">Bomba {{$bomb->bomba}}</option>
                  @endforeach
                @endif
              </select>
            </div>
            <div class="col-md-2">
              <label>Bico</label>
              <select class="form-control" id="bicos">
                @if($bomba>0)
                  <option value="0">Todas</option>
                  <option selected value="{{$bico}}">Bico {{$bico}}</option>                  
                @else
                  <option @if($bico==0){{'selected'}}@endif value="0">Todos</option>
                  @foreach($bicos as $bic)
                    <option  value="{{$bic->numero}}">Bico {{$bic->numero}}</option>
                  @endforeach
                @endif               
              </select>
            </div>
            <div class="col-md-3">
              <label>Combustível</label>
              <select class="form-control" id="combustivel">
                @if($combustivel>0)
                  <option value="0">Todas</option>
                  <option selected value="{{$combustivel}}">{{$combustivel_nome}}</option>                  
                @else
                  <option @if($combustivel==0){{'selected'}}@endif value="0">Todos</option>
                  @foreach($combustiveis as $comb)
                    <option  value="{{$comb->codigo}}">{{$comb->descricao}}</option>
                  @endforeach
                @endif            
              </select>
            </div>
            <div class="col-md-2">
              <label>De :</label>
              <input type="date" class="form-control" value="{{$de}}" id="de">
            </div>
             <div class="col-md-2">
              <label>Até :</label>
              <input type="date" class="form-control" value="{{$ate}}" id="ate">
            </div>

            <div class="col-md-1">
              <button class="btn btn-default" onclick="filtrar()" style="padding-bottom: 30px;padding-top: 30px;"><i class="glyphicon glyphicon-search"></i> Buscar</button>
            </div>

          </div>
        </div> 

        <hr>

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