dataTable('#tabela');

$( "#bomba" ).change(function() 
{
	var bomba = $('#bomba').val();

  	$.post("{{asset('abastecimentos/procurabicos')}}" ,{bomba:bomba},  function(dados)
	{ 	
        $('#bicos option').remove();
        $('#bicos').append("<option value='0' selected>Todos</option>");        
		$.each(dados, function(dados,d)
        {      
        	$('#bicos').append("<option value='"+d.numero+"'>Bico "+d.numero+"</option>");
        });
	},'json');

	$.post("{{asset('abastecimentos/procuracombustivel')}}" ,{bomba:bomba},  function(dados)
	{ 	
        $('#combustivel option').remove();    
        if(bomba==0)
        		$('#combustivel').append("<option value='0' selected>Todos</option>");     
		$.each(dados, function(dados,d)
        {       
			$('#combustivel').append("<option value='"+d.codigo+"'>"+d.descricao+"</option>");
        });
	},'json');
});

$( "#bico" ).change(function() 
{
	var bico = $('#bico').val();
  	$.post("{{asset('abastecimentos/procurabomba')}}" ,{bico:bico},  function(dados)
	{ 	
        $('#bomba option').remove();
        $('#bomba').append("<option value='0' selected>Todas</option>");        
		$.each(dados, function(dados,d)
        {      
        	$('#bomba').append("<option value='"+d.numero+"'>Bomba "+d.numero+"</option>");
        });
	},'json');

});