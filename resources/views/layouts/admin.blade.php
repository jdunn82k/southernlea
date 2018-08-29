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
@include('nav.admin-nav')
@yield('content')

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