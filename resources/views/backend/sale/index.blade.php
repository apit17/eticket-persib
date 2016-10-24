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
                <h3>Sales Transaction Management</h3>
            </div>
            <div class="module-body">
                <a href="{{URL::to('admin/sale/create')}}"><button type="button" class="btn btn-inverse add" title="Create New"><i class="menu-icon icon-plus"></i>ADD</button></a><br/>
                <div class="chart inline-legend grid" style=" margin-top:10px;">
                    <div id="placeholder2" class="graph" style="height: 400px;">
                        <table class="table table-bordered" width="100%" id="sale-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Order Code</th>
                                    <th>Customer</th>
                                    <th>Total Payment</th>
                                    <th>Shipping Address</th>
                                    <th>Resi</th>
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

@stop

@section('script')
    @include('backend.sale.js.index_js')
@stop