<script type="text/javascript">
$(document).ready(function() {
    $('#customer-menu a').addClass('active-menu');

    //load dataTables
    $('#customer-table').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 1, "asc" ]],
        ajax: "{{URL::to('/admin/customer/datatables')}}",
        "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns: [
            { data: null, name: null, orderable: false},
            { data: 'customer_name', name: 'name', orderable: true, searchable: true},
            { data: 'customer_ktp', name: 'noid', orderable: true, searchable: true},
            { data: 'customer_email', name: 'email', orderable: true, searchable: true},
            { data: 'customer_handphone', name: 'phone', orderable: true, searchable: true },
            { data: 'customer_city', name: 'city', orderable: true, searchable: true }
        ]
    });
});
</script>