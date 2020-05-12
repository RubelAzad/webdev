$(function () {

    $('#insurance').on('change', function () {
        if($('#insurance').prop('checked')){
            $('#div_cover_all_item').show();
        }else{
            $('#div_cover_all_item').hide();
        }
    });

    $('#cover_all').checkboxpicker({
        offLabel: 'Valuable items only',
        onLabel: 'Cover All',
        offActiveCls: 'btn-primary',
        onActiveCls: 'btn-primary'
    });

    $('#to_country_code').change(function () {

        let src = $('#src_country_code').val();
        let dst = $(this).val();


        // get list of valuable items for select element
        axios.post('/cargo/get-valuable-items-src-dts',{
            src, dst
        })
            .then((response) => {
                let options = response.data.options;
                $('#valuable_item_id').empty();
                $('#valuable_item_id').append(options);
            });
    });

    $('#valuable_item_id').change(function () {
        get_item_cost();
    });

    function get_item_cost(){
        let selected = $(valuable_item_id).find('option:selected');
        let item_data = selected.data();

        let max_cost = item_data.max_cost;
        let purchase_price = item_data.max;


        $('#valuable_item_cost').prop('min', max_cost);
        $('#valuable_item_cost').prop('max', max_cost);

        $('#item_value').prop('data-max', purchase_price);

        $('#valuable_item_cost').val(max_cost);
    }


    $('#btn_add_item').click(function (e) {
        e.preventDefault();

        let item_id = $('#valuable_item_id').val();
        let item_cost = $('#valuable_item_cost').val();
        let item_value = $('#item_value').val();

        let selected = $('#valuable_item_id').find('option:selected');
        let item_data = selected.data();

        let max_purchase_price = item_data.max;

        if(item_value <= 0){
            swal('Please enter current value of the item','', 'error');
            return false;
        }

        if(max_purchase_price < item_value){
            swal('Item value cannot be be grater than ' + max_purchase_price.toFixed(2), '', 'warning');
            return false;
        }

        if(item_id !== '' && item_cost !== ''){
            axios.post('/cargo/add-item-to-quote', {
                item_id, item_cost, item_value
            }).then((result) => {
                let data = result.data;
                $('#item_fields').append(data.items);
                $('#valuable_item_id').val('');
                $('#valuable_item_cost').val('');
                $('#item_value').val('');
            });
        }

    });

    $('#btn_remove_item').click(function (e) {
        e.preventDefault();
    });


    $('#btn_add_package').click( function (e) {
        e.preventDefault();

        let i = $('#package_row_number').val();

        axios.get('/cargo/get-line-for-quote/' + i)
            .then((result) => {
                $('#package_row_number').val(result.data.i);
                $('#package_fields').append(result.data.row);
            });
    });


    $('#package_fields').on('click', '.remove', function (e) {
        e.preventDefault();

        $(this).parent().parent().remove();

    });

    valid_this_form('#frm_get_quote');

    $('#btn_get_quote').click(function (e) {
        e.preventDefault();

        valid_this_form('#frm_get_quote');

        if($('#insurance').prop('checked')){

            if($('#cover_all').prop('checked')){
                if($('#declare_value').val() < 1 ){

                    swal('Please enter declare value!', '', 'warning').then(()=>{
                        $('#declare_value').focus();
                    });
                    return false;
                }
            }

        }

        if($('#frm_get_quote').valid()){
            //$.LoadingOverlay('show');
            $('#frm_get_quote').submit();
        }

    });


    // var hint = new Bloodhound({
    //     datumTokenizer: Bloodhound.tokenizers.whitespace,
    //     queryTokenizer: Bloodhound.tokenizers.whitespace,
    //     prefetch: '/location/get_hint',
    //     remote: {
    //         url: '/person/get-all',
    //         wildcard: '%term'
    //     }
    // });
    //
    // $('#phone_number').typeahead(null, {
    //     name: 'phone_number',
    //     display: 'phone_number',
    //     source: users_number
    // }).on('typeahead:selected', function(event, selection){
    //     $('#user_id').val(selection.id);
    //
    //     if(selection.email){
    //         $('#email').val(selection.email);
    //     }else{
    //         $('#email').val('');
    //     }
    //     $('#name').val(selection.name);
    // });

    // $('#src_postcode').typeahead({
    //     name: 'typeahead',
    //     remote: {
    //         wildcard: '%QUERY',
    //         url: '/location/get_hint?query=%QUERY',
    //         replace: function(url, uriEncodedQuery) {
    //             let country_code = $('#src_country_code').val();
    //             if (!country_code) return url.replace("%QUERY",uriEncodedQuery);
    //             return url.replace("%QUERY",uriEncodedQuery) + '&param=' + encodeURIComponent(country_code)
    //         },
    //         template:{
    //             header: '<h3 class="league-name">NHL Teams</h3>'
    //         }
    //     }
    // });



    // $('#src_postcode').keyup(function (e) {
    //     let country_code = $('#src_country_code').val();
    //     let text = $('#src_postcode').val();
    //
    //     if(text === ''){
    //         return false;
    //     }
    //     let url = 'https://ezcmd.com/apps/api_geo_postal_codes/search/f57939e47408519e215a4d278e6ad3d9/273?zip_query='+ text +', ' + country_code;
    //     axios.get(url, { crossdomain: true })
    //         .then( (result) => {
    //             console.log(result.data)    ;
    //         });
    //
    //     // axios.post('/location/get_hint', {
    //     //     text : text, country_code : country_code
    //     // })
    //     //     .then((result) => {
    //     //         console.log(result.data)
    //     //     });
    // });

});