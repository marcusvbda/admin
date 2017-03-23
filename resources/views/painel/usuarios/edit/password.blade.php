<style type="text/css">
	.error
	{
		border-color: red;
	}
</style>
<div id="div_original_senha">
	<div class="col-md-10">
		<p><strong>Alterar senha</strong></p>
		<p>Para alterar a senha deste usuário é necessário saber a senha anterior.</p>
	</div>
	<div class="col-md-2 pull-right">
		<button class="btn  btn-warning btn-sm" id="btn_danger_zone_senha">Alterar</button>
	</div>
</div>
<div id="inp1_danger_zone_senha" style="display: none;"> 
    <div class="col-md-9">
        <div class="input-group input-group-sm"> 
        	<span class="input-group-addon">Usuário</span> 
        	<input type="text" class="form-control"  name="usuario" id="usuario" maxlength="250" placeholder="Email">  
        	<input type="text" name="____usuario_" id="____usuario_" hidden="">  
        </div>
    </div>
    <div class="col-md-3">
        <button class="btn  btn-success btn-sm" id="btn_alt_senha_prosseguir1">Prosseguir 1/3</button>
    </div>
</div>
<div id="inp2_danger_zone_senha" style="display: none;">
    <div class="col-md-9">
        <div class="input-group input-group-sm"> 
        	<span class="input-group-addon">senha</span> 
        	<input type="password" class="form-control"  name="senha_alt_antiga" id="senha_alt_antiga" maxlength="15" placeholder="Senha Antiga">  
        	<input type="text" name="____usuario_" id="____usuario_" hidden="">          	
        </div>
    </div>
    <div class="col-md-3">
        <button class="btn  btn-success btn-sm" id="btn_alt_senha_prosseguir2">Prosseguir 2/3</button>
    </div>
</div>
<div  id="inp3_danger_zone_senha" style="display: none;">
    <div class="col-md-9">
        <div class="input-group input-group-sm"> 
        	<span class="input-group-addon">Nova Senha</span> 
        	<input type="password" class="form-control"  name="novo_senha" id="novo_senha" maxlength="15" placeholder="Nova Senha">  
        </div>
    </div>
    <div class="col-md-3">
        <button class="btn  btn-success btn-sm" id="btn_alt_senha_confirmar">Prosseguir 3/3</button>
    </div>
</div>
<script type="text/javascript">
function limpar()
{
	$( "#usuario" ).val('');
	$( "#senha_alt_antiga" ).val('');
	$( "#novo_senha" ).val('');
}
$('#btn_alt_senha_prosseguir1').on('click',function()
{
	var id = {{$id}};
	var email = $( "#usuario" ).val();
	xCode.ajax("post","{{asset('admin/users/validausuario')}}",{email:email,id:id}).then(function(validou)
	{	
		if(validou)
		{
			$('#inp1_danger_zone_senha').show();
			$('#inp2_danger_zone_senha').hide();
			$('#inp1_danger_zone_senha').toggle(150);
			$('#inp2_danger_zone_senha').toggle(150);
			$( "#usuario" ).removeClass( "error" );				
		}
		else
		{
			$( "#usuario" ).addClass( "error" );
			msg("oops!","Usuário Incorreto","error");
		}		
	}); 
});

$('#btn_alt_senha_prosseguir2').on('click',function()
{
	var id = {{$id}};
	var senha = $( "#senha_alt_antiga" ).val();
	xCode.ajax("post","{{asset('admin/users/validasenha')}}",{senha:senha,id:id}).then(function(validou)
	{	
		if(validou)
		{
			$('#inp2_danger_zone_senha').show();
			$('#inp3_danger_zone_senha').hide();
			$('#inp2_danger_zone_senha').toggle(150);
			$('#inp3_danger_zone_senha').toggle(150);
			$( "#senha_alt_antiga" ).removeClass( "error" );				
		}
		else
		{
			$( "#senha_alt_antiga" ).addClass( "error" );
			msg("oops!","Senha incorreta","error");
		}		
	}); 
});

$('#btn_alt_senha_confirmar').on('click',function()
{
	var id = {{$id}};
	var senha = $( "#novo_senha" ).val();
	
	xCode.ajax('put',"{{asset('admin/users/alterarsenha')}}",{senha:senha,id:id}).then(function(alterou)
	{
		if(alterou)
			msg(":)","Senha alterada !","success");
		else
			msg("Oops","Erro ao alterar senha","error");
	});
	$('#inp3_danger_zone_senha').show();
	$('#div_original_senha').hide();
	$('#inp3_danger_zone_senha').toggle(150);
	$('#div_original_senha').toggle(150);
});

$('#btn_danger_zone_senha').on('click',function()
{	
	limpar();
	$('#div_original_senha').toggle(150);
	$('#inp1_danger_zone_senha').toggle(150);
});
</script>