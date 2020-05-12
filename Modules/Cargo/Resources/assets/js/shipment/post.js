$(function () {

    $('#tbl_post thead td').each( function () {
        var title = $(this).text();
        if(title == 'Actions' || title == 'SN' || title == 'Select'){
            $(this).html( '' );
        }else if(title == 'Date'){
            $(this).html( '<input type="text" class="form-control datepicker" placeholder="Search '+title+'" />' );
        } else{
            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
        }
    } );

    $('.datepicker').datepicker();

    var table = $('#tbl_post').DataTable({
        stateSave: true,
        autoWidth: true,
        columnDefs: [
            {
                targets:   0,
                orderable: false,
                className: 'select-checkbox'
            },
            {
                targets: [8],
                orderable: false
            }
        ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        }
    });

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

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
                type: 'warning',
                html: result.data.info,
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
                            swal('Something went wrong, please try again later', '', 'error');
                        }
                    });
                }
            });
        });
    });

});