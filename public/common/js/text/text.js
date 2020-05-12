$(function () {
    $("#send_to").select2({
        //tags: true,
        multiple: true,
        tokenSeparators: [',', ' '],
        minimumInputLength: 2,
        minimumResultsForSearch: 10,
        ajax: {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/person/get-all-ajax',
            dataType: "json",
            type: "POST",
            data: function (params) {

                var queryParameters = {
                    term: params.term
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.first_name + ' ' + item.last_name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    $('#btn_send_sms').click(function () {
        $.LoadingOverlay("show");
    });

    var recipients_tree = $('#recipients_tree').jstree(
        {
            'core': {
                'themes': {
                    'name': 'proton',
                    'responsive': true
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-users"
                },
                "children" : {
                    "icon" : "fa fa-user"
                }
            },
            "checkbox" : {
                "keep_selected_style" : false,
                "tie_selection" : false
            },
            "plugins" : [ "types", "checkbox" ]
        }
    );

    // for check
    recipients_tree.on("check_node.jstree", function(event, data){
        var send_mail_to = $('#send_to');

        var exValues = send_mail_to.val();


        var id_data     = data.node.id;
        var id_array    = id_data.split('-');
        var id          = id_array[1];
        var value       = data.node.text;
        if(id){

            send_mail_to
                .append($("<option selected></option>")
                    .attr("value",id)
                    .text(value));
            send_mail_to.trigger('change');
        }else{
            var children = data.node.children;
            children.forEach(function(child){
                var child_id_array  = child.split('-');
                var user_id         = child_id_array[1]; // option_to_add
                var node = data.instance.get_node(child);

                if(user_id){
                    var exist = false;
                    if(exValues){
                        for(var i = 0; i < exValues.length; i++){
                            if(exValues[i] == user_id){
                                exist = true;
                            }
                        }
                    }

                    if( exist == false){
                        send_mail_to
                            .append($("<option selected></option>")
                                .attr("value",user_id)
                                .text(node.text));
                        send_mail_to.trigger('change');
                    }

                }


                var grand_child = node.children;
                grand_child.forEach(function(grand_child){
                    var grand__id_array  = grand_child.split('-');
                    var user_id         = grand__id_array[1]; // option_to_add
                    var child_node = data.instance.get_node(grand_child);

                    if(user_id){
                        var exist = false;
                        if(exValues){
                            for(var i = 0; i < exValues.length; i++){
                                if(exValues[i] == user_id){
                                    exist = true;
                                }
                            }
                        }

                        if( exist == false){
                            send_mail_to
                                .append($("<option selected></option>")
                                    .attr("value",user_id)
                                    .text(child_node.text));
                            send_mail_to.trigger('change');
                        }
                    }

                });

            });

        }

    });


    // for un-check
    recipients_tree.on("uncheck_node.jstree", function(event, data){
        var send_mail_to = $('#send_to');

        var id_data     = data.node.id;
        var id_array    = id_data.split('-');
        var id          = id_array[1];
        var value       = data.node.text;

        if(id){
            $("#send_to option[value='"+id+"']").remove();
            send_mail_to.trigger('change');
        }else{
            var children = data.node.children;
            children.forEach(function(child){
                var child_id_array      = child.split('-');
                var o_t_r               = child_id_array[1]; // option_to_remove
                $("#send_to option[value='"+o_t_r+"']").remove();
                send_mail_to.trigger('change');

                var node = data.instance.get_node(child);
                var grand_child = node.children;
                grand_child.forEach(function(grand_child){
                    var grand__id_array  = grand_child.split('-');
                    var user_id         = grand__id_array[1]; // option_to_remove
                    if(user_id){
                        $("#send_to option[value='"+user_id+"']").remove();
                        send_mail_to.trigger('change');
                    }
                });
            });
        }

    });


});
