/**
 * Created by Bashet on 12/06/2016.
 */
$(function () {

    $('.change_user_status').checkboxpicker({
        baseGroupCls: 'btn-group btn-group-sm'
    });

    $('#users').DataTable({
        "columnDefs": [
            {
                "targets": [5],
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

    $('#users').on('click', '.delete_user', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete an user!",
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

    $('#users').on('change', '.change_user_status', function() {
        var input_id = this.id;
        var id_array = input_id.split('-');
        var id = id_array[1];
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/user/change-status",
            datatype: 'JSON',
            data:{id:id}
        }).done(function( msg ) {
            var status = $('#' + input_id);
            if(msg.result == 1){
                status.attr('checked', true)
            }else{
                status.attr('checked', false)
            }
            toastr.success("Status Updated!", '',{
                positionClass: 'toast-bottom-right'
            });
        });
    });

    valid_this_form('#frm_password');

    $('#btn_change_password').click(function (e) {
        e.preventDefault();

        if( $('#frm_password').valid() ){
            $.LoadingOverlay('show');
            $('#frm_password').submit();
        }
    });


});
