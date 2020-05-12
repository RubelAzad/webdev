$(function () {

    let table = $('#tbl_booking').DataTable({
        responsive: true,
        stateSave: true,
        autoWidth: true,
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ]
    });

    table.on("click", "th.select-checkbox", function() {
        if ($("th.select-checkbox").hasClass("selected")) {
            table.rows().deselect();
            $("th.select-checkbox").removeClass("selected");
            $("th.select-checkbox").html('<i class="fa fa-square-o"></i>')
        } else {
            table.rows().select();
            $("th.select-checkbox").addClass("selected");
            $("th.select-checkbox").html('<i class="fa fa-check-square-o"></i>')
        }
    }).on("select deselect", function() {
        ("Some selection or deselection going on")
        if (table.rows({
                selected: true
            }).count() !== table.rows().count()) {
            $("th.select-checkbox").removeClass("selected");
        } else {
            $("th.select-checkbox").addClass("selected");
        }
    });

    $('#btn_assign_pickup').click(function (e) {
        e.preventDefault();

        let posts = [];

        //get selected row from table
        let selected_rows = table.rows( { selected: true } );

        // keep those selected row in a array
        selected_rows.every(function () {
            let tracking_no = this.data()[1];
            posts.push(tracking_no);
        });

        // if nothing selected, don't go ahead
        if(posts.length < 1){
            return false;
        }

        $('#posts').val(posts);

        $('#frm_assign_to_warehouse').submit();

    });


});