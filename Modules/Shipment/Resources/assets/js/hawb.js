$(function () {

    $('#tbl_hawb').dataTable({
        responsive: true,
        stateSave: true,
        "order": [[ 0, "desc" ]],
        "columnDefs": [
            {
                "targets": [5],
                "orderable": false
            }
        ],
    });

    $('#btn_create_new_hawb').click(function (e) {
        e.preventDefault();
        swal({
            title: 'Enter maximum Weight for new HAWB',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: (result) => {
                if( ! result){
                    swal.showValidationError('Enter maximum weight!');
                }
                axios.post('/shipment/update-hawb', {
                    weight: result
                }).then((result) => {
                    window.location.href = '/shipment/hawb/' + result.data.id;
                })
            },
            allowOutsideClick: () => !swal.isLoading()
        })
    });

    $('#tbl_hawb').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete a HAWB!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show', {
                    image       : "",
                    fontawesome : "fa fa-cog fa-spin"
                });
                window.location.href = link;
            }
        });
    });

    $('#tbl_hawb').on('click', '.edit', function (e) {
        e.preventDefault();

        let data = $(this).data();
        let hawb_id = data.id;

        axios.get('/shipment/get-hawb/' + hawb_id)
            .then((result) => {
                let hawb = result.data;
                swal({
                    title: 'Enter maximum Weight for this HAWB',
                    input: 'text',
                    inputValue: hawb.max_weight,
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    showLoaderOnConfirm: true,
                    preConfirm: (result) => {
                        if( ! result){
                            swal.showValidationError('Enter maximum weight!');
                        }

                        axios.post('/shipment/update-hawb', {
                            weight: result, hawb_id : hawb.id
                        }).then((result) => {
                            window.location.href = '/shipment/hawb/' + result.data.id;
                        })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                })
            });

    });

});