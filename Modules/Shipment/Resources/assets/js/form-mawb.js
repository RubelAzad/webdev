$(function () {

    $('#flight_date').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: true,
        startDate: '+0d',
        todayHighlight: true,
        zIndexOffset: 1000,
        autoclose: true
    });

    valid_this_form('#frm_hawb');

    $('#btn_save_mawb').click(function (e) {
        e.preventDefault();

        if( $('#frm_hawb').valid() ){
            $.LoadingOverlay('show', {
                image       : "",
                fontawesome : "fa fa-cog fa-spin"
            });
            $('#frm_hawb').submit();
        }
    });
});