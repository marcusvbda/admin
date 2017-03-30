function dataTable(tabela)
{
    var table = $(tabela).DataTable(
    {
        select: true,
        lengthChange: true,
        responsive: true,
        lengthMenu: [
            [ 10, 25, 50,100, -1 ],
            [ '10', '25', '50 ', '100', 'Todos' ]
        ],
        buttons:
        [
          {extend : 'excel', text: 'Excel'},
          {extend : 'pdf', text: 'PDF'},
          {extend : 'print', text: 'Imprimir'}
        ],
        "oLanguage": 
        {
           "sLengthMenu": "Mostrar _MENU_ ",
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
    },
    {
        "ordering": true
    } );
    table.buttons().container()
            .appendTo( tabela +'_wrapper .col-sm-6:eq(0)' );
    // $(tabela+' tbody').on( 'click', 'tr', function () 
    // {
    //     $(this).toggleClass('selected');
    // } );
    return table;
}


function spdatatable(tabela)
{
    var table = $(tabela).DataTable(
    {
        lengthChange: true,
        responsive: true,
        lengthMenu: [
            [ 10, 25, 50,100, -1 ],
            [ '10', '25', '50 ', '100', 'Todos' ]
        ],
        "oLanguage": 
        {
           "sLengthMenu": "Mostrar _MENU_ ",
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
    return table;
}
