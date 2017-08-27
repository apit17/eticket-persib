@extends('backend.index')
@section('style')
@section('title', '| Transaction')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Transaction Management</h3>
            </div>
            <div class="module-body">
                <a href="javascript:void(0)" onclick="$('#myModalResi').modal('show')"><button type="button" class="btn btn-inverse add" title="Create New"><i class="menu-icon icon-plus"></i>ADD</button></a><br/>
                        <table class="table table-bordered" width="100%" id="sale-table">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>Date</th>
                                    <th width="5%">Transaction Code</th>
                                    <th>Customer</th>
                                    <th width="13%">Total Payment</th>
                                    <th>Address</th>
                                    <th width="13%">Action</th>
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
<!-- Begin modal detail -->
<div class="modal fade" id="myModalDetail" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><!-- Order title append here --></h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- End modal detail -->

<!-- Begin modal add resi number -->
<div class="modal fade" id="myModalResi" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Resi Number</h4>
        </div>
        <div class="modal-body">
            <input name="saleID" class="form-control" type="hidden" id="saleID">
            <input name="no_resi" class="form-control span4" type="text" id="no_resi" placeholder="Enter Resi Number" required><br/><br/> </span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" id="submit-button" class="btn btn-success">Submit</button>
        </div>
      </div>
    </div>
</div>
<!-- End modal add resi number -->
@stop

@section('script')
    @include('backend.print_tiket.js.index_js')
@stop