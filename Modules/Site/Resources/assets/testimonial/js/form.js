/**
 * Created by Bashet on 06/05/2018.
 */
$(function () {
    valid_this_form('#frm_testimonial');

    $('#btn_save_testimonial').click(function (e) {
        e.preventDefault();

        if( $('#frm_testimonial').valid() ){
            $.LoadingOverlay('show',{
                image: '',
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_testimonial').submit();
        }
    });
});