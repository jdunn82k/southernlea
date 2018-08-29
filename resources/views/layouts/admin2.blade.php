<!DOCTYPE HTML>
<html>
<head>
    <title>Southern Lea</title>

    <!-- Bootstrap CSS -->
    <link href="{{URL::to('css/app.css')}}" rel='stylesheet'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Southern Lea">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet'>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i" rel="stylesheet">
    <!-- start menu -->
    <link href="{{ URL::to('css/megamenu.css') }}" rel="stylesheet" media="all">

    <!-- Custom Theme files -->
    <link href="{{URL::to('css/style.css')}}" rel='stylesheet'>

</head>
<div class="top_bg sticky-top">
    <div class="container">
        <div class="header_top">
            <div class="top_right">
                <ul>
                    <li class="pull-left">Southern Lea Admin Area</li>
                </ul>
            </div>
            <div class="top_left">
                <p><span></span> <a href="{{URL::to('/admin/logout')}}">Logout</a></p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">

            <li>
                <a href="{{URL::to('/admin/dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{URL::to('/admin/products')}}">Products</a>
            </li>
            <li>
                <a href="{{URL::to('/admin/categories')}}">Categories</a>
            </li>
            <li>
                <a href="{{URL::to('/admin/users')}}">Users</a>
            </li>

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        @yield('content')
    </div>
    <!-- /#page-content-wrapper -->

</div>

@section('footer')
    <script src="{{URL::to('js/jquery.min.js')}}"></script>
    <script src="{{URL::to('js/app.js')}}"></script>
    <script src="{{URL::to('js/megamenu.js')}}"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <script src="{{URL::to('js/menu_jquery.js')}}"></script>
    <script src="{{URL::to('js/custom.js')}}"></script>
    <script>updateCart();</script>
    <script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
@show