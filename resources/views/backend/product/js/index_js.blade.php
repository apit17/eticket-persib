<script type="text/javascript">
$(document).ready(function() {
    $('#masterMenu').addClass('in');
    $('#product-menu a').addClass('active-menu');
    //load dataTables
    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 1, "asc" ]],
        ajax: "{{URL::to('/admin/product/datatables')}}",
        "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns: [
            { data: null, name: null, orderable: false},
            { data: 'name', name: 'name', orderable: true},
            { data: 'color', name: 'color', orderable: true },
            { data: 'price', name: 'price', orderable: true },
            { data: 'stock', name: 'stock', orderable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    //add
    $(document).on('click','.add',function() {
        $('#myModalAdd .modal-title').text('Add Ticket');
        $('#create-product').attr('action',"{{URL::to('/admin/product/add')}}");
        $('#myModalAdd #stock').attr('disabled',false);
        $('#myModalAdd #tips').html('');
        document.getElementById("create-product").reset();
    });
    //update
    $(document).on('click','.edit',function() {
        var id = $(this).data('id');
            $.ajax({
                'type':'post',
                'url':"{{URL::to('/admin/product/edit')}}",
                'data':{
                    'id': id,
                },
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    $('#myModalAdd .modal-title').text('Edit Product');
                    $('#create-product').attr('action',"{{URL::to('/admin/product/update')}}");
                    $('#myModalAdd #id').val(obj.id);
                    $('#myModalAdd #name').val(obj.name);
                    $('#myModalAdd #color').val(obj.color);
                    $('#myModalAdd #price').val(obj.price)
                    $('#myModalAdd #stock').val(obj.stock);
                    // $('#myModalAdd #stock').val(obj.stock).attr('disabled',true);
                    $('#myModalAdd #tips').html('<button type=button class=btn-primary>Tips :</button> <font color=grey> Stock only can change from procurement transaction.</font>');
                }
            });
    });
    //delete
    $(document).on('click','.delete',function(){
        var id = $(this).data('id');
        $('#ID').val(id);
    });
});
</script>