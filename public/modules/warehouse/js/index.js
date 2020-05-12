$(function () {
    $('#tbl_warehouse').DataTable({
        responsive: true,
        stateSave: true,
        "columnDefs": [
            {
                "targets": [4],
                "orderable": false
            }
        ],
    });

    $('#tbl_warehouse').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete a Warehouse!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d33',
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show', {
                    image       : "",
                    fontawesome : "fa fa-cog fa-spin"
                });
                window.location.href = link;
            }
        });

    });

});