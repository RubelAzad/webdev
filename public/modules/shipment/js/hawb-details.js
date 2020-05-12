$(function () {
    $('#tbl_hawb_details').dataTable();

    $('#tracking_no').change(function (e) {

    });

    $('#btn_add_post').click(function (e) {
        e.preventDefault();
        let tracking_no = $('#tracking_no').val();
        if( tracking_no !== ''){
            axios.post('/shipment/add-post-to-hawb',{
                hawb_id : hawb_id, tracking_no : tracking_no
            }).then((result) => {
                let data = result.data;
                swal(data.msg, '', data.status);
            });
        }
    });
});