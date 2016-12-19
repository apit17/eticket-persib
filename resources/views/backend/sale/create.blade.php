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
                <h3>Create New Sale</h3>
            </div>
            <div class="module-body">
                <div class="module-body">
                    <form method="POST" action="{{URL::to('admin/sale/store')}}" accept-charset="UTF-8" id="form-sale" name="form-sale" enctype="multipart/form-data" class="form-horizontal row-fluid">
                        <!-- Sales Data -->
                        <div class="control-group">
                            <b>Sale Data :</b><br/>
                            <label class="control-label label" for="date">Date</label>
                            <div class="controls">
                                <input name="date" type="text" id="date"  placeholder="Select Date" class="span8 date-picker" required>
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
                                        <button type="button" class="btn btn-default removeButton"><i class="menu-icon icon-minus"></i></button>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="control-group">
                            <label class="control-label label" for="address">Shipping Address</label>
                            <div class="controls">
                                <textarea name="address" id="address" class="span8" rows="5" placeholder="Ex : Jalan Raya Bojongsoang No.169, Kec. Bojongsoang, Kab. Bandung, Bandung 40288." required></textarea>
                            </div>
                            <br/>
                            <label class="control-label label" for="sender">Sender</label>
                            <div class="controls">
                                <input type="radio" name="sender" onClick="javascript:void(setSender(1))" value="1" checked> Kissproof.id<br/>
                                <input type="radio" name="sender" onClick="javascript:void(setSender(2))" value="2"> Others &nbsp;
                                <input type="text" class="span6 hide" name="sender_other" id="sender_other" placeholder="Enter Sender, Ex: Siantanashop (081224770688)">
                            </div>
                            <br/>
                            <div class="controls">
                                <button type="button" class="btn btn-inverse btn-xs">Tips :</button><small>  Press <span class="menu-icon icon-plus"></span> to add another product.</small>
                            </div><br/>
                        </div>

                        <!-- Customers Data -->
                        <div class="control-group">
                            <b>Customer Data :</b><br/>
                            <label class="control-label label" for="name">Name</label>
                            <div class="controls">
                                <input name="name" type="text" id="name"  placeholder="Enter Name" class="span8" required>
                            </div>
                            <br/>
                            <label class="control-label label" for="phone">Mobile Phone</label>
                            <div class="controls">
                                <input name="phone" type="number" id="phone"  placeholder="Enter Mobile Phone" class="span8" required>
                            </div>
                            <br/>
                            <label class="control-label label" for="email">Email</label>
                            <div class="controls">
                                <input name="email" type="email" id="email"  placeholder="Enter Email" class="span8">
                            </div>
                            <br/>
                            <label class="control-label label" for="city">Hometown</label>
                            <div class="controls">
                                <input name="city" type="text" id="city"  placeholder="Enter Hometown (Kota Asal)" class="span8" required>
                            </div>
                        </div>
                        <!-- Button Actions -->
                        <div class="control-group">
                            <div class="controls" style="text-align:left">
                                <a href="{{URL::to('admin/sale')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
    @include('backend.sale.js.create_js')
@stop