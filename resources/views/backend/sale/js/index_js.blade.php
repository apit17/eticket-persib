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
            { data: 'date', name: 'date', orderable: true, searchable: true},
            { data: 'code', name: 'code', orderable: true, searchable: true},
            { data: 'customer', name: 'customer', orderable: true, searchable: true },
            { data: 'total', name: 'total', orderable: true, searchable: true },
            { data: 'address', name: 'address', orderable: true, searchable: true },
            { data: 'no_resi', name: 'no_resi', orderable: true, searchable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    //detail
    $(document).on('click','.detail',function() {
        var id = $(this).data('id');
            $.ajax({
                'type':'post',
                'url':"{{URL::to('/admin/sale/detail')}}",
                'data':{
                    'id': id,
                },
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    $('#myModalDetail .modal-title').text('Detail Order ID#'+obj.order);
                    $('#myModalDetail .modal-body').html(obj.table);
                }
            });
    });
});
</script>