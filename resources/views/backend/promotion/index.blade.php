@extends('backend.index')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Promotions Management</h3>
            </div>
            <div class="module-body">
                <button type="button" class="btn btn-inverse add" data-toggle="modal" data-target="#myModalAdd" title="Create New"><i class="menu-icon icon-plus"></i>ADD</button><br/>
                <div class="chart inline-legend grid" style=" margin-top:10px;">
                    <div id="placeholder2" class="graph" style="height: 400px;">
                        <table class="table table-bordered" width="100%" id="promotion-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Create Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data tables append here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Begin Modal add data -->
<div id="myModalAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Promotion</h4>
      </div>
        <form class="row-fluid" method="POST" action="{{URL::to('/admin/promotion/add')}}" accept-charset="UTF-8" id="create-promotion" name="create-promotion" enctype="multipart/form-data">
          <div class="modal-body">
          <center>
            <div class="controls">
                <input name="title" class="span10" id="title" placeholder="Enter Title, ex: Promo Akhir Tahun" required>
            </div>
            <div class="controls">
                <textarea name="description" id="description" class="span10" rows="5" placeholder="Enter Description, ex : Nikmati promo berbelanja di Kissproof, gratis ongkos kirim ke seluruh Indonesia selama bulan Desember 2016 " style="margin-top:20px" required></textarea>
            </div>
            </center><br/>
            <div id="tips" style="margin-left:43px">
                <button type="button" class="btn btn-inverse btn-xs">Tips :</button><small>  This promotion will be sent to all customer emails.</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="btn-submit">Submit</button>
          </div>
        </form>
    </div>
  </div>
</div>
<!-- End Modal add data -->
<!-- Begin modal delete -->
<div class="modal fade" id="myModalDelete" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Promotion</h4>
        </div>
        <form method="POST" action="{{URL::to('/admin/promotion/delete')}}" accept-charset="UTF-8" id="delete-promotion" name="delete-promotion">
        <div class="modal-body">
            <p>Are you sure want to remove this promotion ?</p>
            <input name="ID" class="form-control" type="hidden" id="ID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
        </form>
      </div>
    </div>
</div>
<!-- End modal delete -->
@stop

@section('script')
    @include('backend.promotion.js.index_js')
@stop