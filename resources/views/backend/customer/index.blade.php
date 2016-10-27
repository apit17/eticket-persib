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
                <h3>Customers Management</h3>
            </div>
            <div class="module-body">
                <div class="chart inline-legend grid" style=" margin-top:10px;">
                    <div id="placeholder2" class="graph" style="height: 400px;">
                        <table class="table table-bordered" width="100%" id="customer-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Hometown</th>
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
    @include('backend.customer.js.index_js')
@stop