function ajax(metodo,$url,dados,func=null)
{
	$.ajaxSetup(
	{
	   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
	$.ajax(
			{
			   url: $url,
			   type: metodo,
			   data :dados,
			   dataType: "json",
			   success: function(response) 
			   {
			     	func(response);
			   }
			});   
}

function send(method,url,JSON = {})
{
	var form = "<form hidden action='"+url+"' name='___FORM___POST' id='___FORM___POST' method='POST'>";
	for (var campo in JSON) 
	{
	   form+="<input id='"+campo+"' name='"+campo+"'  value='"+JSON[campo]+"'>";
	}
	form+="<input name='_token' value='"+$('meta[name=_token]').attr('content')+"'>";
	form+="</form>";
	var form_ =  document.createElement("h1")
	form_.innerHTML = form;
	document.body.appendChild(form_);
	document.___FORM___POST.submit();
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

function reload(refresh=true)
{
	var url = document.location.pathname;
	if(refresh)
		location.reload();
	else
      $("body").load(url);		
}

function load(url,refresh=true)
{
	if(refresh)
		location.href=url;
	else
       $("body").load(url);				
}

