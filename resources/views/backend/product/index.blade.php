@extends('backend.index')
@section('title', '| Ticket')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Ticket Management</h3>
            </div>
            <div class="module-body">
                <button type="button" class="btn btn-inverse add" data-toggle="modal" data-target="#myModalAdd" title="Create New"><i class="menu-icon icon-plus"></i>ADD</button><br/>
                <div class="chart inline-legend grid" style=" margin-top:10px;">
                    <div id="placeholder2" class="graph" style="height: 400px;">
                        <table class="table table-bordered" width="100%" id="product-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category</th>
                                    <th>Match</th>
                                    <th>Price</th>
                                    <th>Stock</th>
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
        <h4 class="modal-title">Add Ticket</h4>
      </div>
        <form class="row-fluid" method="POST" action="{{URL::to('/admin/product/add')}}" accept-charset="UTF-8" id="create-product" name="create-product" enctype="multipart/form-data">
          <div class="modal-body">
          <center>
            <input name="id" class="form-control" type="hidden" id="id">
            <div class="controls">
                <input name="name" class="span10" id="name" placeholder="Enter Category Ticket, ex: Tribun Timur">
            </div>
            <div class="controls">
                <input name="color" class="span10" id="color" placeholder="Enter Match, ex: Persib VS Persija" style="margin-top:20px">
            </div>
            <div class="controls">
                <input name="price" class="span10 priceFormat" id="price" placeholder="Enter Price, ex: 75000" style="margin-top:20px">
            </div>
            <div class="controls">
                <input type="number" min="0" name="stock" class="span10" id="stock" placeholder="Enter Stock, Ex: 10" style="margin-top:20px">
            </div>
            </center>
            <br><div id="tips" style="margin-left:43px"></div>
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
          <h4 class="modal-title">Delete Ticket</h4>
        </div>
        <form method="POST" action="{{URL::to('/admin/product/delete')}}" accept-charset="UTF-8" id="delete-product" name="delete-product">
        <div class="modal-body">
            <p>Are you sure want to remove this Ticket ?</p>
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
    @include('backend.product.js.index_js')
@stop