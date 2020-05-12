/**
 * Created by Bashet on 09/09/2016.
 */
$(function () {
    $('#message_sent_items').DataTable({
        initComplete: function () {
            this.api().columns([1,2,3,5]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
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
        "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false
            }
        ]
    } );

    $('#message_sent_items').on('click', '.view_msg', function () {
        var msg_id = this.id.split('-');
        var id = msg_id[1];
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/message/show_one_ajax",
            datatype: 'JSON',
            data:{id:id}
        }).done(function(result) {
            $('#show_message_here').html(result);
            $('#mdl_view_message').modal('show');
        });
    });

});
