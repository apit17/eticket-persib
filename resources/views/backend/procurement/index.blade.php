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
                <h3>Procurements Transaction Management</h3>
            </div>
            <div class="module-body">
                <a href="{{URL::to('admin/procurement/create')}}"><button type="button" class="btn btn-inverse add" title="Create New"><i class="menu-icon icon-plus"></i>ADD</button></a><br/>
                <div class="chart inline-legend grid" style=" margin-top:10px;">
                    <div id="placeholder2" class="graph" style="height: 400px;">
                        <table class="table table-bordered" width="100%" id="procurement-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Procurement Code</th>
                                    <th>Total Payment</th>
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
<!-- Begin modal detail -->
<div class="modal fade" id="myModalDetail" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><!-- Procurement title append here --></h4>
        </div>
        <div class="modal-body">
            <!-- Detail procurement append here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!-- End modal detail -->

@stop

@section('script')
    @include('backend.procurement.js.index_js')
@stop