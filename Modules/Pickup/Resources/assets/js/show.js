/**
 * Created by Bashet on 04/06/2018.
 */

$(function () {

    $('#tbl_agents').dataTable({
        stateSave: true,
        columnDefs: [
            {
                "targets": [4],
                "orderable": false
            }
        ]
    });

    $('#btn_assign_to_agent').click(function () {
        $('#md_agent').modal('show');
    });

    $('#tbl_agents').on('click', '.select_agent', function () {
        $('#md_agent').modal('hide');
        $.LoadingOverlay('show');
        var data = $(this).data();
        var agent_id = data.agent_id;
        var pickup_id = data.pickup_id;
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/pickup/assign-agent",
            datatype: 'JSON',
            data:{agent_id:agent_id, pickup_id: pickup_id}
        }).done(function (result) {
            var agent_info = result.name + ', ' + result.city;
            $('#agent_info').html(agent_info);
            $.LoadingOverlay('hide');
        });
    });

});