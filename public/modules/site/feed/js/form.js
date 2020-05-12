/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_feed');

    $('#btn_save_feed').click(function (e) {
        e.preventDefault();

        if( $('#frm_feed').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_feed').submit();
        }
    });
});