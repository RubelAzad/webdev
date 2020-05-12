$(function () {
    $('#tbl_valuables').DataTable({
        responsive: true,
        stateSave: true,
        initComplete: function () {
            this.api().columns([1,2]).every( function () {
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
                targets: [8, 9],
                orderable: false
            }
        ],
        dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7 ]
                }
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7 ]
                },
                messageTop: 'Product List'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7 ]
                }
            },
            {
                extend: 'colvis',
                columns: ':not(.noVis)',
                postfixButtons: ['colvisRestore'],
            }
        ]
    });

    $('#tbl_valuables tfoot tr').prependTo('#tbl_valuables thead');

    $('#tbl_valuables').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
                title: "Are you sure?",
                text: "You are about to delete a valuable item!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!"
        }).then((result) => {
            if(result.value){
                $.LoadingOverlay('show', {
                    image       : "",
                    fontawesome : "fa fa-cog fa-spin"
                });
                window.location.href = link;
            }
        })

    });
});
