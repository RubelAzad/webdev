$(function () {
    $('#country_code').chosen();

    valid_this_form('#frm_warehouse');

    $('#btn_save_warehouse').click(function (e) {
        e.preventDefault();

        if( $('#frm_warehouse').valid() ){

            $.LoadingOverlay('show', {
                image       : "",
                fontawesome : "fa fa-cog fa-spin"
            });

            $('#frm_warehouse').submit();
        }
    });
});