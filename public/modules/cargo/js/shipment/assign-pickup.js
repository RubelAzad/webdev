$(function () {
    $('#external_driver').checkboxpicker({
        offLabel : 'Internal',
        onLabel  : 'External',
    });

    $('#est_pickup_date').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: true,
        todayHighlight: true,
        autoclose: true,
        startDate: '1d',
    });

    $('#warehouse_id').change(function () {
        load_drivers();
    });

    $('#external_driver').checkboxpicker().on('change', function() {
        load_drivers();
    });

    function load_drivers() {
        let warehouse_id = $('#warehouse_id').val();

        let external_driver = false;

        if($('#external_driver').is(':checked')){
            external_driver = true;
        }

        if(warehouse_id === null || warehouse_id === ''){
            return false;
        }

        axios.post('/warehouse/get-drivers', {
            external_driver, warehouse_id
        }).then((response) => {
            let result = response.data;
            let driver_id = $('#driver_id');
            driver_id.empty();
            driver_id.append('<option value=""></option>');

            result.forEach(function (driver) {
                let option = '<option value="'+ driver.id +'">'+ driver.name +'</option>';
                driver_id.append(option);
            });
        });

    }

    valid_this_form('#frm_assign_shipment');

    $('#btn_submit').click(function (e) {
        e.preventDefault();

        if( $('#frm_assign_shipment').valid() ){
            $.LoadingOverlay('show');
            $('#frm_assign_shipment').submit();
        }

    });
});