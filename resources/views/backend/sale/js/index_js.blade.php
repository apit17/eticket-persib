<script type="text/javascript">
$(document).ready(function() {
    $('#transactionMenu').addClass('in');
    $('#sale-menu a').addClass('active-menu');

    //load dataTables
    $('#sale-table').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 1, "asc" ]],
        ajax: "{{URL::to('/admin/sale/datatables')}}",
        "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns: [
            { data: null, name: null, orderable: false},
            { data: 'date', name: 'date', orderable: true},
            { data: 'code', name: 'code', orderable: true},
            { data: 'customer', name: 'customer', orderable: true },
            { data: 'total', name: 'total', orderable: true },
            { data: 'address', name: 'address', orderable: true },
            { data: 'no_resi', name: 'no_resi', orderable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>