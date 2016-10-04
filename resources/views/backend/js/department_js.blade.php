<script type="text/javascript">
$(document).ready(function() {
    $('#togglePages').addClass('in');
    $('#department-menu a').addClass('active-menu');
    //load dataTables
    $('#department-table').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 0, "asc" ]],
        ajax: "{{URL::to('/admin/department/data')}}",
        columns: [
            { data: 'name', name: 'name', orderable: true},
            { data: 'address', name: 'address', orderable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    //add
    $(document).on('click','.add',function() {
        $('#myModalAdd .modal-title').text('Add Dapartment');
        $('#create-department').attr('action',"{{URL::to('/admin/department/store')}}");
        document.getElementById("create-department").reset();
    });
    //update
    $(document).on('click','.edit',function() {
        var id = $(this).data('id');
            $.ajax({
                'type':'post',
                'url':"{{URL::to('/admin/department/detail')}}",
                'data':{
                    'id': id,
                },
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    $('#myModalAdd .modal-title').text('Edit Dapartment');
                    $('#create-department').attr('action',"{{URL::to('/admin/department/update')}}");
                    $('#myModalAdd #id').val(obj.id);
                    $('#myModalAdd #name').val(obj.name);
                    $('#myModalAdd #address').val(obj.address);
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