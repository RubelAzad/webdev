$(function () {

    var table = $('#tbl_post').DataTable({
        stateSave: true,
        autoWidth: true,
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        columnDefs: [
            {
                targets:   0,
                className: 'select-checkbox'
            },
            {
                targets: [0,9],
                orderable: false
            }
        ]
    });


    $('#btn_add_to_pickup').click(function (e) {
        e.preventDefault();

        let posts = [];

        //get selected row from table
        let selected_rows = table.rows( { selected: true } );

        // keep those selected row in a array
        selected_rows.every(function () {
            let tracking_no = this.data()[1];
            posts.push(tracking_no);
        });

        // if nothing selected, don't go ahead
        if(posts.length < 1){
            return false;
        }

        // get basic info for confirmation
        axios.post('/cargo/get-post-basic-info',{
            posts: posts
        }).then((result) => {
            console.log(result.data);
            swal({
                title: 'Are You Sure ?',
                type: 'question',
                html: result.data.info,
                showConfirmButton: result.data.allow_to_submit,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Yes, Proceed!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then(function (result) {
                if(result.value){

                    axios.post('/cargo/submit-for-pickup',{
                        posts: posts
                    }).then((result) => {
                        let data = result.data;
                        if(data.status){
                            swal('Confirmed!', '', 'success').then(()=>{
                                window.location.reload();
                            });
                        }else{
                            swal(data.msg, '', 'error');
                        }
                    });
                }
            });
        });
    });

    $('#tbl_post').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Canceling shipment?",
            type: "question",
            animation: false,
            customClass: 'animated tada',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show');
                window.location.href = link;
            }
        });

    });

});