$(function () {

    valid_this_form('#frm_enquiry');

    $('#btn_save_enquiry').click(function (e) {
        e.preventDefault();

        if( $('#frm_enquiry').valid() ){
            $('#frm_enquiry').submit();
        }
    });

});