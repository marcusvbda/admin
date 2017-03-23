<style type="text/css">
    .error
    {
        border-color: red;
    }
</style>
<table id="tb_contatos" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="display: none;"></th>                                
            <th>Contato</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th class="text-center"><span class="fa fa-gears"></span></th>
        </tr>
    </thead>
    <tbody>
    @foreach($contatos as $cont)
        <tr>                   
            <td style="display: none;">{{$cont->id}}</td>
            <td>{{$cont->contato}}</td>
            <td>{{$cont->email}}</td>
            <td>{{$cont->telefone}}</td>
            <td>{{$cont->celular}}</td>
            <td class="text-center" >
                <a type="button" class="btn btn-oval btn-info btn-sm" onclick="editar_contato({{$cont->id}})">
                    <span class="fa fa-search"></span> Editar / Ver
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">    
    <div class="col-md-12"> 
    <div class="pull-left">
            <button type="button" class="btn btn-primary btn-sm" onclick="novo_contato()">
                <span class="fa fa-plus"></span> Novo Contato
            </button>               
           <button type="button" class="btn btn-danger-outline btn-sm" onclick="excluir_contatos()">
               <span class="fa fa-trash"></span> Excluir
           </button>                              
        </div>
    </div>
</div>



<div class="modal fade" id="novo_contato">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-plus"></i> Cadastro de contatos </h4> 
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <form id="form_contato_novo"  onsubmit="return false;">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Contato</span> 
                                <input type="text" class="form-control" name="contato" id="contato_novo" maxlength="30"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Email</span> 
                                <input type="text" class="form-control" name="email" id="email_novo" maxlength="300"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Telefone Fixo</span> 
                                <input type="text" class="form-control" name="telefone" id="telefone_novo" maxlength="20"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Celular Fixo</span> 
                                <input type="text" class="form-control" name="celular" id="celular_novo" maxlength="20"> 
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-primary" onclick="cadastrar_contato()">Confirmar</button> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancelar_cadastro()">Cancelar</button> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="edicao_contato">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-pencil"></i> Edição de Contatos </h4> 
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <form id="form_contato_edicao"  onsubmit="return false;">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Contato</span> 
                                <input type="text" class="form-control" name="contato" id="contato_edicao" maxlength="30"> 
                                <input type="text" name="id" id="id_edicao" hidden> 
                                <input type="text" name="codigo" id="codigo_edicao" hidden> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Email</span> 
                                <input type="text" class="form-control" name="email" id="email_edicao" maxlength="300"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Telefone Fixo</span> 
                                <input type="text" class="form-control" name="telefone" id="telefone_edicao" maxlength="20"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Celular Fixo</span> 
                                <input type="text" class="form-control" name="celular" id="celular_edicao" maxlength="20"> 
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-primary" onclick="finalizar_editar_contato()">Confirmar</button> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancelar_edicao()">Cancelar</button> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
var table_contatos = dataTable('#tb_contatos');    
var contatos_selecionados = [];
$('#contato_novo').keypress(function(e) 
{
    if(e.which == 13)
    {
        $('#email_novo').focus();
    }
});
$('#email_novo').keypress(function(e) 
{
    if(e.which == 13)
    {
        $('#telefone_novo').focus();
    }
});
$('#telefone_novo').keypress(function(e) 
{
    if(e.which == 13)
    {
        $('#celular_novo').focus();
    }
});
$('#celular_novo').keypress(function(e) 
{
    if(e.which == 13)
    {
        cadastrar_contato();
    }
});
function getSelecionados_contatos()
{
    var dados = table_contatos.rows('.selected').data();
    var selecionados = [];
    for (var i=0; i < dados.length ;i++)
    {
       selecionados[i] = dados[i][0];
    }
    return selecionados;
}


function excluir_contatos()
{
    var contatos_selecionados = getSelecionados_contatos();
    if(contatos_selecionados.length<=0)
        return msg('Oops','Nenhum item selecionado para ação','error');
    msg_confirm('Confirmação',"Deseja mesmo excluir estes contatos ?",function()
    {   
        xCode.ajax("post","{{asset('admin/persons/contacts/destroy')}}",{contatos_selecionados}).then(function(response)
        {
            console.log(response)
            if(response.success)         
                msg_stop(":)",response.msg,function()
                {
                    reload_div('#tb_contatos');
                });
            else
                return msg("Oops",response.msg,"error"); 
        });    
    });    
}

function novo_contato()
{
    limpar();
    $("#telefone_novo").mask("(99) 9999-9999");
    $("#celular_novo").mask("(99) 99999-9999");
    $('#novo_contato').modal('toggle'); 
}

function editar_contato(id)
{
    xCode.ajax("post","{{asset('admin/persons/contacts')}}"+"/"+id,{}).then(function(contato)
    {
        $("#telefone_edicao").val(contato.telefone);
        $("#email_edicao").val(contato.email);
        $("#contato_edicao").val(contato.contato);
        $("#celular_edicao").val(contato.celular);
        $("#id_edicao").val(contato.id);
        $("#codigo_edicao").val(contato.codigo);
        $('#edicao_contato').modal('toggle');
    });
}

function limpar()
{
    $("#telefone_novo").val("");
    $("#email_novo").val("");
    $("#contato_novo").val("");
    $("#celular_novo").val("");

    $("#telefone_edicao").val("");
    $("#email_edicao").val("");
    $("#contato_edicao").val("");
    $("#celular_edicao").val("");
}
function cancelar_cadastro()
{
    $('#novo_contato').modal('toggle');     
    limpar();
}
function cancelar_edicao()
{
    $('#edicao_contato').modal('toggle');     
    limpar();
}
function cadastrar_contato()
{
    var dados = $('#form_contato_novo').FormData();
    dados['pessoa_id']='{{$pessoa_id}}';
    msg_confirm('Confirmação',"Confirma o cadastro deste contato ?",function()
    {   
        xCode.ajax('post',"{{asset('admin/persons/contacts/store')}}",dados).then(function(response)
        {
            if(response.success)
            {
                $('#novo_contato').modal('toggle'); 
                reload_div('#tb_contatos');   
                contatos_selecionados = [];
            }
            else
                return msg("Ooops",response.msg,"error");
        });
    });    
}

function finalizar_editar_contato()
{
    var dados = $('#form_contato_edicao').FormData();
    dados['pessoa_id']='{{$pessoa_id}}';
    msg_confirm('Confirmação',"Confirma adição deste contato ?",function()
    {   
        xCode.ajax('post',"{{asset('admin/persons/contacts/edit')}}",dados).then(function(response)
        {
            if(response.success)
            {
                $('#edicao_contato').modal('toggle'); 
                reload_div('#tb_contatos');  
            }
            else
                return msg("Ooops",response.msg,"error");
        });
    });    
}

</script>