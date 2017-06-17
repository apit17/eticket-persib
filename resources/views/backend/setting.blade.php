@extends('backend.index')
@section('title', '| Setting')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Setting Account</h3>
            </div>
            <div class="module-body">
                <form method="POST" action="{{URL::to('admin/setting/update')}}" accept-charset="UTF-8" id="form-setting" name="form-setting" enctype="multipart/form-data" class="form-horizontal row-fluid">
                    <div class="chart inline-legend grid">
                        <div id="placeholder2" class="graph" style="height: 400px">
                            <div class="control-group">
                                <br/>
                                <label class="control-label label" for="first_name">First Name</label>
                                <div class="controls">
                                    <input name="first_name" type="text" id="first_name"  placeholder="Enter First Name" class="span8" value="{{$admin->first_name}}" required>
                                </div>
                                <br/>
                                <label class="control-label label" for="last_name">Last Name</label>
                                <div class="controls">
                                    <input name="last_name" type="text" id="last_name"  placeholder="Enter Last Name" class="span8" value="{{$admin->last_name}}" required>
                                </div>
                                <br/>
                                <div class="controls" style="text-align:left">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#setting-menu a').addClass('active-menu');
});
</script>

@stop