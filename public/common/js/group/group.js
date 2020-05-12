/**
 * Created by Bashet on 14/12/2016.
 */

$(function () {
    $('#btn_add_new_group').click(function () {
        swal({
                title: "New Group!",
                text: "Enter a new group name:",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Enter a new group name"
            },
            function(inputValue){
                if (inputValue === false) return false;

                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }

                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "/user/group/add-new",
                    datatype: 'JSON',
                    data:{name:inputValue}
                }).done(function( result ) {
                    if(result.status){
                        $('#user_group_table_body').html(result.data);
                        swal('Updated!', '', 'success');
                    }else{
                        swal('Could not update!',result.msg,'error');
                    }
                });

            });
    });

    $('#tbl_user_groups').on('click', '.change_group_status', function () {
        var input_id = this.id;
        var id_array = input_id.split('-');
        var id = id_array[1];
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/user/group/change-status",
            datatype: 'JSON',
            data:{id:id}
        }).done(function( result ) {
            var status = $('#' + input_id);

            if(result.data){
                status.attr('checked', true)
            }else{
                status.attr('checked', false)
            }

            if( ! result.status){
                swal('Could not update!', result.msg, 'error');
            }else{
                $.smallBox({
                    title : "Group status updated!",
                    content : "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
                    color : "#296191",
                    iconSmall : "fa fa-thumbs-up bounce animated",
                    timeout : 5000
                });
            }

        });
    });

    $('#tbl_user_groups').on('click', '.delete_group', function () {
        var id = this.value;
        swal({
                title: "Are You Sure?",
                text: "You are about to delete a group!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                confirmButtonColor: "#DD6B55",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "/user/group/delete",
                    datatype: 'JSON',
                    data:{id:id}
                }).done(function(result) {
                    if(result.status){
                        $('#user_group_table_body').html(result.data);
                        swal('Updated!', '', 'success');
                    }else{
                        swal('Could not update!', result.msg, 'error');
                    }
                });

            }
        );

    });

    $('#tbl_user_groups').on('click', '.edit_group', function () {
        var id = this.value;
        $.LoadingOverlay('show');
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/user/group/get_group",
            datatype: 'JSON',
            data:{id:id}
        }).done(function(data) {
            $.LoadingOverlay('hide');

            swal({
                    title: "Edit group name!",
                    text: "Enter a new group name:",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputValue: data.name
                },
                function(inputValue){
                    if (inputValue === false) return false;

                    if (inputValue === "") {
                        swal.showInputError("You need to write something!");
                        return false
                    }

                    $.ajax({
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "/user/group/update",
                        datatype: 'JSON',
                        data:{id: data.id, name:inputValue}
                    }).done(function( result ) {
                        if(result.status){
                            $('#user_group_table_body').html(result.data);
                            swal('Updated!', '', 'success');
                        }else{
                            swal('Could not update!',result.msg,'error');
                        }
                    });

                });

        });

    });


});