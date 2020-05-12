$(function () {

    $('#valuable_status').checkboxpicker();

    $('.select2').select2({
        allowClear: true
    });

    valid_this_form('#frm_valuable');

    $('#btn_save_valuable').click(function (e) {
        e.preventDefault();
        let cost = $('#price').val();
        let franchise = $('#franchise').val();
        let agent = $('#agent').val();

        if(cost < (parseFloat(franchise)  + parseFloat(agent))){
            swal('Total commission can not be grater then shipment cost!', '', 'error');
            return false;
        }

        if( $('#frm_valuable').valid() ){
            $.LoadingOverlay('show');
            $('#frm_valuable').submit();
        }
    });

    $('#price').change(function () {
        $('#commission').trigger('change');
    });

    $('#commission').change(function(){
        calculate_comission();
    });

    function calculate_comission(){
        let price = $('#price').val();
        let commission = $('#commission').val();

        let amount = parseFloat(price) * parseFloat(commission) / 100;

        $('#commission_amount').val(amount.toFixed(2));

        let ho_price = parseFloat(price) - parseFloat(amount);
        $('#ho_price').val(ho_price);

    }

    // keep it down
    $('#commission').trigger('change');

});
