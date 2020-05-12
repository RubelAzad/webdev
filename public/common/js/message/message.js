$(function () {

    var filesToUpload = null;

    function handleFileSelect(event)
    {
        var files = event.target.files || event.originalEvent.dataTransfer.files;
        // Itterate thru files (here I user Underscore.js function to do so).
        // Simply user 'for loop'.
        _.each(files, function(file) {
            filesToUpload.push(file);
        });
    }

    /**
     * Form submit
     */
    function handleFormSubmit(event)
    {
        event.preventDefault();

        var form = $('#frm_compose');
        var formData = new FormData();
        formData.append('file', $('input[type=file]')[0].files[0]);


        // Prevent multiple submisions
        if ($(form).data('loading') === true) {
            return;
        }
        $(form).data('loading', true);

        // Add selected files to FormData which will be sent
        if (filesToUpload) {
            _.each(filesToUpload, function(file){
                formData.append('cover[]', file);
            });
        }

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/message/attach',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response)
            {
                var attachments = $('#attachments').val();
                $('#attachments').val(attachments + (attachments ? ',' : '')+response.id);
                $('#list_attachments').append('<li class="list-group-item list-group-item-success">'+response.name+' <button id="file-'+response.id+'" class="btn btn-link pull-right"><i class="fa fa-times red"></i></button></li>');
            },
            complete: function()
            {
                // Allow form to be submited again
                $(form).data('loading', false);
            },
            dataType: 'json'
        });
    }

    /**
     * Register events
     */
    $('input:file').on('change', handleFileSelect, function (event) {
        $.LoadingOverlay("show");
        handleFormSubmit(event);
        $.LoadingOverlay("hide");
    });
    //$('form').on('submit', handleFormSubmit);

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
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    $('#list_attachments').on('click', 'button', function (e) {
        e.preventDefault();
        var input_id = this.id;
        var id_array = input_id.split('-');
        var id = id_array[1];
        var attachments = $('#attachments').val();

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/message/remove-attachment",
            datatype: 'JSON',
            data:{id:id, attachments:attachments}
        }).done(function( msg ) {
            attachments = attachments.split(',');
            attachments = jQuery.grep(attachments, function(value) {
                return value != id;
            });

            attachments = attachments.toString();
            $('#attachments').val(attachments);
            $('#list_attachments').html(msg);
        });
    });

    $('#btn_send_message').click(function () {
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
