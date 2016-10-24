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
                <h3>Dashboard</h3>
            </div>
            <div class="module-body">
                <div class="chart inline-legend grid">
                    <div id="placeholder2" class="graph" style="height: 400px">
                        <center>
                            <video poster="{!! asset('multimedia/our.gif') !!}" width="100%" height="365" controls autoplay loop>
                              <source src="{!! asset('multimedia/song.mp3') !!}" type="video/ogg">
                            </video>
                            </iframe>
                            <div class="alert alert-info">
                                <center><strong>Welcome <font color="black">{{ucwords($admin->first_name)}} {{ucwords($admin->last_name)}}</font></strong>, Please use the navigation menu.</center>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#dashboard-menu a').addClass('active-menu');
});
</script>

@stop