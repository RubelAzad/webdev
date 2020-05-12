jQuery(function($){

    $('input[update_role_ability]').click(function () {
        var input_id = this.id;
        var id_array = input_id.split('-');
        var role = id_array[0];
        var ability = id_array[1];
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/role/update-ability",
            datatype: 'JSON',
            data:{role:role, ability:ability}
        }).done(function( msg ) {

            if(msg.allowed){
                toastr.success(msg.role + ' is now allowed to ' + msg.ability , 'Message from system')
            }else{
                toastr.success(msg.role + ' is now not allowed to ' + msg.ability , 'Message from system')
            }
        });
    });

});



