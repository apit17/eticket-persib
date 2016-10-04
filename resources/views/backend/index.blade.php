@extends('backend.layout.layout')

@section('content')
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href=""><font color="#AC124C" size="6">Kissproof ID</font></a>
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
                        <li id="dashboard-menu"><a href="{{URL::to('admin/dashboard')}}"><i class="menu-icon icon-dashboard"></i>Dashboard
                        </a></li>

                        <li><a class="collapsed" data-toggle="collapse" href="#masterMenu"><i class="menu-icon icon-table">
                        </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                        </i>Master Data </a>
                            <ul id="masterMenu" class="collapse unstyled">
                                <li id="product-menu"><a href="#"><i class="menu-icon icon-book"></i>Products </a></li>
                            </ul>
                        </li>

                        <li><a class="collapsed" data-toggle="collapse" href="#transactionMenu"><i class="menu-icon icon-shopping-cart">
                        </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                        </i>Transaction </a>
                            <ul id="transactionMenu" class="collapse unstyled">
                                <li id="stock-menu"><a href="#"><i class="menu-icon icon-plus"></i>Stock</a></li>
                                <li id="sell-menu"><a href="#"><i class="menu-icon icon-minus"></i>Sell </a></li>
                            </ul>
                        </li>

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