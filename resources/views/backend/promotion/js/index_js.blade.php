<script type="text/javascript">
$(document).ready(function() {
    $('#promotion-menu a').addClass('active-menu');

    //load dataTables
    $('#promotion-table').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 3, "desc" ]],
        ajax: "{{URL::to('/admin/promotion/datatables')}}",
        "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns: [
            { data: null, name: null, orderable: false},
            { data: 'title', name: 'title', orderable: true, searchable: true},
            { data: 'description', name: 'description', orderable: true, searchable: true},
            { data: 'created_at', name: 'created_at', orderable: true, searchable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    //add
    $(document).on('click','.add',function() {
        document.getElementById("create-promotion").reset();
    });

    //delete
    $(document).on('click','.delete',function(){
        var id = $(this).data('id');
        $('#ID').val(id);
    });
});
</script>