  function load(url,refresh=true)
  {
    if(refresh)
      location.href=url;
    else
        $("body").load(url);       
  }

  function reload(refresh=true)
  {
    var url = document.location.pathname;
    if(refresh)
      location.reload();
    else
        $("body").load(url);    
  }



function msg_confirm_old(titulo,texto,onclick)
{
	$('#titulo_msg1').html(titulo);
  	$('#msg_msg1').html(texto);
  	$('#btn_confirmar_mensagem1').attr("onclick",onclick);   
 	$('#mensagem1').modal('show'); 
}


function format_numero(numero,casas)
{
	return numero.toFixed(casas);
}

function aspas(texto)
{
	return "'"+texto+"'";
}

function aspas_duplas(texto)
{
	return '"'+texto+'"';
}

function escreve(texto)
{
	alert(texto);
}

function POST(url,JSON = {})
{
	var form = "<form hidden  action='"+url+"' name='___FORM___POST' id='___FORM___POST' method='POST'>";
	for (var campo in JSON) 
	{
	   form+="<input id='"+campo+"' name='"+campo+"'  value='"+JSON[campo]+"'>";
	}
	form+="</form>";
	var form_ =  document.createElement("h1")
	form_.innerHTML = form;
	document.body.appendChild(form_);
	document.___FORM___POST.submit();
}

function GET(url,JSON = {})
{
	var form = "<form hidden  action='"+url+"' name='___FORM___GET' id='___FORM___GET' method='DELETE'>";
	for (var campo in JSON) 
	{
	   form+="<input id='"+campo+"' name='"+campo+"'  value='"+JSON[campo]+"'>";
	}
	form+="</form>";
	var form_ =  document.createElement("h1")
	form_.innerHTML = form;
	document.body.appendChild(form_);
	document.___FORM___GET.submit();
}

function JSON_TO_STRING(objeto)
{
	return JSON.stringify(objeto);  
}

function FORMATA_NUMERO(numero,casas)
{
	return numero.toFixed(casas);
}

function FORMATA_MOEDA(moeda,valor,cifrao=false)
{
	return moeda+valor.toFixed(2).replace(".", ",");
}


function send(metodo,$url,dados,func=null,token=null)
{
	dados.REQUEST_METHOD=metodo;
	dados.__TOKEN=token;
	$.ajax(
			{
			   url: $url,
			   type: 'POST',
			   data :dados,
			   dataType: "json",
			   success: function(response) 
			   {
			     	func(response);
			   }
			});   
}


function SEND(method,url,JSON = {},token=null)
{
	var form = "<form hidden action='"+url+"' name='___FORM___POST' id='___FORM___POST' method='POST'>";
	for (var campo in JSON) 
	{
	   form+="<input id='"+campo+"' name='"+campo+"'  value='"+JSON[campo]+"'>";
	}
	form+="<input id='REQUEST_METHOD' name='REQUEST_METHOD'  value='"+method+"'>";
	if(token!=null)
	{
		form+="<input id='__TOKEN' name='__TOKEN'  value='"+token+"'>";
	}
	form+="</form>";
	var form_ =  document.createElement("h1")
	form_.innerHTML = form;
	document.body.appendChild(form_);
	document.___FORM___POST.submit();
}


function REFRESH()
{
	location.reload();
}

function send(metodo,$url,dados,func=null,token=null)
{
	dados.REQUEST_METHOD=metodo;
	dados.__TOKEN=token;
	$.ajax(
			{
			   url: $url,
			   type: 'POST',
			   data :dados,
			   dataType: "json",
			   success: function(response) 
			   {
			     	func(response);
			   }
			});   
}

function msg_stop(tit,msg,func=null,icon='success')
{
	swal({
	  title: tit,
	  text: msg,
	  type: icon,
	  showCancelButton: false,
	  confirmButtonColor: "#8cd4f5",
	  confirmButtonText: "OK",
	  closeOnConfirm: true,
	  allowEscapeKey: false,
	  showLoaderOnConfirm: true
	},
	function(){
	  func();
	});
}

function msg(tit,msg,icon=null)
{
    swal(tit,msg,icon);
}

function msg_confirm(tit,msg,func = null,close=true)
{
   swal({
		  title: tit,
		  text: msg,
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Sim",
		  cancelButtonText: "Não",
		  closeOnConfirm: close
		},
		function()
		{
		   func();
		});
}

function msg_autoclose(tit,msg,tempo=2,icon="warning")
{
	swal({
	  title: tit,
	  text: msg,
	  timer: tempo*1000,
	  showConfirmButton: false,
	  type: icon
	});
}

function msg_input(tit,msg,func = null,config={required:true,msg_erro:"Campo Obrigatório"})
{
	swal({
	  title: tit,
	  text: msg,
	  type: "input",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  cancelButtonText: "Cancelar",
	  animation: "slide-from-top"
	},
	function(inputValue){
		if(config.required)
		{
		  if (inputValue === false) return false;
		  
		  if (inputValue === "") {
		    swal.showInputError(config.msg_erro);
		    return false
		  }

		}
	  func(inputValue);
	});
	return retorno;
}



