<style type="text/css">
	.error
	{
		border-color: red;
	}
</style>
<div  id="div_original_excluir" >	
	<div class="col-md-10">
		<p><strong>Excluir este usuário</strong></p>
		<p>Tenha certeza, depois de faze-lo não será possivel voltar atras.</p>
	</div>
	<div class="col-md-2 pull-right" >
		<button class="btn  btn-danger btn-sm" id="btn_excluir">Excluir</button>
	</div>
</div>
<div id="inp1_danger_zone_excluir" style="display: none;"> 
    <div class="col-md-9">
        <div class="input-group input-group-sm"> 
        	<span class="input-group-addon">Email</span> 
        	<input type="text" class="form-control"  name="usuario_delete" id="usuario_delete" maxlength="250" placeholder="Email">  
        	<input type="text" name="____usuario_" id="____usuario_" hidden="">  
        </div>
    </div>
    <div class="col-md-3">
        <button class="btn  btn-success btn-sm" id="btn_alt_delete_prosseguir1">Prosseguir</button>
    </div>
</div>
<div id="inp2_danger_zone_excluir" style="display: none;">
    <div class="col-md-9">
        <div class="input-group input-group-sm"> 
        	<span class="input-group-addon">Senha</span> 
        	<input type="password" class="form-control"  name="senha_delete" id="senha_delete" maxlength="50" placeholder="Senha">  
        	<input type="text" name="____usuario_" id="____usuario_" hidden="">          	
        </div>
    </div>
    <div class="col-md-3">
        <button class="btn  btn-danger btn-sm" id="btn_alt_excluir">Excluir</button>
    </div>
</div>

<script type="text/javascript">
$('#btn_alt_delete_prosseguir1').on('click',function()
{
	var id = {{$id}};
	var email = $( "#usuario_delete" ).val();
	xCode.ajax("post","{{asset('admin/users/validausuario')}}",{email:email,id:id}).then(function(validou)
	{	
		if(validou)
		{
			$('#inp1_danger_zone_excluir').show();
			$('#inp2_danger_zone_excluir').hide();
			$('#inp1_danger_zone_excluir').toggle(150);
			$('#inp2_danger_zone_excluir').toggle(150);
			$( "#usuario" ).removeClass( "error" );				
		}
		else
		{
			$( "#usuario" ).addClass( "error" );
			msg("oops!","Usuário Incorreto","error");
		}		
	}); 
});

$('#btn_alt_excluir').on('click',function()
{
	var id = {{$id}};
	var senha = $( "#senha_delete" ).val();
	xCode.ajax("post","{{asset('admin/users/validasenha')}}",{senha:senha,id:id}).then(function(validou)
	{	
		if(validou)
		{
			xCode.ajax("delete","{{asset('admin/users/destroy')}}",{id:id}).then(function(excluiu)
			{
				if(!excluiu)
					xCode.msg("oops!","Erro ao Excluir Usuário","error");
				else
				{
					load("{{asset('admin/users')}}");
				}
			});		
		}
		else
		{
			$( "#senha_alt_usuario" ).addClass( "error" );
			return msg("oops!","Senha incorreta","error");
		}		
	}); 
	$('#inp2_danger_zone_excluir').show();
	$('#div_original_excluir').hide();
	$('#inp2_danger_zone_excluir').toggle(150);
	$('#div_original_excluir').toggle(150);
});
function limpar()
{
	$( "#usuario_delete" ).val('');
	$( "#senha_delete" ).val('');
}
$('#btn_excluir').on('click',function()
{	
	limpar();
	$('#div_original_excluir').toggle(150);
	$('#inp1_danger_zone_excluir').toggle(150);
});
</script>