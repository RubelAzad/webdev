$(function () {


    valid_this_form('#frm_payment');

    $('#btn_update_payment').click(function (e) {
        e.preventDefault();

        if( $('#frm_payment').valid() ){
            $.LoadingOverlay('show');
            $('#frm_payment').submit();
        }
    });
});