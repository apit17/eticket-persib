<script type="text/javascript">
$(document).ready(function() {
    $('#masterMenu').addClass('in');
    $('#classement-menu a').addClass('active-menu');
    //load dataTables
    $('#classement-table').DataTable({
        processing: true,
        serverSide: true,
        orderMulti: true
        // ajax: "{{URL::to('/admin/product/datatables')}}",
        // "fnCreatedRow": function (row, data, index) {
        //     $('td', row).eq(0).html(index + 1);
        // },
        // columns: [
        //     { data: null, name: null, orderable: false},
        //     { data: 'name', name: 'name', orderable: true},
        //     { data: 'color', name: 'color', orderable: true },
        //     { data: 'price', name: 'price', orderable: true },
        //     { data: 'stock', name: 'stock', orderable: true },
        //     { data: 'action', name: 'action', orderable: false, searchable: false }
        // ]
    });
    //add
    $(document).on('click','.add',function() {
        $('#myModalAdd .modal-title').text('Add Classement');
        $('#create-product').attr('action',"{{URL::to('/admin/classement/add')}}");
        $('#myModalAdd #stock').attr('disabled',false);
        $('#myModalAdd #tips').html('');
        document.getElementById("classement-product").reset();
    });
    
    //delete
    $(document).on('click','.delete',function(){
        var id = $(this).data('id');
        $('#ID').val(id);
    });
});
</script>