@extends('painel.template.painel')
@section('titulo','Dashboard')

@section('conteudo')
<script type="text/javascript">
    $('#menu_dashboard').addClass( "active" );
</script>
<h4><i class="fa fa-home"></i> Dashboard</h4> 
<section>

    <div class="row">
        <div class="col-md-12 text-center">
        	<?php $dia_semana = dia_semana(date(" D ")); ?>
            <h2>{{bomdia()}}
            @if(Auth::user()->apelido!="") 
                {{Auth::user()->apelido}} 
            @else 
                {{Auth::user()->nome}} 
            @endif
            , tenha {{sexo_palavra('um','$dia_semana')}}  {{sexo_palavra('Bom',$dia_semana)}} {{$dia_semana}}.</h2>
            <h4>Abaixo seus afazeres e um resumo do que está acontecendo neste momento.</h4>
        </div>        
    </div>
    
    <hr>

    <div class="row">

    	<div class="col-md-7">
            @include('painel.dashboard.basicinfo') 
        </div>

    	<div class="col-md-5">
            @include('painel.dashboard.todolist')
        </div>

        <div class="col-md-8">
            @include('painel.dashboard.recents2',['historico_pessoas'=>$historico_pessoas])
        </div>
        <div class="col-md-4">
            @include('painel.dashboard.recents')
        </div>
        <div class="col-md-12">
            @include('painel.dashboard.grupos')            
        </div>
    </div>

</section>
@stop