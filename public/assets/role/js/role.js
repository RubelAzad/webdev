/**
 * Created by Bashet on 12/06/2016.
 */
$(function () {

    //$('#tbl_roles').dataTable();

    $('#tbl_roles').on('click', '.role_status', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
                title: "Are you sure?",
                text: "You are about to change the status of a Role!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Proceed!",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            },
            function(){
                window.location.href = link;
            }
        );
    });

    $('#tbl_roles').on('click', '.role_delete', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
                title: "Are you sure?",
                text: "You are about to delete a Role!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete it!",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            },
            function(){
                window.location.href = link;
            }
        );
    });

});
