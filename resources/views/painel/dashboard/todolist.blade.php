
<div class="box box-primary">
  <div class="box-header ui-sortable-handle" style="cursor: move;">
    <i class="ion ion-clipboard"></i>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>      
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
    <h3 class="box-title">Lista de Tarefas</h3>
    
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <ul class="todo-list ui-sortable">
        @foreach(Auth::user()->todolist as $lista)      
        <li>
          <input type="checkbox" onchange="selecionar_todo({{$lista->id}})" @if($lista->checked=="S") checked="checked" @endif>
          <!-- todo text -->
          <span class="text">{{$lista->descricao}}</span>
          <div class="tools">
            <i class="fa fa-edit" onclick="todo_editar({{$lista->id}},'{{$lista->descricao}}')" ></i>
            <i class="fa fa-trash-o" onclick="todo_delete({{$lista->id}})"></i>
          </div>
        </li>
        @endforeach
    </ul>
  </div>
  <!-- /.box-body -->
  <div class="box-footer clearfix no-border">
    <a class="btn btn-primary btn-sm rounded pull-right"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#novo_afazer">
        Adicionar novo
    </a> 
  </div>
</div>



<div class="modal fade" id="novo_afazer">
    <div class="modal-dialog" role="document">

        <form id="frm_cadastro_todo_list" action="" method="">
            <div class="modal-content">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-plus"></i> Cadastro de afazer </h4> 
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Descrição</span> 
                                <input type="text" class="form-control" name="descricao" id="todo_descricao" required maxlength="50"> 
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer"> 
                    <input type="submit" class="btn btn-primary btn-sm" value="Confirmar"> 
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="cancelar()">Cancelar</button> 
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="editar_afazer">
    <div class="modal-dialog" role="document">
        <form id="frm_editar_todo_list">
            <div class="modal-content">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-pencil"></i> editar afazer </h4> 
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-sm"> 
                                <span class="input-group-addon">Descrição</span> 
                                <input type="text" class="form-control" name="descricao" id="todo_descricao_edicao" maxlength="50"> 
                                <input type="text" hidden name="id" id="id_edicao_todo"> 
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer"> 
                    <input type="submit" class="btn btn-primary" value="Confirmar"> 
                    <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal" onclick="cancelar()">Cancelar</button> 
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script type="text/javascript">
function selecionar_todo(id)
{
    xCode.ajax("put","{{asset('admin/dashboard/checartodo')}}",{id}).then(function(response)
    {
        console.log(response);
    });
}
function todo_delete(id)
{
    msg_confirm("Confirmação","Deseja mesmo excluir este afazer ?",function()
    {   
        xCode.ajax("delete","{{asset('admin/dashboard/destroytodo')}}",{id}).then(function(response)
        {
            if(response.success)
                reload();         
            else
                msg('Oops',response.msg,"error");
        });        
    });
}

function cancelar()
{
    $('#todo_descricao_edicao').val('');
    $('#todo_descricao').val('');
}

$('#frm_cadastro_todo_list').submit(function(form) 
{
    msg_confirm("Confirmação","Confirma o cadastro deste afazer ?",function()
    {
        var descricao = $('#frm_cadastro_todo_list').FormData()['descricao'];
        xCode.ajax("post","{{asset('admin/dashboard/createtodo')}}",{descricao}).then(function(response)
        {            
            if(response.success)
            {            
                $('#novo_afazer').modal('toggle'); 
                reload();
            }   
            else
            {
                msg('Oops',response.msg,"error");                
            }
        });    
    });
    return false;
});


$('#frm_editar_todo_list').submit(function(form) 
{
    msg_confirm("Confirmação","Confirma a alteração deste afazer ?",function()
    {
        var form = $('#frm_editar_todo_list').FormData();
        var descricao = form['descricao'];
        var id = form['id'];
        xCode.ajax("put","{{asset('admin/dashboard/edittodo')}}",{id:id,descricao:descricao}).then(function(response)
        {
            if(response.success)
            {
                reload();
            } 
            else
            {
                msg('Oops',response.msg,"error");                
            }   
        });    
    });
    return false;
});



function todo_editar(id,descricao)
{
    $('#todo_descricao_edicao').val(descricao);    
    $('#id_edicao_todo').val(id);    
    $('#editar_afazer').modal('toggle');
}
</script>

