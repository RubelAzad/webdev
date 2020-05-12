/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_service');

    $('#btn_save_service').click(function (e) {
        e.preventDefault();

        if( $('#frm_service').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_service').submit();
        }
    });
});