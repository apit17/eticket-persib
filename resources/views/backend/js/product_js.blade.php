<script type="text/javascript">
$(document).ready(function() {
    $('#togglePages').addClass('in');
    $('#product-menu a').addClass('active-menu');
    //load dataTables
    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 0, "asc" ]],
        ajax: "{{URL::to('/admin/product/data')}}",
        columns: [
            { data: 'name', name: 'name', orderable: true},
            { data: 'qty', name: 'qty', orderable: true },
            { data: 'department_name', name: 'department_name', orderable: true },
            { data: 'location', name: 'location', orderable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    //add
    $(document).on('click','.add',function() {
        $('#myModalAdd .modal-title').text('Add Product');
        $('#create-product').attr('action',"{{URL::to('/admin/product/store')}}");
        document.getElementById("create-product").reset();
    });
    //update
    $(document).on('click','.edit',function() {
        var id = $(this).data('id');
            $.ajax({
                'type':'post',
                'url':"{{URL::to('/admin/product/detail')}}",
                'data':{
                    'id': id,
                },
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    $('#myModalAdd .modal-title').text('Edit Product');
                    $('#create-product').attr('action',"{{URL::to('/admin/product/update')}}");
                    $('#myModalAdd #id').val(obj.id);
                    $('#myModalAdd #name').val(obj.name);
                    $('#myModalAdd #qty').val(obj.qty);
                    $('#myModalAdd #department_id').val(obj.department_id);
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