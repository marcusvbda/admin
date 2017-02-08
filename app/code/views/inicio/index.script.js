showTimer();
initTimer();
showGrupos();
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


function showGrupos()
{
	$.post("{{asset('produtos/JsonPorcentagemGrupo')}}" ,{},  function(dados)
	{ 	
		var cont=0;
		$.each(dados, function(dados,d)
        {      
        	circulo =  "<div class='col-md-2'>"+
					        "<div id='circulo_porcentagem_"+cont+"' class='text-center'>"+
							    "<label>"+d.grupo+"</label>"+			        	
					        "</div>"+
					    "</div>";
        	$('#div_conteudo_grupos').append(circulo);
        	$("#circulo_porcentagem_"+cont).circliful(
        	{
		        animationStep: 15,
		        foregroundBorderWidth: 5,
		        backgroundBorderWidth: 15,
		        decimals:2,
		        percent: d.porcentagem,
	    	});
	    	cont++;
        });

        $('#div_loading_grupos').toggle(150);
        $('#div_conteudo_grupos').toggle(150);
	},'json');
}