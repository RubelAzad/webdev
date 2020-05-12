/**
 * Created by Bashet on 15/12/2016.
 */

$(function () {
    var accordionIcons = {
        header: "fa fa-plus",    // custom icon class
        activeHeader: "fa fa-minus" // custom icon class
    };

    $("#accordion").accordion({
        autoHeight : false,
        heightStyle : "content",
        collapsible : true,
        animate : 300,
        icons: accordionIcons,
        header : "h4",
    });

    valid_this_form('#frm_config');

    $('#btn_update_config').click(function (e) {
        e.preventDefault();
        if($('#frm_config').valid()){
            $('#frm_config').submit();
        }
    });
});