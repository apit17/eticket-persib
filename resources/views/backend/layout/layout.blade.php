<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kissproof ID</title>
    <link rel="shortcut icon" type="image/png" href="{!! asset('asset/images/lips.png') !!}" />
    <link type="text/css" href="{!! asset('asset/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/bootstrap/css/bootstrap-responsive.min.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/css/theme.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/css/pace.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/images/icons/css/font-awesome.css') !!}" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <link type="text/css" href="{!! asset('asset/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/css/jquery-ui.min.css') !!}" rel="stylesheet">
    <link type="text/css" href="{!! asset('asset/css/select2.min.css') !!}" rel="stylesheet">
    @yield('style')
</head>
<body>
@if(Session::has('flash_message'))
    <div class="alert alert-success alert-flash">
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
            <b class="copyright">&copy; 2016 Kissproof ID - <a href="https://www.linkedin.com/in/andresiantana" target="_blank">Andre Siantana</a> </b>| All rights reserved.
        </div>
    </div>
    <script src="{!! asset('asset/scripts/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/jquery-ui-1.10.1.custom.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/bootstrap/js/bootstrap.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/jquery.dataTables.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/pace.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/select2.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/flot/jquery.flot.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/flot/jquery.flot.pie.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('asset/scripts/flot/jquery.flot.resize.js') !!}" type="text/javascript"></script>
    <!-- <script src="{!! asset('asset/scripts/common.js') !!}" type="text/javascript"></script> -->
    <script src="{!! asset('asset/scripts/highcharts.js') !!}" type="text/javascript"></script>
@yield('script')

</body>
</html>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('div.alert-flash').delay(3000).slideUp(300);
    $(".priceFormat").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    jQuery('.date-picker').datepicker({ dateFormat: 'dd-mm-yy'});
    $(".select2").select2();
});
$(document).ajaxStart(function() {
    Pace.restart();
});
</script>