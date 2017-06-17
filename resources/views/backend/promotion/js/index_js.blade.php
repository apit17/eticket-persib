<script type="text/javascript">
$(document).ready(function() {
    $('#promotion-menu a').addClass('active-menu');

    //load dataTables
    $('#promotion-table').DataTable({
        processing: true,
        serverSide: false,
        orderMulti: true
         // ajax: "{{URL::to('/admin/promotion/datatables')}}",
    //     "fnCreatedRow": function (row, data, index) {
    //         $('td', row).eq(0).html(index + 1);
    //     },
    //     // columns: [
        //     { data: null, name: null, orderable: false},
        //     { data: 'title', name: 'title', orderable: true, searchable: true},
        //     { data: 'description', name: 'description', orderable: true, searchable: true},
        //     { data: 'date', name: 'date', orderable: true, searchable: true},
        //     { data: 'created_at', name: 'created_at', orderable: true, searchable: true },
        //     { data: 'action', name: 'action', orderable: false, searchable: false }
        // ]
    });

    //add
    $(document).on('click','.add',function() {
        document.getElementById("create-promotion").reset();
    });

    //updaate
    // $(document).on('click','.edit',function() {
    //      var id = $(this).data('id');
    //          $.ajax({
    //              'type':'post',
    //              'url':"{{URL::to('/admin/promotion/edit')}}",
    //              'data':{
    //                  'id': id,
    //              },
    //              success: function(data) {
    //                  var obj = jQuery.parseJSON(data);
    //              $('#myModalAdd .modal-title').text('Edit Promotion');
    //                  $('#create-promotion').attr('action',"{{URL::to('/admin/promotion/update')}}");
    //                 $('#myModalAdd #id').val(obj.id);
    //                 $('#myModalAdd #title').val(obj.title);
    //                $('#myModalAdd #description').val(obj.description);
    //                 $('#myModalAdd #date').val(obj.date);
    //                 $('#myModalAdd #stock').val(obj.stock);
    //  $('#myModalAdd #stock').val(obj.stock).attr('disabled',true);
    //  $('#myModalAdd #tips').html('<button type=button class=btn-primary>Tips :</button> <font color=grey> Stock only can change from procurement transaction.</font>');
    //             }
    //          });
    //  });

    //delete
    $(document).on('click','.delete',function(){
        var id = $(this).data('id');
        $('#ID').val(id);
    });
});
</script>