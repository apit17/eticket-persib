<script type="text/javascript">
$(document).ready(function() {
    $('#transactionMenu').addClass('in');
    $('#sale-menu a').addClass('active-menu');

    //load dataTables
    $('#sale-table').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 1, "desc" ]],
        ajax: "{{URL::to('/admin/sale/datatables')}}",
        "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns: [
            { data: null, name: null, orderable: false},
            { data: 'created_at', name: 'date', orderable: true, searchable: true},
            { data: 'transaction_code', name: 'code', orderable: true, searchable: true},
            { data: 'customer_id', name: 'customer', orderable: true, searchable: true },
            { data: 'transaction_price', name: 'total', orderable: true, searchable: true },
            { data: 'address', name: 'address', orderable: true, searchable: true },
            { data: 'transaction_resi_number', name: 'no_resi', orderable: true, searchable: true },
            { data: 'transaction_resi_status', name: 'status', orderable: true, searchable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    //detail
    $(document).on('click','.detail',function() {
        var id = $(this).data('id');
        $.ajax({
            'type':'get',
            'url':"{{URL::to('/admin/sale/detail')}}",
            'data':{
                'id': id,
            },
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                $('#myModalDetail .modal-title').text('Detail Order ID#'+obj.order);
                $('#myModalDetail .modal-body').html(obj.table);
                $('#myModalDetail').modal('show');
            }
        });
    });

    //add resi number
    $(document).on('click','.addResi',function() {
        var id = $(this).data('id');
        $('#saleID').val(id);
    });
});
</script>