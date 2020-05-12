$(function () {

    let posts = [];
    let total_pieces = 0;

    $('#clear_search_post').click(function (e) {
        e.preventDefault();

        let search_box = $('#tracking_number').parent();
        if(search_box.hasClass('has-error')){
            search_box.removeClass('has-error');
        }

        $('#tracking_number').val('').focus();
    });

    $('#search_post').click(function (e) {
        e.preventDefault();

        let tracking_no = $('#tracking_number').val();
        let search_box = $('#tracking_number').parent();

        if(tracking_no === '' || tracking_no == null){
            search_box.addClass('has-error');
            return false;
        }else {
            if(search_box.hasClass('has-error')){
                search_box.removeClass('has-error');
            }
        }

        axios.get('/warehouse/get-post/' + tracking_no)
            .then( (response) => {
                let data = response.data;

                let row = '<tr data-post_id="'+ data.post_id +'" data-pieces="'+ data.pieces +'">'+
                    '<td class="center"><button class="btn btn-danger btn-sm remove"><i class="fa fa-times"></i></button></td>' +
                    '<td class="center">' + data.tracking_no + '</td>' +
                    '<td class="center">' + data.status + '</td>' +
                    '<td class="center">' + data.pieces + '</td>' +
                    '</tr>';

                $('#warehouse_entries_body').prepend(row);

                posts.push(data.post_id);

                total_pieces = + total_pieces + data.pieces;
                $('#total_pieces').html(total_pieces);

                $('#tracking_number').val('').focus();

                //console.log(data);
            } );

    });

    $('#tracking_number').keypress(function (e) {
        if(e.which == 13) {
            $('#search_post').trigger('click');
        }
    });

    $('#btn_confirm_received').click(function (e) {
        e.preventDefault();

        if(posts.length < 1){
            swal('Confirm Received ?', 'Please add some tracking number before confirm!', 'error');
            return false;
        }

        swal({
            title: "Are you sure?",
            text: "You are about to add " + posts.length + " pieces to the warehouse!",
            type: "question",
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed!',
            confirmButtonColor: '#d33',
        }).then(function (result) {
            if(result.value){

                axios.post('/warehouse/add-entry',{
                    posts
                }).then((response) => {
                    let data = response.data;
                    console.log(data);

                    swal(data.msg, '', data.status)
                        .then(()=>{
                            window.location.href = '/warehouse/entries';
                        });
                });
            }
        });

    });

    $('#warehouse_entries_body').on('click', '.remove', function (e) {
        e.preventDefault();

        let row = $(this).parent().parent();
        let data = row.data();
        let post_id = data.post_id;

        let index = posts.indexOf(post_id);

        if (index > -1) {
            posts.splice(index, 1);
        }

        total_pieces = + total_pieces - data.pieces;
        $('#total_pieces').html(total_pieces);

        row.hide('slow');

    });


});