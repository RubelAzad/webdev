$(function () {
    $('.chosen').chosen();
    
    $('#src_country').change(function () {
        let src_country = $(this).val();

        axios.post('/service/get-dst-by-src',{
            src_country
        }).then((response) => {
            let data = response.data;

            //console.log(data);

            let el = $('#dst_country');
            el.empty();

            el.append('<option value=""></option>');
            data.forEach(function (country) {
                let option = '<option  value="'+ country.iso_3166_3 +'">'+ country.name +'</option>';
                el.append(option);
            });

        });
    });

    $('#btn_add_package').click(function (e) {
        e.preventDefault();
    });

    $('#btn_get_quote').click(function (e) {
        e.preventDefault();
    });

});