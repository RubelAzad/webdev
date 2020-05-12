/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_cat');

    $('#btn_save_cat').click(function (e) {
        e.preventDefault();

        if( $('#frm_cat').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_cat').submit();
        }
    });
});