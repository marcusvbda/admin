function dataTable(tabela)
{
   var table = $(tabela).DataTable( {
        lengthChange: false,
        buttons:
        [
          {extend : 'excel', text: 'Excel'},
          {extend : 'pdf', text: 'PDF'},
          {extend : 'colvis', text: 'Configurar Colunas'},
        ],
        "oLanguage": 
        {
           "sLengthMenu": "Exibindo _MENU_ registros por página",
           "sZeroRecords": "Sem Registros",
           "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
           "sInfoEmpty": "Mostrando 0 de 0 registros",
           "sSearch": "Pesquisar",
           "sInfoFiltered": "",
           "oPaginate": 
           {
               "sFirst":    "Primeira",
               "sLast":     "Última",
               "sNext":     "Próxima",
               "sPrevious": "Anterior",
            }
        }
    } );
    table.buttons().container()
            .appendTo( tabela+'_wrapper .col-sm-6:eq(0)' );
  
}