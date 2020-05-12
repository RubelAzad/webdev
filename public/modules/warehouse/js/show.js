$(function () {
    //$('#tabs').tabs();

    $('#btn_add_employee').click(function (e) {
        e.preventDefault();

        $('#add_employee_form').slideDown();
    });

    $('#btn_close_emp_form').click(function (e) {
        e.preventDefault();
        $('#frm_add_employee').resetForm();
        $('#add_employee_form').slideUp();
    });

    $("#user_id").select2({
        placeholder: "Search for user",
        multiple: false,
        minimumInputLength: 2,
        minimumResultsForSearch: 10,
        ajax: {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/user/get-for-select2',
            dataType: "json",
            type: "POST",
            data: function (params) {
                return { term: params.term };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    valid_this_form('#frm_add_employee');

    $('#btn_submit_employee').click(function (e) {
        e.preventDefault();

        if( $('#frm_add_employee').valid() ){
            $.LoadingOverlay('show', {
                image       : "",
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_add_employee').submit();
        }
    });

    $('#frm_add_employee').submit(function (e) {
        e.preventDefault();

        $('#frm_add_employee').ajaxSubmit({

            success: function (result) {
                $('#employee_list').html(result.view);
                $('#btn_close_emp_form').trigger('click');
                $.LoadingOverlay('hide');
                swal(result.msg, '', result.status);
            }

        });

    });

    $('#employee_list').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to remove an employee from Warehouse!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d33',
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show');
                window.location.href = link;
            }
        });

    });

    $('#btn_add_external_driver').click(function (e) {
        e.preventDefault();

        $('#add_external_driver_form').slideDown();
    });

    $('#btn_close_external_driver_form').click(function (e) {
        e.preventDefault();
        $('#frm_add_external_driver').resetForm();
        $('#add_external_driver_form').slideUp();
    });

    valid_this_form('#frm_add_external_driver');

    $('#btn_submit_external_driver').click(function (e) {
        e.preventDefault();

        if( $('#frm_add_external_driver').valid() ){
            $.LoadingOverlay('show');
            $('#frm_add_external_driver').submit();
        }
    });


    $('#external_driver_list').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete an external driver from Warehouse!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d33',
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show');
                window.location.href = link;
            }
        });

    });
});