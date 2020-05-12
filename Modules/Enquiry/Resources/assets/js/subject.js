$(function () {
    $('#btn_add_subject').click(function (e) {
        e.preventDefault();
        // reset_form();
        $('#subject_title').html('Create New Subject');
        $('#frm_subject').resetForm();
        $('#subject_id').val('');
        $('#div_form').show('slow');
        $('#subject').focus();
    });

    $('#btn_cancel_subject').click(function (e) {
        e.preventDefault();
        $('#frm_subject').resetForm();
        $('#subject_id').val('');
        $('#div_form').hide('slow');
    });

    valid_this_form('#frm_subject');

    $('#btn_save_subject').click(function (e) {
        e.preventDefault();

        if( $('#frm_subject').valid() ){
            $.LoadingOverlay('show');
            $('#frm_subject').submit();
        }
    });

    $('#tbl_subjects').on('click', '.edit', function (e) {
        e.preventDefault();

        let data = $(this).data();

        axios.get('/enquiry/subject-get/' + data.id)
            .then((response) => {
                let result = response.data;
                $('#subject_id').val(result.id);
                $('#subject').val(result.text);

                $('#subject_title').html('Update Subject');
                $('#div_form').show('slow');
                $('#subject').focus();
            });

    });

    $('#tbl_subjects').on('click', '.delete', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You are about to delete a subject!",
            type: "warning",
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if(result.value){
                $.LoadingOverlay('show');
                window.location.href = link;
            }
        });

    });
});