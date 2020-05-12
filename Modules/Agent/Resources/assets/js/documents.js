$(function () {
    $('#btn_upload_document').click(function (e) {
        e.preventDefault();
        $('#mdl_upload_document').modal('show');
    });

    valid_this_form('#frm_upload_document');

    $('#btn_submit_document').click(function () {
        if( $('#frm_upload_document').valid() ){
            $('#frm_upload_document').submit();
        }
    });


    $('#frm_upload_document').submit(function (event) {
        event.preventDefault();
        $('#mdl_upload_document').modal('hide');
        $.LoadingOverlay('show');
        var agent_id = $('#agent_id').val();
        $(this).ajaxSubmit({
            data: { agent_id: agent_id },
            success: function (response) {
                $("#doc_list").html(response);
                $('#frm_upload_document')[0].reset();
            }
        });
        $.LoadingOverlay('hide');
    });

    $('#doc_list').on('click', '.delete-document', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
                title: "Are you sure?",
                text: "You are about to delete a document!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete it!",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    type: 'GET',
                    url: link,
                    success: function (response) {
                        $("#doc_list").html(response);
                        swal.close();
                    }
                });
            }
        );
    });

    var viewer = new DocumentViewer({
        $anchor: $('#full-width-container'),
    });

    $('#doc_list').on('click', '.view-document', function () {
        viewer.load('/file/serve/' + this.id, {
            extension:this.value,
            isModal:true,
            width:800
        });
    });

    $('body').on('contextmenu', 'canvas', function(ev) {
        return false;
    });
    $('body').on('contextmenu', '.dv-image', function(ev) {
        return false;
    });
});
