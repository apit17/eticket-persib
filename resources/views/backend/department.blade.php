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
                <h3>Department</h3>
            </div>
            <div class="module-body">
                <button type="button" class="btn btn-inverse add" data-toggle="modal" data-target="#myModalAdd" title="Create New"><i class="menu-icon icon-plus"></i>ADD</button><br/>
                <div class="chart inline-legend grid" style=" margin-top:10px;">
                    <div id="placeholder2" class="graph" style="height: 400px;">
                        <table class="table table-bordered" width="100%" id="department-table">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Address</th>
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
        <h4 class="modal-title">Add Dapartment</h4>
      </div>
        <form class="row-fluid" method="POST" action="{{URL::to('/admin/department/store')}}" accept-charset="UTF-8" id="create-department" name="create-department" enctype="multipart/form-data">
          <div class="modal-body">
          <center>
            <input name="id" class="form-control" type="hidden" id="id">
            <div class="controls">
                <input name="name" class="span10" id="name" placeholder="Enter Name" required>
            </div>
            <div class="controls">
                <textarea row="3" name="address" id="address" class="span10" style="margin-top:20px" placeholder="Enter Address" required></textarea>
            </div>
            </center>
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
          <h4 class="modal-title">Delete Department</h4>
        </div>
        <form method="POST" action="{{URL::to('/admin/department/destroy')}}" accept-charset="UTF-8" id="delete-department" name="delete-department">
        <div class="modal-body">
            <p>Are you sure want to remove this data ?</p>
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
<!-- Begin modal delete -->
@stop

@section('script')
    @include('backend.js.department_js')
@stop