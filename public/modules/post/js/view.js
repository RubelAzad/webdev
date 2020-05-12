$(function () {
    $('#sender_postcode_lookup').getAddress({
        api_key: '3Ihph0lYAU6P1llsphU68Q5211',
        output_fields:{
            line_1: '#sender_address_line_1',
            line_2: '#sender_address_line_2',
            line_3: '#sender_address_line_3',
            post_town: '#sender_city',
            county: '#sender_county',
            postcode: '#sender_postcode'
        }
    });

    $('#btn_edit_sender').click(function (e) {
       e.preventDefault();

       $('#div_sender_info').hide('slow');
       $('#div_edit_sender_info').show('slow');

    });

    $('#btn_cancel_update_sender').click(function (e) {
        e.preventDefault();

        $('#div_sender_info').show('slow');
        $('#div_edit_sender_info').hide('slow');
    });

    valid_this_form('#frm_create_sender');

    $('#btn_update_sender').click(function (e) {
        e.preventDefault();

        if( $('#frm_create_sender').valid() ){
            $('#frm_create_sender').submit();
        }

    });

    $('#frm_create_sender').submit(function (e) {
        e.preventDefault();

        $('#frm_create_sender').ajaxSubmit({
            success: function (result) {
                //update with latest data and show them

                $('#div_sender_info').show('slow');
                $('#div_edit_sender_info').hide('slow');
            },
            error: function (result) {

                swal('Something went wrong!', 'Please re-start the process', 'error');
            }
        });
    });

    $('#btn_edit_receiver').click(function (e) {
        e.preventDefault();

        $('#div_receiver_info').hide('slow');
        $('#div_edit_receiver_info').show('slow');

    });

    $('#btn_cancel_update_receiver').click(function (e) {
        e.preventDefault();

        $('#div_receiver_info').show('slow');
        $('#div_edit_receiver_info').hide('slow');
    });

    valid_this_form('#frm_create_receiver');

    $('#btn_update_receiver').click(function (e) {
        e.preventDefault();

        if( $('#frm_create_receiver').valid() ){
            $('#frm_create_receiver').submit();
        }

    });

    $('#frm_create_receiver').submit(function (e) {
        e.preventDefault();

        $('#frm_create_receiver').ajaxSubmit({
            success: function (result) {
                //update with latest data and show them

                $('#div_receiver_info').show('slow');
                $('#div_edit_receiver_info').hide('slow');
            },
            error: function (result) {

                swal('Something went wrong!', 'Please re-start the process', 'error');
            }
        });
    });


});