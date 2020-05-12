$(function () {
    $('#service_status').checkboxpicker();
    $('.select2').select2();

    valid_this_form('#frm_service');

    $('#commission').change(function () {
        calculation();
    });
    $('#commission').keyup(function () {
        calculation();
    });

    $('#price').change(function () {
        calculation();
    });
    $('#price').keyup(function () {
        calculation();
    });

    $('#base_price').change(function () {
        calculation();
    });
    $('#base_price').keyup(function () {
        calculation();
    });


    function calculation() {
        let commission = $('#commission').val();
        let unit_price = $('#price').val();
        let base_price = $('#base_price').val();

        let commission_unit_price = parseFloat(unit_price) * parseFloat(commission) / 100;
        let sales_unit_price = parseFloat(unit_price) + parseFloat(commission_unit_price);

        let commission_base_price = parseFloat(base_price) * parseFloat(commission) / 100;
        let sales_base_price = parseFloat(base_price) + parseFloat(commission_base_price);

        $('#ho_unit_price').html(unit_price);
        $('#ho_base_price').html(base_price);
        $('#sales_unit_price').html(sales_unit_price.toFixed(2));
        $('#sales_base_price').html(sales_base_price.toFixed(2));
        $('#commission_unit_price').html(commission_unit_price.toFixed(2));
        $('#commission_base_price').html(commission_base_price.toFixed(2));
    }

    $('#btn_save_service').change(function (e) {
        e.preventDefault();
        if($('#frm_service').valid()){
            $.LoadingOverlay('show');
            $('#frm_service').submit();
        }
    });

    $('#commission').trigger('change');


});
