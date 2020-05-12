/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_partner');

    $('#btn_save_partner').click(function (e) {
        e.preventDefault();

        if( $('#frm_partner').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_partner').submit();
        }
    });
});