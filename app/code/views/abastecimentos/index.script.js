dataTable('#tabela');

$( "#bomba" ).change(function() 
{
	var bomba = $('#bomba').val();
  	$.post("{{asset('bombas/procurabicos')}}" ,{bomba:bomba},  function(dados)
	{ 	
        $('#bicos option').remove();
        if(bomba==0)        
        	$('#bicos').append("<option value='0' selected>Todos</option>");        
		$.each(dados, function(dados,d)
        {      
        	$('#bicos').append("<option value='"+d.numero+"'>Bico "+d.numero+"</option>");
        });
	},'json');

	$.post("{{asset('bombas/procuracombustivel')}}" ,{bomba:bomba},  function(dados)
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

$( "#bicos" ).change(function() 
{
	var bico = $('#bicos').val();
  	$.post("{{asset('bombas/procurabomba')}}" ,{bico:bico},  function(dados)
	{ 	
        $('#bomba option').remove();
        if(bico==0)
        	$('#bomba').append("<option value='0' selected>Todas</option>");     
		$.each(dados, function(dados,d)
        {      
        	$('#bomba').append("<option value='"+d.bomba+"'>Bomba "+d.bomba+"</option>");
        });
	},'json');


	var bico = $('#bicos').val();
  	$.post("{{asset('bombas/Procuracombustivelporbico')}}" ,{bico:bico},  function(dados)
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

$( "#combustivel" ).change(function() 
{
	var combustivel = $('#combustivel').val();
  	$.post("{{asset('bombas/Procurarbombacombustivel')}}" ,{combustivel:combustivel},  function(dados)
	{ 	
        $('#bomba option').remove();
        if(combustivel==0)
        	$('#bomba').append("<option value='0' selected>Todas</option>");     
		$.each(dados, function(dados,d)
        {      
        	$('#bomba').append("<option value='"+d.bomba+"'>Bomba "+d.bomba+"</option>");
        });
	},'json');

	$.post("{{asset('bombas/Procurarbicocombustivel')}}" ,{combustivel:combustivel},  function(dados)
	{ 	
        $('#bicos option').remove();
        if(combustivel==0)        
        	$('#bicos').append("<option value='0' selected>Todos</option>");        
		$.each(dados, function(dados,d)
        {      
        	$('#bicos').append("<option value='"+d.numero+"'>Bico "+d.numero+"</option>");
        });
	},'json');

});


function filtrar()
{
	var bico = $('#bicos').val();
	var bomba = $('#bomba').val();
	var combustivel = $('#combustivel').val();
	var de = $('#de').val();
	var ate = $('#ate').val();
    SEND("POST","{{asset('abastecimentos')}}",{bico:bico,bomba:bomba,combustivel:combustivel,de:de,ate:ate},"{{Request::getToken()}}");
}