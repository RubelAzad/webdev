$(function () {

    $('#tbl_services').DataTable({
        responsive: true,
        stateSave: true,
        initComplete: function () {
            this.api().columns([10,11]).every( function () {
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
        columnDefs: [
            {
                "targets": [11],
                "orderable": false
            }
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11 ]
                }
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11 ]
                },
                messageTop: 'Product List'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11 ]
                }
            },
            {
                extend: 'colvis',
                columns: ':not(.noVis)',
                postfixButtons: ['colvisRestore'],
            }
        ]
    });

    $('#tbl_services tfoot tr').prependTo('#tbl_services thead');


    $('#tbl_services').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete a service!",
            type: "warning",
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show');
                window.location.href = link;
            }
        });

    });
});
