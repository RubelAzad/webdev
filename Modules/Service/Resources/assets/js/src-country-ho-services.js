$(function () {

    // $('#tbl_services thead td').each( function () {
    //     var title = $(this).text();
    //     if(title != 'Actions'){
    //         $(this).html( '<input type="text" placeholder="Search" />' );
    //     }else{
    //         $(this).html( '' );
    //     }
    // } );

    let table = $('#tbl_services').DataTable({
        responsive: true,
        stateSave: true,
        "columnDefs": [
            {
                "targets": [10],
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
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9 ]
                }
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9 ]
                },
                messageTop: 'Product List'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9]
                }
            },
            {
                extend: 'colvis',
                columns: ':not(.noVis)',
                postfixButtons: ['colvisRestore'],
            }
        ]
    });

    // Apply the search
    // table.columns().every( function () {
    //     let that = this;
    //
    //     $( 'input', this.footer() ).on( 'keyup change', function () {
    //         if ( that.search() !== this.value ) {
    //             that
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );

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
