$(function () {
    $('#tbl_zones').DataTable({
        responsive: true,
        stateSave: true
    });

    $('#tbl_zones').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete a zone!",
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
