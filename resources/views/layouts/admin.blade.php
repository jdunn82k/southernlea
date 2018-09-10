<!DOCTYPE HTML>
<html>
<head>
    <title>Southern Lea | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::to('admin_files/css/bootstrap.css')}}" rel='stylesheet'>

    <!-- Custom CSS -->
    <link href="{{URL::to('admin_files/css/style.css')}}" rel='stylesheet'>

    <!-- font-awesome icons CSS -->
    <link href="{{URL::to('admin_files/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome icons CSS -->

    <!-- side nav css file -->
    <link href='{{URL::to('admin_files/css/SidebarNav.min.css')}}' media='all' rel='stylesheet'>
    <!-- side nav css file -->

    <link href="{{URL::to('admin_files/css/custom.css')}}" rel="stylesheet">

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <!--//webfonts-->

</head>
{{--@include('nav.admin-nav')--}}
@yield('content')

@section('footer')
    <div class="footer">
        <p>&copy; 2018 Southern Lea. All Rights Reserved
    </div>
    <!-- js-->
    <script src="{{URL::to('admin_files/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{URL::to('admin_files/js/modernizr.custom.js')}}"></script>
    <!-- Metis Menu -->
    <script src="{{URL::to('admin_files/js/metisMenu.min.js')}}"></script>
    <script src="{{URL::to('admin_files/js/custom.js')}}"></script>
    <!--//Metis Menu -->

    <script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

@show