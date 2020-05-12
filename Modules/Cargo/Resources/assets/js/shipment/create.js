/**
 * Created by Bashet on 24/02/2018.
 */

$(function () {
    $('.select2').select2();

    $('#new_sender').click(function () {
        $('#sender_id').val('');
    });

    $('#print_summary').click(function () {
        window.open('/cargo/print-draft/' + draft_id, '_blank');
    });

    var agent_element = $('#agent_id');
    var delivery_agent = $('#delivery_agent_id');

    $('#delivery_to_receiver').checkboxpicker();
    $('#final_confirm').checkboxpicker({
        html: true,
        offLabel: '<span class="glyphicon glyphicon-remove">',
        onLabel: '<span class="glyphicon glyphicon-ok">'
    });
    $('#final_confirm').prop('checked', false);


    valid_this_form('#frm_create_sender');
    valid_this_form('#frm_create_receiver');
    valid_this_form('#frm_pkg_des');

    $("#declare_value").focus(function () {
        $(this).select();
    });

    $('#bootstrap-wizard-1').bootstrapWizard({
        'tabClass': 'form-wizard',
        'onNext': function (tab, navigation, index) {

            if(index == 1){
                if ( $("#frm_create_sender").valid() ) {
                    $('#frm_create_sender').submit();
                }else {
                    return false;
                }
            }else if(index == 2){
                if ( $("#frm_create_receiver").valid() ) {
                    $('#frm_create_receiver').submit();
                }else {
                    return false;
                }
            }else if(index == 3){

                if( ! $('#frm_pkg_des').valid()){
                    swal('Please update all the highlighted fields', '', 'warning');
                    return false;
                }

                if ( $("#package_added").val() > 0 ) {
                    //draft_id = $('#draft_id').val();
                    $.LoadingOverlay('show');
                    $.ajax({
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "/cargo/get-services",
                        datatype: 'JSON',
                        data:{draft_id:draft_id}
                    }).done(function(result) {
                        $('#tbl_services tbody').html(result.services);
                        $.LoadingOverlay('hide');
                        goNext(3);
                    });
                }else {
                    swal('Add at least one package to go ahead!', '', 'warning');
                    return false;
                }
            }else if(index == 4){
                let service_selected = $('#service_selected').val();
                if ( service_selected ) {
                    //draft_id = $('#draft_id').val();
                    $.LoadingOverlay('show');
                    $.ajax({
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "/cargo/select-service",
                        datatype: 'JSON',
                        data:{ draft_id : draft_id, service_selected : service_selected}
                    }).done(function(result) {
                        var html = '<strong>'+ result.provider + ' - ' + result.name +'</strong> (' + result.info + ') = ' + result.total;
                        $('#selected_service_info').html(html);
                        $.LoadingOverlay('hide');
                        goNext(4);

                        // get agent location

                        axios.post('/cargo/get_agents_for_receiver',{
                            draft_id
                        })
                            .then((response) => {
                                let result = response.data;
                                agent_element.empty();
                                delivery_agent.empty();
                                agent_element.append('<option value=""></option>');
                                delivery_agent.append('<option value=""></option>');

                                result.forEach(function (agent) {
                                    var option = '<option data-collection_cost="' + agent.collection_cost + '" data-delivery_cost="' + agent.delivery_cost + '" value="'+ agent.id +'">'+ agent.name +', ' + agent.address_line_1 +', '+ agent.city +'</option>';
                                    agent_element.append(option);
                                    delivery_agent.append(option);
                                });
                            });

                    });

                    // get list of valuable items for select element
                    axios.post('/cargo/get-valuable-items-src-dts',{
                        draft_id
                    })
                        .then((response) => {
                            let options = response.data.options;
                            $('#valuable_item_id').empty();
                            $('#valuable_item_id').append(options);
                        });

                }else {
                    swal('Select at least one service to go ahead!', '', 'warning');
                    return false;
                }


            }else if(index == 5){

                let agent_location = '';

                if($('#chk_delivery').is(':checked')){
                    agent_location = $('.delivery_location').val();
                }else {
                    agent_location = $('.collection_location').val();
                }

                if(agent_location === ''){
                    swal('Please select delivery or collection, therefore nearest agent location!', '', 'error');
                    return false;
                }

                //draft_id = $('#draft_id').val();
                $.LoadingOverlay('show');
                $.ajax({
                    type: "GET",
                    url: "/cargo/get-summary/" + draft_id,
                }).done(function(result) {
                    $('#summary').html(result);
                    $.LoadingOverlay('hide');
                    goNext(5);
                });
            }
        },
        'onPrevious': function (tab, navigation, index) {
            if(index > 0){
                $('.previous').show();
            }else {
                $('.previous').hide();
            }

            if(index < 5){
                $('.next').show();
            }
        },
        onFinish: function() {
            if($("#final_confirm").is(':checked')){
                // check payment method and confirm the shipment

                if( ! $('#frm_payment').valid() ){
                    return false;
                }

                var amount = $('#amount').val();


                swal({
                    title: 'Are You Sure?',
                    type: 'warning',
                    html: 'You are about to submit the parcel!',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'Yes, Proceed!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then(function (result) {
                    if(result.value){
                        $('#frm_payment').submit();
                    }
                });

                //window.location.href = '/post/create-from-draft/' + draft_id;
            }else {
                swal('Please confirm!', '', 'error');
                return false;
            }
        },
        onTabClick: function(tab, navigation, index) {
            return false;
        }
    });

    function goNext(index) {
        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
            'complete');
        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
            .html('<i class="fa fa-check"></i>');
    }

    function showPrevious(index) {
        if(index > 0){
            $('.previous').show();
        }
    }

    $('#frm_payment').submit(function (e) {
        e.preventDefault();

        $.LoadingOverlay('show');

        let payment_method = $('#payment_method').val();

        if(payment_method === 'online'){
            var stripe_token = '';
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    $.LoadingOverlay('hide');
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    // stripeTokenHandler(result.token);
                    // stripe_token = result.token;
                    final_submission(result.token.id);
                }
            });
        }else{
            final_submission();
        }


    });

    function final_submission(stripe_token = ''){
        $('#frm_payment').ajaxSubmit({
            data: { draft_id, stripe_token },
            success: function (result) {
                // payment has been taken

                $.LoadingOverlay('hide');

                console.log(result);

                if(result.success){
                    swal({
                        title: 'Shipment has been created!',
                        type: 'success',
                        html: result.tracking_number,
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Close!',
                        cancelButtonText: '',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then(function (response) {
                        if(response.value){
                            window.location.replace('/post/view/' + result.tracking_number);
                        }
                    });
                }else{
                    swal(result.msg, '', 'error');
                }

            }
        });
    }

    var sender_row_id = '';
    var sender_table = $('#tbl_sender_list').dataTable({
        responsive:true
    });

    $('#tbl_sender_list tbody').on( 'click', 'tr', function () {
        //var row = table.fnGetPosition($(this).closest('tr')[0]);
        sender_row_id = this.id;
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            sender_table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#tbl_sender_list tbody').on( 'dblclick', 'tr', function () {
        //var row = table.fnGetPosition($(this).closest('tr')[0]);
        sender_row_id = this.id;
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            sender_table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        $('#select_sender').trigger('click');
    } );

    $('#lookup_sender').click(function (e) {
        e.preventDefault();
        $('#mdl_sender').modal('show');
    });

    $('#select_sender').click(function (e) {
        e.preventDefault();
        if(sender_row_id){
            $('#mdl_sender').modal('hide');
            $.LoadingOverlay('show');
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/cargo/select-sender",
                datatype: 'JSON',
                data:{sender_id:sender_row_id}
            }).done(function(result) {
                $('#sender_id').val(result.id);
                $('#sender_account').val(result.name);
                $('#sender_country').val(result.country).trigger('change');
                $('#sender_address_line_1').val(result.address_line_1);
                $('#sender_address_line_2').val(result.address_line_2);
                $('#sender_address_line_3').val(result.address_line_3);
                $('#sender_city').val(result.city);
                $('#sender_county').val(result.county);
                $('#sender_postcode').val(result.postcode);
                $('#sender_contact_person').val(result.contact_person);
                $('#sender_phone_number').val(result.phone_number);
                $('#sender_email').val(result.email);

                $('#frm_create_sender').valid();

                $.LoadingOverlay('hide');
            });
        }else {
            swal('sender not selected');
        }
    });

    $('#sender_postcode_lookup').getAddress({
        api_key: '3Ihph0lYAU6P1llsphU68Q5211',
        output_fields:{
            line_1: '#sender_address_line_1',
            line_2: '#sender_address_line_2',
            line_3: '#sender_address_line_3',
            post_town: '#sender_city',
            county: '#sender_county',
            postcode: '#sender_postcode'
        }
    });

    $('#frm_create_sender').submit(function (e) {
        e.preventDefault();
        $('#frm_create_sender').ajaxSubmit({
            data: {draft_id : draft_id},
            success: function (result) {
                $("#sender_id").val(result.sender.id); // set the sender
                //$("#draft_id").val(result.draft_id); // set the sender
                draft_id = result.draft_id;

                // fill the receiver table, if any data available
                $('#tbl_receiver_list tbody').html(result.receiver_table);
                goNext(1);
                showPrevious(1);
            },
            error: function (result) {
                $('#bootstrap-wizard-1').bootstrapWizard('previous');
                swal('Something went wrong!', 'Please re-start the process', 'error');
            }
        });
    });

    var receiver_row_id = '';
    var receiver_table = $('#tbl_receiver_list');
    // var receiver_table = $('#tbl_receiver_list').dataTable({
    //     responsive:true
    // });

    $('#tbl_receiver_list tbody').on( 'click', 'tr', function () {
        //var row = table.fnGetPosition($(this).closest('tr')[0]);
        receiver_row_id = this.id;
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            $('#tbl_receiver_list tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#tbl_receiver_list tbody').on( 'dblclick', 'tr', function () {
        //var row = table.fnGetPosition($(this).closest('tr')[0]);
        receiver_row_id = this.id;
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            receiver_table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        $('#select_receiver').trigger('click');

    } );

    $('#lookup_receiver').click(function (e) {
        e.preventDefault();
        $('#mdl_receiver').modal('show');
    });

    $('#select_receiver').click(function (e) {
        e.preventDefault();
        if(receiver_row_id){
            $('#mdl_receiver').modal('hide');
            $.LoadingOverlay('show');
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/cargo/select-receiver",
                datatype: 'JSON',
                data:{receiver_id:receiver_row_id}
            }).done(function(result) {
                $('#receiver_id').val(result.id);
                $('#receiver_account').val(result.name);
                $('#receiver_country').val(result.country).trigger('change');
                $('#receiver_address_line_1').val(result.address_line_1);
                $('#receiver_address_line_2').val(result.address_line_2);
                $('#receiver_address_line_3').val(result.address_line_3);
                $('#receiver_city').val(result.city);
                $('#receiver_county').val(result.county);
                $('#receiver_postcode').val(result.postcode);
                $('#receiver_contact_person').val(result.contact_person);
                $('#receiver_phone_number').val(result.phone_number);
                $('#receiver_email').val(result.email);

                $('#frm_create_receiver').valid();

                $.LoadingOverlay('hide');
            });
        }else {
            swal('sender not selected');
        }
    });

    $("#receiver_country").on('change', function (e) {
        var country = this.value;
        //console.log(data);
        if(country === 'GBR'){
            $('#receiver_address_div').show();
        }else{
            $('#receiver_address_div').hide();
        }
    });

    $('#receiver_postcode_lookup').getAddress({
        api_key: '3Ihph0lYAU6P1llsphU68Q5211',
        output_fields:{
            line_1: '#receiver_address_line_1',
            line_2: '#receiver_address_line_2',
            line_3: '#receiver_address_line_3',
            post_town: '#receiver_city',
            county: '#receiver_county',
            postcode: '#receiver_postcode'
        }
    });

    $('#frm_create_receiver').submit(function (e) {
        e.preventDefault();
        var sender_id = $('#sender_id').val();
        $('#frm_create_receiver').ajaxSubmit({
            data: { sender_id: sender_id, draft_id : draft_id },
            success: function (result) {
                $("#receiver_id").val(result.id);

                $('#delivery_account').val(result.name);
                $('#delivery_country').val(result.country);
                $('#delivery_address_line_1').val(result.address_line_1);
                $('#delivery_address_line_2').val(result.address_line_2);
                $('#delivery_address_line_3').val(result.address_line_3);
                $('#delivery_city').val(result.city);
                $('#delivery_county').val(result.county);
                $('#delivery_postcode').val(result.postcode);
                $('#delivery_contact_person').val(result.contact_person);
                $('#delivery_phone_number').val(result.phone_number);
                $('#delivery_email').val(result.email);

                goNext(2);
            },
            error: function (result) {
                $('#bootstrap-wizard-1').bootstrapWizard('previous');
                swal('Something went wrong!', 'Please re-start the process', 'error');
            }
        });
    });


    $('#div_document').click(function (e) {
        e.preventDefault();
        $('#document_checked').show();
        $('#parcel_checked').hide();

        $('#div_document').addClass('well-info');
        $('#div_parcel').removeClass('well-info');

        $('#document_fields').show();
        $('#parcel_fields').hide();

        $('#declare_value').parent().parent().hide();
    });

    $('#div_parcel').click(function (e) {
        e.preventDefault();
        $('#document_checked').hide();
        $('#parcel_checked').show();

        $('#div_parcel').addClass('well-info');
        $('#div_document').removeClass('well-info');

        $('#parcel_fields').show();
        $('#document_fields').hide();
        $('#declare_value').parent().parent().show();
    });

    $('#description').change(function () {
        var description = $('#description').val();
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/cargo/update-description",
            datatype: 'JSON',
            data:{ draft_id : draft_id, description : description}
        }).done(function(result) {

        });
    });

    $('#declare_value').change(function () {
        var declare_value = $('#declare_value').val();
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/cargo/update-declare-value",
            datatype: 'JSON',
            data:{ draft_id : draft_id, declare_value : declare_value}
        }).done(function(result) {
            $('#declare_value').val(result);
        });
    });

    var doc_quantity = $('#doc_quantity');
    var doc_weight = $('#doc_weight');
    var doc_total_weight = $('#doc_total_weight');

    doc_quantity.change(function () {
        calculate_doc_total_weight();
    });

    doc_weight.change(function () {
        calculate_doc_total_weight();
    });

    function calculate_doc_total_weight() {
        var d_t_w = doc_weight.val();
        doc_total_weight.html(d_t_w);

        if(d_t_w){
            if( $('#add-package-document').hasClass('disabled') ){
                $('#add-package-document').removeClass('disabled')
            }
        }else {
            if( ! $('#add-package-document').hasClass('disabled') ){
                $('#add-package-document').addClass('disabled')
            }
        }
    }

    valid_this_form('#frm_add_doc');

    $('#add-package-document').click(function (e) {
        e.preventDefault();
        if( $('#frm_add_doc').valid() ){
            $('#frm_add_doc').submit();
        }
        // $('#frm_add_doc').submit();
    });

    $('#frm_add_doc').submit(function (e) {
        e.preventDefault();
        $(this).ajaxSubmit({
            data: { draft_id : draft_id },
            success: function (result) {
                $('#tbl_package_details tbody').html(result.table);
                $('#frm_add_doc').resetForm();
                $('#package_added').val(result.rows);
            }
        });

    });

    var parcel_quantity = $('#parcel_quantity');
    var parcel_weight = $('#parcel_weight');
    var parcel_length = $('#parcel_length');
    var parcel_width = $('#parcel_width');
    var parcel_height = $('#parcel_height');
    var parcel_volume_weight = $('#parcel_volume_weight');
    var parcel_total_weight = $('#parcel_total_weight');

    parcel_quantity.change(function () {
        calculate_parcel_total_weight();
    });

    parcel_weight.change(function () {
        calculate_parcel_total_weight();
    });

    function calculate_parcel_total_weight() {
        var p_t_w = parcel_weight.val();
        parcel_total_weight.html(p_t_w);

        if(p_t_w){
            if( $('#add-package-parcel').hasClass('disabled') ){
                $('#add-package-parcel').removeClass('disabled');
            }
        }else {
            if( ! $('#add-package-parcel').hasClass('disabled') ){
                $('#add-package-parcel').addClass('disabled');
            }
        }
    }

    parcel_length.change(function () {
        calculate_parcel_volume_weight();
    });
    parcel_width.change(function () {
        calculate_parcel_volume_weight();
    });
    parcel_height.change(function () {
        calculate_parcel_volume_weight();
    });

    function calculate_parcel_volume_weight() {
       var p_v_w = (parseFloat(parcel_length.val()) * parseFloat(parcel_width.val()) * parseFloat(parcel_height.val())) / mass_divider;
       parcel_volume_weight.html(p_v_w);
    }

    valid_this_form('#frm_add_parcel');

    $('#add-package-parcel').click(function (e) {
        e.preventDefault();
        if( $('#frm_add_parcel').valid() ){
            $('#frm_add_parcel').submit();
        }
    });

    $('#frm_add_parcel').submit(function (e) {
        e.preventDefault();
        $(this).ajaxSubmit({
            data: { draft_id : draft_id },
            success: function (result) {
                $('#tbl_package_details tbody').html(result.table);
                $('#frm_add_parcel').resetForm();
                $('#package_added').val(result.rows);

                if(result.code === 'DOC'){
                    $('#div_parcel').hide();
                    $('#div_document').show();
                }else{
                    $('#div_parcel').show();
                    $('#div_document').hide();
                }
            }
        });

    });

    $('#tbl_package_details').on('click', '.remove-package', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: link,
            success: function (result) {
                $('#tbl_package_details tbody').html(result.table);
                $('#package_added').val(result.rows);

                if(result.rows === 0){
                    $('#div_parcel').show();
                    $('#div_document').show();
                }
            }
        });

    });

    $('#tbl_services').on('click', '.services', function () {
        $('#service_selected').val($(this).val());
        var data = $(this).data();
        $('#service_provider').val(data.provider);
        console.log(data.provider);
    });

    $('#pickup_charge').change(function (e) {
        axios.post('/cargo/add-pickup-charge',{
            draft_id: draft_id, cost: $(this).val()
        })
            .then((result) => {
                console.log(result.data)
            });
    });


    $('#chk_delivery').checkboxpicker({
        html: true,
        offLabel: 'Collection',
        onLabel: 'Delivery'
    }).on('change', function() {
        var delivery = 0;

        if($("#chk_delivery").is(':checked')){
            delivery = 1;
        }

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/cargo/add-delivery",
            datatype: 'JSON',
            data:{ draft_id : draft_id, delivery: delivery}
        }).done(function(result) {
            //console.log(result);
            if(result.delivery == 1){
                if(result.receiver === 'true'){
                    $('#delivery_to_receiver').prop('checked', true);
                }else {
                    $('#delivery_to_receiver').prop('checked', false);
                }

                // if(result.price){
                //     $('#insurance_price').val(result.price);
                // }

                $('#div_delivery_details').show('slow');
                $('#div_collection_details').hide('slow');
            }else{
                $('#div_delivery_details').hide('slow');
                $('#div_collection_details').show('slow');
            }
        });
    });

    agent_element.change(function () {
        var selected = $(this).find('option:selected');
        var cost = selected.data('collection_cost');

        $('#collection_price').val(cost);
        $('#collection_price').prop("placeholder", "Minimum cost: " + cost);

    });

    delivery_agent.change(function () {
        var selected = $(this).find('option:selected');
        var cost = selected.data('delivery_cost');

        $('#delivery_price').val(cost);
        $('#delivery_price').prop("placeholder", "Minimum cost: " + cost);

    });

    valid_this_form('#frm_add_collection');

    $('#btn_update_collection_address').click(function (e) {
        e.preventDefault();

        var selected = agent_element.find('option:selected');
        var minimum_cost = selected.data('collection_cost');

        if($('#collection_price').val() < minimum_cost){
            swal('Collection price must be grater then or equal to £' + minimum_cost, '', 'error');
        }else{
            if( $('#frm_add_collection').valid() ){
                $('#frm_add_collection').submit();
            }
        }

    });

    $('#frm_add_collection').submit(function (e) {
        e.preventDefault();
        $('#frm_add_collection').ajaxSubmit({
            data: {draft_id : draft_id},
            success: function (result) {
                var status_ele = $('#collection_address_status');
                if(result.success){
                    status_ele.html('Collection information updated!');
                    if(status_ele.hasClass('alert-danger')){
                        status_ele.removeClass('alert-danger')
                    }
                    status_ele.addClass('alert-success')
                }else {
                    status_ele.html('Collection information could not be updated!');
                    if(status_ele.hasClass('alert-success')){
                        status_ele.removeClass('alert-success')
                    }
                    status_ele.addClass('alert-danger')
                }
            }
        });
    });

    $('#btn_refresh_insurance').click(function () {
        load_insurance_table();
    });

    $('#chk_insurance').click(function () {
        load_insurance_table();
    });

    function load_insurance_table() {
        var insurance = 0;

        if($("#chk_insurance").is(':checked')){
            insurance = 1;
        }

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/cargo/add-insurance",
            datatype: 'JSON',
            data:{ draft_id : draft_id, insurance: insurance}
        }).done(function(result) {
            // console.log(result);
            if(result.insurance){
                $('#insurance_table').html(result.insurance_table);
                // if(result.price){
                //     $('#insurance_price').val(result.price);
                // }
                //
                $('#div_insurance_details').show('slow');
            }else{
                $('#div_insurance_details').hide('slow');
            }

        });
    }

    $('#insurance_table').on('click', '.check_insurance', function () {
        let data = $(this).data();
        let item_id = data.id;
        let keep = false;
        if($(this).is(':checked')){
            keep = true;
        }

        axios.post('/cargo/update-insurance',{
            draft_id, item_id, keep
        }).then((response) => {
            console.log(response.data)
        });
    });


    $('#chk_additional_packaging').click(function () {
        var additional_packaging = 0;

        if($("#chk_additional_packaging").is(':checked')){
            additional_packaging = 1;
        }

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/cargo/add-additional-packaging",
            datatype: 'JSON',
            data:{ draft_id : draft_id, additional_packaging: additional_packaging}
        }).done(function(result) {
            // console.log(result);
            if(result.packaging == 1){
                if(result.packaging_price){
                    $('#additional_packaging_price').val(result.packaging_price);
                }

                $('#div_additional_packaging').show('slow');
            }else{
                $('#div_additional_packaging').hide('slow');
            }

        });
    });


    $("#delivery_country").on('change', function (e) {
        var country = this.value;
        //console.log(data);
        if(country === 'GBR'){
            $('#delivery_address_div').show();
        }else{
            $('#delivery_address_div').hide();
        }
    });

    $('#delivery_postcode_lookup').getAddress({
        api_key: '3Ihph0lYAU6P1llsphU68Q5211',
        output_fields:{
            line_1: '#delivery_address_line_1',
            line_2: '#delivery_address_line_2',
            line_3: '#delivery_address_line_3',
            post_town: '#delivery_city',
            county: '#delivery_county',
            postcode: '#delivery_postcode'
        }
    });

    $('#delivery_to_receiver').on('change', function () {
        if( $('#delivery_to_receiver').is(':checked')){
            $('#delivery_address').hide('slow');
        }else{
            $('#delivery_address').show('slow');
        }
    });


    valid_this_form('#frm_add_declarable');

    $('#btn_add_declarable').click(function (e) {
        e.preventDefault();
        if( $('#frm_add_declarable').valid() ){
            $('#frm_add_declarable').submit();
        }
    });

    $('#frm_add_declarable').submit(function (e) {
        e.preventDefault();
        $('#frm_add_declarable').ajaxSubmit({
            data: {draft_id : draft_id},
            success: function (result) {
                if(result.error){
                    swal(result.error, '', 'error');
                }else {
                    $('#div_declarable tbody').html(result.table);
                    $('#total_declare_value').val(result.total_value);
                    $('#frm_add_declarable').resetForm();
                }
            }
        });
    });

    $('#div_declarable').on('click', '.remove-declarable', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: link,
            success: function (result) {
                $('#div_declarable tbody').html(result.table);
                $('#total_declare_value').val(result.total_value);
            }
        });

    });

    valid_this_form('#frm_add_delivery');

    $('#btn_update_delivery_address').click(function (e) {
        e.preventDefault();

        var selected = delivery_agent.find('option:selected');
        var minimum_cost = selected.data('delivery_cost');

        if($('#delivery_price').val() < minimum_cost){
            swal('Delivery price must be grater then or equal to £' + minimum_cost, '', 'error');
        }else{
            if( $('#frm_add_delivery').valid() ){
                $('#frm_add_delivery').submit();
            }
        }

    });

    $('#frm_add_delivery').submit(function (e) {
        e.preventDefault();

        $('#frm_add_delivery').ajaxSubmit({
            data: {draft_id : draft_id},
            success: function (result) {
                var status_ele = $('#delivery_address_status');
                if(result.success){
                    status_ele.html('Delivery information updated!');
                    if(status_ele.hasClass('alert-danger')){
                        status_ele.removeClass('alert-danger')
                    }
                    status_ele.addClass('alert-success')
                }else {
                    status_ele.html('Delivery information could not be updated!');
                    if(status_ele.hasClass('alert-success')){
                        status_ele.removeClass('alert-success')
                    }
                    status_ele.addClass('alert-danger')
                }
            }
        });
    });

    $('#valuable_item_id').select2();

    $('#valuable_item_id').change(function () {
        let selected = $(this).find('option:selected');
        let item_data = selected.data();

        let max_purchase_price = item_data.max;
        let min_cost = item_data.min;
        let max_cost = item_data.max_cost;

        $('#valuable_item_value').prop('max', max_purchase_price);
        $('#valuable_item_cost').prop('min', min_cost);
        $('#valuable_item_cost').prop('max', max_cost);
        $('#valuable_item_cost').val(max_cost);

        $('#frm_add_declarable').valid();

    });

    valid_this_form('#frm_additional_packaging');

    $('#btn_update_additional_packaging').click(function (e) {
        e.preventDefault();

        if( $('#frm_additional_packaging').valid() ){
            $('#frm_additional_packaging').submit();
        }

    });

    $('#frm_additional_packaging').submit(function (e) {
        e.preventDefault();

        $('#frm_additional_packaging').ajaxSubmit({
            data: {draft_id : draft_id},
            success: function (result) {
                var status_ele = $('#additional_packaging_status');
                if(result.success){
                    status_ele.html('Additional packaging information updated!');
                    if(status_ele.hasClass('alert-danger')){
                        status_ele.removeClass('alert-danger')
                    }
                    status_ele.addClass('alert-success')
                }else {
                    status_ele.html('Additional packaging information could not be updated!');
                    if(status_ele.hasClass('alert-success')){
                        status_ele.removeClass('alert-success')
                    }
                    status_ele.addClass('alert-danger')
                }
            }
        });
    });

    $('#summary').on('change', '.discount', function () {

        let max = $(this).data().max;
        let discount = $(this).val();

        if(parseFloat(discount) > parseFloat(max)){
            $(this).val(0);
            swal('Maximum discount allowed is: ' + max, '', 'error');
            $(this).trigger('change');
            return false
        }

        axios.post('/cargo/update-discount',{
            draft_id, discount
        })
            .then((result) => {
                let data = result.data;
                let total = $('.total').text();
                let final_total = parseFloat(total.replace(",", "")) - parseFloat(data.discount);
                let vat = parseFloat(final_total) * parseFloat(vat_percentage) / 100 ;
                $('.vat').html(vat.toFixed(2));
                let grand_total = parseFloat(final_total) + parseFloat(vat);
                $('.grand_total').html(grand_total.toFixed(2));

            });
    });

    $('#payment_method').change(function(){
        let p_method = $(this).val();

        if(p_method === 'online'){
            $('#div-ard-details').show();
            $('#div-payment-ref').hide();
        }else{
            $('#div-ard-details').hide();
            $('#div-payment-ref').show();
        }
    });




});