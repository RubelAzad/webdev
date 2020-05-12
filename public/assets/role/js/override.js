$(function () {

    $('#btn_see_overridden').click(function () {


        $('.overridden').show();
        $('.not_overridden').hide();

        $('#btn_see_all').removeClass('btn-primary');
        $('#btn_see_overridden').addClass('btn-primary');
        $('#btn_see_not_overridden').removeClass('btn-primary');

        $('#what_to_show').html('Overridden');
    });

    $('#btn_see_not_overridden').click(function () {

        $('.overridden').hide();
        $('.not_overridden').show();

        $('#btn_see_all').removeClass('btn-primary');
        $('#btn_see_overridden').removeClass('btn-primary');
        $('#btn_see_not_overridden').addClass('btn-primary');

        $('#what_to_show').html('Not Overridden');
    });

    $('#btn_see_all').click(function () {

        $('.overridden').show();
        $('.not_overridden').show();

        $('#btn_see_all').addClass('btn-primary');
        $('#btn_see_overridden').removeClass('btn-primary');
        $('#btn_see_not_overridden').removeClass('btn-primary');

        $('#what_to_show').html('All');
    });
});
