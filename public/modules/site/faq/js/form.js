/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_faq');

    $('#btn_save_faq').click(function (e) {
        e.preventDefault();

        if( $('#frm_faq').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_faq').submit();
        }
    });
});