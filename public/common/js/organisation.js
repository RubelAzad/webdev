$(function () {

    MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

// the element you want to observe. change the selector to fit your use case
    var img = document.querySelector('#org_logo');

    new MutationObserver(function onSrcChange(){
        // src attribute just changed!!! put code here
        var logo = $('#org_logo').attr('src');

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/org/change-logo",
            datatype: 'JSON',
            data:{logo:logo}
        }).done(function( msg ) {
            if(msg == true){
                swal("Logo updated!", '', 'success');
            }
        });

    }).observe(img,{attributes:true,attributeFilter:["src"]})
});