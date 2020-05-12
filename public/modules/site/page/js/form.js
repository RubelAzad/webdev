/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_page');

    $('#btn_save_page').click(function (e) {
        e.preventDefault();

        if( $('#frm_page').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_page').submit();
        }
    });
});