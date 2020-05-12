/**
 * Created by Bashet on 10/02/2018.
 */

$(function () {

    // $("#country").select2({
    //     placeholder: "Select a country",
    //     multiple: false,
    //     minimumInputLength: 1,
    //     minimumResultsForSearch: 10,
    //     ajax: {
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //         url: '/country/get',
    //         dataType: "json",
    //         type: "POST",
    //         data: function (params) {
    //             return { term: params.term };
    //         },
    //         processResults: function (data) {
    //             return {
    //                 results: $.map(data, function (item) {
    //                     return {
    //                         text: item.name,
    //                         id: item.iso_3166_2
    //                     }
    //                 })
    //             };
    //         }
    //     }
    // });

    $('.select2').select2();



    $("#country").on('change', function (e) {
        var country = this.value;
        //console.log(data);
        if(country === 'GBR'){
            $('#address_div').show();
        }else{
            $('#address_div').hide();
        }
    });

    $('#postcode_lookup').getAddress({
        api_key: '3Ihph0lYAU6P1llsphU68Q5211',
        output_fields:{
            line_1: '#address_line_1',
            line_2: '#address_line_2',
            line_3: '#address_line_3',
            post_town: '#city',
            county: '#county',
            postcode: '#postcode'
        }
    });


    $('#director_postcode_lookup').getAddress({
        api_key: '3Ihph0lYAU6P1llsphU68Q5211',
        output_fields:{
            line_1: '#director_address_line_1',
            line_2: '#director_address_line_2',
            line_3: '#director_address_line_3',
            post_town: '#director_city',
            county: '#director_county',
            postcode: '#director_postcode'
        }
    });

    $('.chosen-select').chosen({
        allow_single_deselect:true
    });

    valid_this_form('#frm_business_info');
    valid_this_form('#frm_director_info');
    valid_this_form('#frm_contact_info');
    valid_this_form('#frm_business_rules');

    $('#bootstrap-wizard-1').bootstrapWizard({
        'tabClass': 'form-wizard',
        'onNext': function (tab, navigation, index) {

            if(index == 1){
                if ( $("#frm_business_info").valid() ) {
                    goNext(index);
                    showPrevious(index)
                    $('#frm_business_info').submit();
                }else {
                    return false;
                }
            }else if(index == 2){
                if ( $("#frm_director_info").valid() ) {
                    goNext(index);
                    showPrevious(index)
                    $('#frm_director_info').submit();
                }else {
                    return false;
                }
            }else if(index == 3){
                if ( $("#frm_contact_info").valid() ) {
                    goNext(index);
                    showPrevious(index)
                    $('#frm_contact_info').submit();
                }else {
                    return false;
                }
            }else if(index == 4){
                if ( $("#frm_business_rules").valid() ) {
                    goNext(index);
                    showPrevious(index)
                    $('#frm_business_rules').submit();
                }else {
                    return false;
                }
            }else if(index == 5){
                goNext(index);
                showPrevious(index)
                $('.next').hide();
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
            $('#frm_confirm').submit();
        },
        onTabClick: function(tab, navigation, index) {
            if(franchise_id){
                return true;
            }else {
                return false;
            }
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

    $('#frm_business_info').submit(function (e) {
        e.preventDefault();
        var franchise_id = $('#franchise_id').val();
        $.LoadingOverlay('show');

        $('#frm_business_info').ajaxSubmit({
            data: { franchise_id: franchise_id },
            success: function (result) {
                $('#director_country').val(result.country);
                $.LoadingOverlay('hide');
                $('#franchise_id').val(result.id);
            }
        });
    });

    $('#frm_director_info').submit(function (e) {
        e.preventDefault();
        submit_this_form($(this));
    });
    $('#frm_contact_info').submit(function (e) {
        e.preventDefault();
        submit_this_form($(this));
    });
    $('#frm_business_rules').submit(function (e) {
        e.preventDefault();
        submit_this_form($(this));
    });

    function submit_this_form($form) {

        var franchise_id = $('#franchise_id').val();
        $.LoadingOverlay('show');

        $form.ajaxSubmit({
            data: { franchise_id: franchise_id },
            success: function (result) {
                $.LoadingOverlay('hide');
                $('#franchise_id').val(result.id);
            }
        });
    }

});
