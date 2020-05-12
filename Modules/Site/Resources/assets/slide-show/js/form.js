/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_slide_show');

    $('#btn_save_slide_show').click(function (e) {
        e.preventDefault();

        if( $('#frm_slide_show').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_slide_show').submit();
        }
    });
});