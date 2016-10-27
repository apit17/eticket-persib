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
                <h3>Create New Procurement</h3>
            </div>
            <div class="module-body">
                <div class="module-body">
                    <form method="POST" action="{{URL::to('admin/procurement/store')}}" accept-charset="UTF-8" id="form-procurement" name="form-procurement" enctype="multipart/form-data" class="form-horizontal row-fluid">
                        <div class="control-group">
                            <label class="control-label label" for="date">Date</label>
                            <div class="controls">
                                <input name="date" type="text" id="date"  placeholder="Select Date" class="span10 date-picker" required>
                            </div>
                            <br/>
                            <div class="control-group" id="productsOption">
                                <label class="control-label label" for="products">Products</label>
                                    <div class="controls">
                                        <select class="form-control" name="products[]" placeholder="Choose Product" id="products" required>
                                            <option value="">Choose Product</option>
                                            @foreach($product as $i => $val)
                                                <option value="{{$val->id}}">{{ucwords($val->name)}} - {{ucwords($val->color)}} ({{$val->stock}})</option>
                                            @endforeach
                                        </select>
                                        <input type="number" class="form-control span3" name="qtys[]" placeholder="Enter Quantity" min="1" id="qtys" required/>
                                        <input type="number" class="form-control span3" name="prices[]" placeholder="Enter Price" min="1" id="prices" required/>
                                        <button type="button" class="btn btn-default addButton"><i class="menu-icon icon-plus"></i></button>
                                    </div>
                                    <br/>
                                <!-- The option field template containing an option field and a Remove button -->
                                <div class="form-group hide" id="optionTemplate">
                                    <div class="controls">
                                        <select class="form-control" name="products[]" placeholder="Choose Product">
                                            <option value="">Choose Product</option>
                                            @foreach($product as $i => $val)
                                                <option value="{{$val->id}}">{{ucwords($val->name)}} - {{ucwords($val->color)}} ({{$val->stock}})</option>
                                            @endforeach
                                        </select>
                                        <input type="number" class="form-control span3" name="qtys[]" placeholder="Enter Quantity" min="1" id="qtys" />
                                        <input type="number" class="form-control span3" name="prices[]" placeholder="Enter Price" min="1" id="prices" />
                                        <button type="button" class="btn btn-default removeButton"><i class="menu-icon icon-minus"></i></button>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="control-group">
                            <div class="controls">
                                <button type="button" class="btn btn-inverse btn-xs">Tips :</button><small>  Press <span class="menu-icon icon-plus"></span> to add another product.</small>
                            </div>
                        </div>

                        <!-- Button Actions -->
                        <div class="control-group">
                            <div class="controls" style="text-align:left">
                                <a href="{{URL::to('admin/procurement')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
    @include('backend.procurement.js.create_js')
@stop