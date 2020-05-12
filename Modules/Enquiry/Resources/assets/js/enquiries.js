$(function () {
    $('#tbl_enquiries').DataTable({
        responsive:true,
        "columnDefs": [
            {
                "targets": [6],
                "orderable": false
            }
        ],
    });

});