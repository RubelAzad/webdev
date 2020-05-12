$(function () {
    $('#tbl_pickup_list thead td').each( function () {
        var title = $(this).text();
        if(title == 'Actions' || title == 'SN'){
            $(this).html( '' );
        }else if(title == 'Date'){
            $(this).html( '<input type="text" class="form-control datepicker" placeholder="Search '+title+'" />' );
        }else{
            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
        }
    } );

    var table = $('#tbl_pickup_list').DataTable({
        responsive: true,
        stateSave: true,
        columnDefs: [
            {
                "targets": [8],
                "orderable": false
            }
        ],
        dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>"
    });

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.header() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

});