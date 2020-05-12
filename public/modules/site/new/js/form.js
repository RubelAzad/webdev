/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_news');

    $('#btn_save_news').click(function (e) {
        e.preventDefault();

        if( $('#frm_news').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_news').submit();
        }
    });
});