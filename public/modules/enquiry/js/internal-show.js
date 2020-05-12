$(function () {

    $("#agent_list").select2();

    $('#btn_assign_to_agent').click(function(e){
        e.preventDefault();

        let agent_id = $("#agent_list").val();
        let agent_name = $("#agent_list").select2('data')[0]['text'];

        if(agent_id === ''){
            swal('Please select an agent!', '', 'error');
            return false;
        }


        let html = '<h1>You are forwarding this enquiry to: <br><strong>' + agent_name +'</strong></h1>';

        swal({
            title: 'Are You Sure ?',
            type: 'warning',
            html: html,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Yes, Proceed!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then(function (result) {
            if(result.value){

                axios.post('/enquiry/assign_to_agent',{
                    agent_id: agent_id, enquiry_id: enquiry_id
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

    $('#btn_reply').click(function(e){
        e.preventDefault();

        let message = $('#reply_message').val();

        if(message === ''){
            swal('Please write something before sending the message!', '', 'error');
            return false;
        }

        axios.post('/enquiry/internal-reply',{
            enquiry_id: enquiry_id, message: message
        }).then((result) => {
            let data = result.data;
            if(data.status){
                swal('Confirmed!', '', 'success').then(()=>{
                    $('#reply_message').val('');
                    window.location.reload();
                });
            }else{
                swal('Something went wrong, please try again later', '', 'error');
            }
        });

    });

    $('#update_status').click(function(e){
        e.preventDefault();

        let status_id = $('#select_status').val();

        if(status_id === ''){
            swal('Please select a status!', '', 'error');
            return false;
        }

        axios.post('/enquiry/internal-update-status',{
            enquiry_id, status_id
        }).then((result) => {
            let data = result.data;
            if(data.status){
                swal('Confirmed!', '', 'success').then(()=>{
                    $('#status_name').html(data.new_status);
                });
            }else{
                swal('Something went wrong, please try again later', '', 'error');
            }
        });

    });

});