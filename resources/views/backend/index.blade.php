@extends('backend.layout.layout')

@section('content')
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href=""><font color="#0000FF" size="6"><img src="{!! asset('asset/images/lipstik.png') !!}" width="120" height="120"> E-Ticket Persib</font></a>
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="span3">
                <div class="sidebar">
                    <ul class="widget widget-menu unstyled">
                        <!-- <li id="dashboard-menu"><a href="{{URL::to('admin/dashboard')}}"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li> -->

                        <li id="statistic-menu"><a href="{{URL::to('admin/statistic')}}"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>

                        <li id="customer-menu"><a href="{{URL::to('admin/customer')}}"><i class="menu-icon icon-user"></i>Customers</a></li>

                        <li id="sale-menu"><a href="{{URL::to('admin/sale')}}"><i class="menu-icon icon-shopping-cart"></i>
                        Transaction </a></li>

                        <li id="classement-menu"><a href="{{URL::to('admin/classement')}}"><i class="menu-icon icon-th-list"></i>Classement</a></li>
                        
                        <!-- <li id="product-menu"><a href="{{URL::to('admin/product')}}"><i class="menu-icon icon-credit-card"></i>Ticket</a></li> -->

                        <li id="promotion-menu"><a href="{{URL::to('admin/promotion')}}"><i class="menu-icon icon-bullhorn"></i>Shedule</a></li>

                        <li id="setting-menu"><a href="{{URL::to('admin/setting')}}"><i class="menu-icon icon-cog"></i>Settings</a></li>

                        <!-- <li id="print-menu"><a href="{{URL::to('admin/print')}}"><i class="menu-icon icon-print"></i>Print Tiket</a></li> -->

                        <li><a href="{{URL::to('admin/logout')}}"><i class="menu-icon icon-signout"></i>Logout </a></li>
                    </ul>
                </div>
                @if(Sentry::check())
                    <div class="btn-box-row row-fluid">
                        <a href="#" class="btn-box big span12">
                            <span>Login as,</span><br/><br/>
                            <i class="icon-user"></i>
                            <b>{{ucwords(Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name)}}</b><br/>
                            <div id="jam">
                                <script language="javascript">
                                    function jam() {
                                        var waktu = new Date();
                                        var jam = waktu.getHours();
                                        var menit = waktu.getMinutes();
                                        var detik = waktu.getSeconds();

                                        var ampm = jam >= 12 ? 'PM' : 'AM';
                                        jam = jam % 12;
                                        jam = jam ? jam : 12; // the hour '0' should be '12'
                                        menit = menit < 10 ? +menit : menit;

                                        if (jam < 10) {
                                        jam = "0" + jam;
                                        }
                                        if (menit < 10) {
                                        menit = "0" + menit;
                                        }
                                        if (detik < 10) {
                                        detik = "0" + detik;
                                        }
                                        var jam_div = document.getElementById('jam');
                                        jam_div.innerHTML = jam + ":" + menit + ":" + detik + ' ' + ampm;
                                        setTimeout("jam()", 1000);
                                    }
                                    jam();
                                </script>
                            </div>
                        </a>
                    </div>
                @endif
                <!--/.sidebar-->
            </div>
            <!--/.span3-->
            @yield('content_menu')
        </div>
    </div>
    <!--/.container-->
</div>
<!--/.wrapper-->
@stop