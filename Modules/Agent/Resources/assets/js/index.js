/**
 * Created by Bashet on 19/02/2018.
 */

$(function () {
    $('#tbl_agents').dataTable({
        responsive:true,
        "columnDefs": [
            {
                "targets": [8],
                "orderable": false
            }
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>"
    });

    $('#tbl_agents').on('click', '.delete_agent', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete an agent!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show');
                window.location.href = link;
            }
        });

    });

    $('input[enable_agent]').click(function () {
        let input_id = this.id;
        let id_array = input_id.split('-');
        let id = id_array[1];
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/agent/change-status",
            datatype: 'JSON',
            data:{id:id}
        }).done(function( msg ) {
            let status = $('#' + input_id);
            if(msg.result == 1){
                status.attr('checked', true)
            }else{
                status.attr('checked', false)
            }

            $.bigBox({
                title : "Status Updated!",
                content : "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
                color : "#739E73",
                icon : "fa fa-check",
                timeout : 5000
            });

            // $.smallBox({
            //     title : "Status Updated!",
            //     content : "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
            //     color : "#296191",
            //     iconSmall : "fa fa-thumbs-up bounce animated",
            //     timeout : 5000
            // });
        });
    });

});