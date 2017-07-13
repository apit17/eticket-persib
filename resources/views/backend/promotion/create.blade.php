@extends('backend.index')
@section('title', '| Add Schedule')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Create New Schedule</h3>
            </div>
            <div class="module-body">
                <div class="module-body">
                    <form method="POST" action="{{ URL::to('admin/promotion/add') }}" accept-charset="UTF-8" id="create-promotion" name="create-promotion" enctype="multipart/form-data" class="form-horizontal row-fluid">
                    {{-- {!! csrf_field() !!} --}}
                        <div class="control-group">
                            <label class="control-label label" for="title">Title: </label>
                            <div class="controls">
                                <input type="text" name="title" id="title" placeholder="Enter title, Ex: PERSIB VS PERSIJA" class="span10" required="unique">
                            </div><br>
                            <div class="control-group">
                                <label class="control-label label" for="description">Description: </label>
                                <div class="controls">
                                    <input type="text" name="description" id="description" placeholder="Enter description, Ex: Stadion Gelora Bandung Lautan Api" class="span10" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label label" for="date">Date: </label>
                                <div class="controls">
                                    <input type="text" name="date" id="" placeholder="Enter date and time" class="datetime span10" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <label class="control-label label span3">Enter Logo Persib</label>
                                    <label class="control-label label span5">Enter Logo Rival</label>
                                    <input type="file" name="image1" class="span5" required>
                                    <input type="file" name="image2" class="span5" required>
                                </div>  
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="button" class="btn btn-xs btn-inverse">Tips :</button><small> This schedule will be sent to all customer.</small>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <a href="{{ URL::to('admin/promotion') }}"><button type="button" class="btn btn-danger">Cancle</button></a>
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
    @include('backend.promotion.js.index_js')
@stop