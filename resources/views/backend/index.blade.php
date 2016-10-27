@extends('backend.layout.layout')

@section('content')
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href=""><font color="#AC124C" size="6"><img src="{!! asset('asset/images/lipstik.png') !!}" width="120" height="120"> Kissproof ID</font></a>
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
                        <li id="dashboard-menu"><a href="{{URL::to('admin/dashboard')}}"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>

                        <li id="product-menu"><a href="{{URL::to('admin/product')}}"><i class="menu-icon icon-book"></i>Products</a></li>

                        <li id="customer-menu"><a href="{{URL::to('admin/customer')}}"><i class="menu-icon icon-user"></i>Customers</a></li>

                        <li><a class="collapsed" data-toggle="collapse" href="#transactionMenu"><i class="menu-icon icon-shopping-cart">
                        </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                        </i>Transactions</a>
                            <ul id="transactionMenu" class="collapse unstyled">
                                <li id="procurement-menu"><a href="{{URL::to('admin/procurement')}}"><i class="menu-icon icon-arrow-left"></i>Procurements</a></li>
                                <li id="sale-menu"><a href="{{URL::to('admin/sale')}}"><i class="menu-icon icon-arrow-right"></i>Sales </a></li>
                            </ul>
                        </li>

                        <li id="statistic-menu"><a href="#"><i class="menu-icon icon-bar-chart"></i>Statistics</a></li>

                        <li id="setting-menu"><a href="{{URL::to('admin/setting')}}"><i class="menu-icon icon-cog"></i>Settings</a></li>

                        <li><a href="{{URL::to('admin/logout')}}"><i class="menu-icon icon-signout"></i>Logout </a></li>
                    </ul>
                </div>
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