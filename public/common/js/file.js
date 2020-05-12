$(function () {

    var user_id = $('#user_id').val();

    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    var user_table = $('#tbl_user_files').DataTable({
        bDestroy: true,
        ajax : "/file/all/" + user_id,
        "columnDefs": [
            {
                "targets": 4,
                "orderable": false
            },
            { className: "center", "targets": [ 0, 3,4 ] }
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'l>r>t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "autoWidth" : true,
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_tabletools) {
                responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#tbl_user_files'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_datatable_tabletools.respond();
        }
    });


    var filesToUpload = null;

    function handleFileSelect(event)
    {
        var files = event.target.files || event.originalEvent.dataTransfer.files;
        // Itterate thru files (here I user Underscore.js function to do so).
        // Simply user 'for loop'.
        _.each(files, function(file) {
            filesToUpload.push(file);
        });
    }

    /**
     * Form submit
     */
    function handleFormSubmit(event)
    {
        event.preventDefault();

        var form = $('#frmFileUpload');
        var formData = new FormData();
        formData.append('file', $('input[type=file]')[0].files[0]);


        // Prevent multiple submisions
        if ($(form).data('loading') === true) {
            return;
        }
        $(form).data('loading', true);

        // Add selected files to FormData which will be sent
        if (filesToUpload) {
            _.each(filesToUpload, function(file){
                formData.append('cover[]', file);
            });
        }

        var other_data = form.serializeArray();
        $.each(other_data,function(key,input){
            formData.append(input.name,input.value);
        });

        var formURL = form.attr("action");

        $.ajax({
            type: "POST",
            url: formURL,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response)
            {

            },
            complete: function()
            {
                // Allow form to be submited again
                $(form).data('loading', false);
            },
            dataType: 'json'
        });
    }

    /**
     * Register events
     */
    /*$('input:file').on('change', handleFileSelect, function (event) {

    });*/

    $('#btn_update_file').click(function () {
        $('#frmFileUpload').submit();
    });
    $('#frmFileUpload').submit(function (event) {
        event.preventDefault();
        $('#mdl_file').modal('hide');
        $.LoadingOverlay("show");
        handleFormSubmit(event);
        user_table.ajax.reload();
        $.LoadingOverlay("hide");
    });

    var viewer = new DocumentViewer({
        $anchor: $('#full-width-container'),
    });

    $('#add_new_file').click(function () {
        $('#file').val('');
        $('#mdl_file').modal('show');
    });


    $('#description').inputlimiter();



    $('#tbl_files').on('click', '.edit_info', function () {
        var data = user_table.row( $(this).parents('tr') ).data();
        var file_id = this.id.split('-');
        var id = file_id[1];
        reset_update_form();
        $('#original_name').val(data[1]);
        $('#new_description').val(data[2]);
        $('#file_id').val(id);
        $('#mdl_file_info').modal('show');
    });

    $('#tbl_files').on('click', '.btn_viewer', function () {
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


    function reset_update_form() {
        $('#original_name').val('');
        $('#new_name_to_be').val('');
        $('#new_description').val('');
        $('#file_id').val('');
    }


    $('#btn_update_file_info').click(function (e) {
        e.preventDefault();
        $('#mdl_file_info').modal('hide');
        $('#frmFileUpdateInfo').submit();
    });

    $('#frmFileUpdateInfo').submit(function (e) {
        e.preventDefault();
        $.LoadingOverlay("show");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData
        }).done(function (data) {
            $.LoadingOverlay("hide");
            user_table.ajax.reload();
            swal('Successfully Updated!','', 'success');
        });
    });

    $('#tbl_files').on('click', '.btn_delete_file', function () {
        var file_id = this.id.split('-');
        var id = file_id[1];

        swal({
                title: "Are You Sure?",
                text: "You are about to delete a document!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                confirmButtonColor: "#DD6B55",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            },
            function(){
                $.LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "/file/delete",
                    datatype: 'JSON',
                    data:{file_id:id}
                }).done(function(data) {
                    if(data){
                        user_table.ajax.reload();
                        $.LoadingOverlay("hide");
                        swal('Successfully Updated!','', 'success');
                    }
                });

            }
        );


    });
});


