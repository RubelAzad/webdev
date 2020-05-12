$(function () {

    $('#tbl_services').DataTable({
        responsive: true,
        stateSave: true,
        initComplete: function () {
            this.api().columns([8]).every( function () {
                let column = this;
                let select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        let val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            'csv',
            'excel',
            {
                extend: 'pdf',
                orientation: 'landscape',
                messageTop: 'Product List'
            },
            'print',
            {
                extend: 'colvis',
                columns: ':not(.noVis)',
                postfixButtons: ['colvisRestore'],
            }
        ]
    });

    $('#tbl_services tfoot tr').prependTo('#tbl_services thead');


});
