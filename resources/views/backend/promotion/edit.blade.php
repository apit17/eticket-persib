@extends('backend.index')
@section('title', '| Edit Schedule')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Edit Schedule</h3>
            </div>
            <div class="module-body">
                <div class="module-body">
                    <form method="POST" action="{{ route('admin.promotion.admin.update', $post->id) }}" accept-charset="UTF-8" id="create-promotion" name="create-promotion" enctype="multipart/form-data" class="form-horizontal row-fluid">
                    {!! csrf_field() !!}{!! method_field('PUT') !!}

                    {{-- {!! Form::model($post, ['route' => ['admin/promotion/id/update', $post->id]]) !!} --}}
                        <div class="control-group">
                        {{-- <h1>{{$post->schedule_title}}</h1> --}}
                            <label class="control-label label" for="title">Title: </label>
                            <div class="controls">
                                <input value="{{$post->schedule_match}}" type="text" name="title" id="title" placeholder="Enter title, Ex: PERSIB VS PERSIJA" class="span10" required>
                            </div><br>
                            <div class="control-group">
                                <label class="control-label label" for="description">Description: </label>
                                <div class="controls">
                                    <input value="{{$post->schedule_stadion}}" type="text" name="description" id="description" placeholder="Enter description, Ex: Stadion Gelora Bandung Lautan Api" class="span10" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label label" for="date">Date: </label>
                                <div class="controls">
                                    <input value="{{$post->schedule_date_match}}" type="text" name="date" id="" placeholder="Enter date and time" class="datetime span10" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label label" for="date">Tanggal Pemesanan: </label>
                                <div class="controls">
                                    <input value="{{$post->schedule_start_date}}" type="text" name="start_date" id="" placeholder="Enter date and time" class="datetime span10" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="row">
                                    <label class="control-label label span3">Edit Logo Persib</label>
                                    <label class="control-label label span5">Edit Logo Rival</label>
                                    </div>
                                    <div class="row">
                                    <img src="{{asset('images/'. $post->schedule_home_image)}}" height="200" width="200"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <img src="{{asset('images1/'. $post->schedule_away_image)}}" height="200" width="200"></div>
                                    <input type="file" name="image1" class="span5">&nbsp; &nbsp; &nbsp;
                                    <input type="file" name="image2" class="span5">
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
                                <a href="{{ URL::to('admin/promotion') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                    {{-- {!! Form::close() !!} --}}
                </div>
            </div>
        </div>   
    </div>
</div>
@stop

@section('script')
    @include('backend.promotion.js.index_js')
@stop