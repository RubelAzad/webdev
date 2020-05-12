/**
 * Created by Bashet on 20/02/2018.
 */

$(function () {
    $('#btn_add_employee').click(function (e) {
        e.preventDefault();
        resetForm($('#frm_employee'));
        $('#employee_id').val('');
        $('#director_country').val(country);
        $('#mdl_employee_title').html('Add Employee');
        $('#mdl_employee').modal('show');
    });

    $('#director_postcode_lookup').getAddress({
        api_key: '3Ihph0lYAU6P1llsphU68Q5211',
        output_fields:{
            line_1: '#director_address_line_1',
            line_2: '#director_address_line_2',
            line_3: '#director_address_line_3',
            post_town: '#director_city',
            county: '#director_county',
            postcode: '#director_postcode'
        }
    });



    valid_this_form('#frm_employee');

    var employee_form = $('#frm_employee');

    $('#btn_submit_employee').click(function (e) {
        e.preventDefault();

        if( employee_form.valid() ){
            employee_form.submit();
        }
    });

    employee_form.submit(function (e) {
        e.preventDefault();

        $('#mdl_employee').modal('hide');
        $.LoadingOverlay('show');
        employee_form.ajaxSubmit({
            data: { franchise_id: franchise_id },
            success: function (result) {
                $('#employee_list').html(result);
                $.LoadingOverlay('hide');
            }
        });

    });

    $('#employee_list').on('click', '.edit', function (e) {
        e.preventDefault();
        var data = $(this).data();
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/franchise/get-employee",
            datatype: 'JSON',
            data:{employee_id : data.employee_id}
        }).done(function( result ) {
            $('#employee_id').val(result.id);
            $('#officer_type_id').val(result.type_id);
            $('#director_name').val(result.name);
            $('#director_country').val(result.country);
            $('#director_address_line_1').val(result.address_line_1);
            $('#director_address_line_2').val(result.address_line_2);
            $('#director_address_line_3').val(result.address_line_3);
            $('#director_city').val(result.city);
            $('#director_county').val(result.county);
            $('#director_postcode').val(result.postcode);
            $('#director_phone_number').val(result.phone_number);
            $('#director_email').val(result.email);

            $('#mdl_employee_title').html('Edit Employee');
            $('#mdl_employee').modal('show');
        });
    });

    $('#employee_list').on('click', '.delete', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
                title: "Are you sure?",
                text: "You are about to delete an employee from franchise!",
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
                    success: function (result) {
                        $("#employee_list").html(result);
                        swal.close();
                    }
                });
            }
        );
    });


});