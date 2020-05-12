jQuery(function($){

    var user_list = $('select[name="user_list[]"]').bootstrapDualListbox({
        infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>',
        moveOnSelect: false,
        nonSelectedListLabel: 'All Available Users',
        selectedListLabel: 'Currently Assigned as ' + $('#group_name').val(),
    });
    var container1 = user_list.bootstrapDualListbox('getContainer');
    container1.find('.btn').addClass('btn-default');

});



