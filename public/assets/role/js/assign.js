 jQuery(function($){

    var user_list = $('select[name="user_list[]"]').bootstrapDualListbox({
        infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>',
        moveOnSelect: false,
        nonSelectedListLabel: '<h4>All Available Users</h4>',
        selectedListLabel: '<h4>Currently Assigned as ' + $('#role_name').val() + '</h4>',
    });
    var container1 = user_list.bootstrapDualListbox('getContainer');
    container1.find('.btn').addClass('btn-default');

    var user_info = $('#user_info');
    user_info.parent().parent().parent().hide();

    $('.bootstrap-duallistbox-container option').click(function () {
        var user_id = this.value;

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/user/get-one-ajax",
            datatype: 'JSON',
            data:{user_id : user_id}
        }).done(function( msg ) {
            var html = '<tr>' +
                '<th>User</th>' + '<td>'+ msg.name +'<a class="btn btn-default btn-circle pull-right" target="_blank" href="/user/view/'+ msg.id +'"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>' +
                '</tr>' +
                '<tr>' +
                '<th>Current Role</th>' + '<td>'+ msg.roles +'</td>' +
                '</tr>';

            $('#user_info').html(html);
            user_info.parent().parent().parent().show();
        });
    });

});



