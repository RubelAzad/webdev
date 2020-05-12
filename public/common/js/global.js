/**
 * Created by Bashet on 14/06/2016.
 */
$(function () {

    $('.date').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: true,
        todayHighlight: true,
        autoclose: true
    });

    $.LoadingOverlaySetup({
        image       : "",
        fontawesome : "fa fa-cog fa-spin",
        progress    : true
    });


    $('#header').on('click', '.mark', function () {
        var task_id = this.id;
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/user/update-notification",
            datatype: 'JSON',
            data:{id:task_id}
        }).done(function( msg ) {
            var btn  = $('#' + task_id);
            if(msg.read_at){
                btn.children('i').removeClass('fa-square-o').addClass('fa-check-square-o');
                btn.prop('title', 'Mark as un-read');
                btn.parent().parent().removeClass('unread').addClass('read');
            }else{
                btn.children('i').removeClass('fa-check-square-o').addClass('fa-square-o');
                btn.prop('title', 'Mark as read');
                btn.parent().parent().removeClass('read').addClass('unread');
            }

        });
    });

    $('#header').on('click', '.delete', function () {
        var task_id = this.id;
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/user/delete-notification",
            datatype: 'JSON',
            data:{id:task_id}
        }).done(function( msg ) {
            if(msg){
                $('li['+ task_id +']').slideUp();
            }
        });
    });

    $.fn.modal.Constructor.prototype.enforceFocus = function () {
        $(document)
            .off('focusin.bs.modal') // guard against infinite focus loop
            .on('focusin.bs.modal', $.proxy(function (e) {
                if (this.$element[0] !== e.target && !this.$element.has(e.target).length) {
                    this.$element.focus();
                }
            }, this));
    };

    $('.switch').checkboxpicker();


});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function isPhone(telephone) {
    var regex = /\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}/;
    return regex.test(telephone);
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');
}

function valid_this_form(MyForm) {
    $(MyForm).validate({
        ignore: ":hidden:not(.chosen-select, .select2)",
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'has-error help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
}

/*
history.pushState(null, document.title, location.href);
//history.pushState(null, null, 'hello');
window.addEventListener('popstate', function (event)
{
    history.pushState(null, document.title, location.href);
    //history.pushState(null, null, 'hello');
});
*/
