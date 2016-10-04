<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kissproof ID</title>
    <link type="text/css" href="{!! asset('asset/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/bootstrap/css/bootstrap-responsive.min.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/css/theme.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/css/pace.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/images/icons/css/font-awesome.css') !!}" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <link type="text/css" href="{!! asset('asset/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet">
    @yield('style')
</head>
<body>
@if(Session::has('flash_message'))
    <div class="alert alert-warning alert-flash">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{Session::get('flash_message')}}
    </div>
@endif
@if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-flash">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{Session::get('flash_message_error')}}
    </div>
@endif
@yield('content')
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2016 Kissproof ID - Andre Siantana </b> All rights reserved.
        </div>
    </div>
    <script src="{!! asset('asset/scripts/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/jquery-ui-1.10.1.custom.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/bootstrap/js/bootstrap.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/jquery.dataTables.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/pace.min.js') !!}" type="text/javascript"></script>
@yield('script')

</body>
</html>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('div.alert-flash').delay(3000).slideUp(300);
});
$(document).ajaxStart(function() {
    Pace.restart();
});
</script>