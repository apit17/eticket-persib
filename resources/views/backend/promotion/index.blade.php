@extends('backend.index')
@section('title', '| Shedule')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Schedule Management</h3>
            </div>
            <div class="module-body">
                <a href="{{URL::to('/admin/promotion/create')}}"><button type="button" class="btn btn-inverse add" title="Create New"><i class="menu-icon icon-plus"></i>ADD</button></a><br/>
                
                        <table class="table table-bordered" width="100%" id="promotion-table">
                            <thead>
                                <tr>
                                    {{-- <th>No.</th> --}} 
                                    <th>Title</th>
                                    <th>Persib</th>
                                    <th>Rival</th>
                                    <th>Description</th>
                                    <th>Date Time</th>
                                    {{-- <th>Create Time</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                  <tr>
                                    <td>{{$post->schedule_match}}</td>
                                    <td><img src="{{asset('images/'. $post->schedule_home_image)}}" height="50" width="50"></td>
                                    <td><img src="{{asset('images1/'. $post->schedule_away_image)}}" height="50" width="50"></td>
                                    <td>{{$post->schedule_stadion}}</td>
                                    <td>{{$post->schedule_date_match}}</td>
                                    {{-- <td>{{$post->created_at}}</td> --}}
                                    <td><a href="{{ route('admin.promotion.admin.edit', $post->id) }}" class="btn btn-small btn-info edit" title="Edit"><i class="menu-icon icon-edit"></i> </a> <a href="{{ route('admin.promotion.admin.detail', $post->id) }}" class="btn btn-small btn-success edit" title="Detail"><i class="menu-icon icon-search"></i> </a> <a data-id="{{$post->id}}" class="btn btn-small btn-danger delete" data-toggle="modal" data-target="#myModalDelete" title="Delete"><i class="menu-icon icon-remove"></i> </a></td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
            </div>
        </div>
    </div>
</div>
<!-- Begin Modal add data -->
{{-- <div id="myModalAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Shedule</h4>
      </div>
        <form class="row-fluid" method="POST" action="{{URL::to('/admin/promotion/add')}}" accept-charset="UTF-8" id="create-promotion" name="create-promotion" enctype="multipart/form-data">
          <div class="modal-body">
          <center>
            <input name="id" class="form-control" type="hidden" id="id">
            <div class="controls">
                <input name="title" class="span10" id="title" placeholder="Enter Title, ex: Persib VS Persija" required>
            </div>
            <div class="controls">
                <input name="description" id="description" class="span10" placeholder="Enter Description, ex : Stadion Gelora Bandung Lautan Api " required>
            </div>
            <div class="controls">
                <input name="date" type="text" id="date"  placeholder="Enter Date & Time" class="span10 datetime" required>
            </div>
            </center><br/>
            <div id="tips" style="margin-left:43px">
                <button type="button" class="btn btn-inverse btn-xs">Tips :</button><small>  This schedule will be sent to all customer emails.</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="btn-submit">Submit</button>
          </div>
        </form>
    </div>
  </div>
</div> --}}
<!-- End Modal add data -->
<!-- Begin modal delete -->
<div class="modal fade" id="myModalDelete" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Schedule</h4>
        </div>
        <form method="POST" action="{{URL::to('/admin/promotion/delete')}}" accept-charset="UTF-8" id="delete-promotion" name="delete-promotion">
        <div class="modal-body">
            <p>Are you sure want to remove this shedule ?</p>
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
    @include('backend.promotion.js.index_js') 
@stop