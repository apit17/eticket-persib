@extends('backend.index')
@section('title', '| Classement')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Classement Management</h3>
            </div>
            <div class="module-body">
                <button type="button" class="btn btn-inverse add" data-toggle="modal" data-target="#myModalAdd" title="Create New"><i class="menu-icon icon-plus"></i></button>

                @if(isset($posts))
                @foreach($posts as $post)

                <a type="button" class="btn btn-info edit" data-id="{{$post->id}}" data-toggle="modal" data-target="#myModalEdit" title="Update New"><i class="menu-icon icon-edit"></i></a><br/><hr>

                <div class="chart inline-legend grid" style=" margin-top:10px;">
                    <div id="placeholder2" class="graph" style="height: 400px;">
                    <table class="table table-bordered" width="100%" id="promotion-table">
                        <b><p><font color="#000080" size="2">Updated At - {{ $post->updated_at }}</font></p></b>
                        <thead>
                            <tr>
                                <th>
                                    <img src="{{asset('images/'. $post->classement_image)}}">
                                </th>
                                <th>
                                    <img src="{{asset('images1/'. $post->topscore_image)}}">
                                </th>
                            </tr>
                        </thead>
                    @endforeach
                    @endif
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
        <h4 class="modal-title">Add New Classement</h4>
      </div>
        <form class="row-fluid" method="POST" action="{{URL::to('/admin/classement/add')}}" accept-charset="UTF-8" id="create-product" name="create-classement" enctype="multipart/form-data">
          <div class="modal-body">
          <center>
            <div class="controls">
                <label class="control-label label span6">Enter Table Classement Image</label>
                <input type="file" name="image" class="span10" id="image" required>
            </div><br><br>
            <div class="controls">
                <label class="control-label label span6">Enter Top Scorer Image</label>
                <input type="file" name="topscore" class="span10" id="topscore">
            </div>
            </center>
            <br><div id="tips" style="margin-left:43px"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" required>Cancel</button>
            <button type="submit" class="btn btn-success" id="btn-submit">Submit</button>
          </div>
        </form>
    </div>
  </div>
</div>
<!-- End Modal add data -->
{{-- Begin Modal Edit Data --}}
<div id="myModalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update New Classement</h4>
      </div>
        <form class="row-fluid" method="POST" action="{{route('admin.classement.admin.update', 1)}}" accept-charset="UTF-8" id="create-product" name="create-classement" enctype="multipart/form-data">
        {!! csrf_field() !!}{!! method_field('PUT') !!}
          <div class="modal-body">
          <center>
            <div class="controls">
                <label class="control-label label span6">Enter Table Classement Image</label>
                <input type="file" name="image" class="span10" id="image">
            </div><br><br>
            <div class="controls">
                <label class="control-label label span6">Enter Top Scorer Image</label>
                <input type="file" name="topscore" class="span10" id="topscore">
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
@stop

@section('script')
    @include('backend.classement.js.index_js')
@stop