$(function () {
    $('#tbl_providers').DataTable({
        responsive: true,
        stateSave: true,
        "columnDefs": [
            {
                "targets": [4],
                "orderable": false
            }
        ],
    });

    $('#tbl_providers').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
                title: "Are you sure?",
                text: "You are about to delete a service provider!",
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
        });

    });
});
