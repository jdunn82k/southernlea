<!DOCTYPE HTML>
<html>
<head>
    <title>Southern Lea | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!-- dataTables CSS -->
    <link href="{{URL::to('admin_files/vendor/DataTables-1.10.18/css/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::to('admin_files/vendor/DataTables-1.10.18/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{URL::to('admin_files/vendor/Buttons-1.5.2/css/buttons.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::to('admin_files/vendor/Buttons-1.5.2/css/buttons.bootstrap.css')}}" rel="stylesheet">
    <link href="{{URL::to('admin_files/vendor/Select-1.2.6/css/select.dataTables.css')}}" rel="stylesheet">
    <link href="{{URL::to('admin_files/vendor/Select-1.2.6/css/select.bootstrap.css')}}" rel="stylesheet">


    <link href="{{URL::to('admin_files/css/custom.css')}}" rel="stylesheet">

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <!--//webfonts-->

    <script src="{{URL::to('admin_files/js/jquery-1.11.1.min.js')}}"></script>

</head>
@include('nav.admin-nav')
@yield('content')

@section('footer')
    <div class="footer">
        <p>&copy; 2018 Southern Lea. All Rights Reserved
    </div>
    <!-- js-->
    <script src="{{URL::to('admin_files/js/modernizr.custom.js')}}"></script>
    <!-- Metis Menu -->
    <script src="{{URL::to('admin_files/js/metisMenu.min.js')}}"></script>
    <!--//Metis Menu -->
    <!-- side nav js -->
    <script src='{{URL::to('admin_files/js/SidebarNav.min.js')}}'></script>
    <script>
        $('.sidebar-menu').SidebarNav()
    </script>
    <!-- //side nav js -->

    <!-- Classie --><!-- for toggle left push menu script -->
    <script src="{{URL::to('admin_files/js/classie.js')}}"></script>
    <script>
        var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
            showLeftPush = document.getElementById( 'showLeftPush' ),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle( this, 'active' );
            classie.toggle( body, 'cbp-spmenu-push-toright' );
            classie.toggle( menuLeft, 'cbp-spmenu-open' );
            disableOther( 'showLeftPush' );
        };

        function disableOther( button ) {
            if( button !== 'showLeftPush' ) {
                classie.toggle( showLeftPush, 'disabled' );
            }
        }
    </script>
    <!-- //Classie --><!-- //for toggle left push menu script -->

    <!--scrolling js-->
    <script src="{{URL::to('admin_files/js/jquery.nicescroll.js')}}"></script>
    <script src="{{URL::to('admin_files/js/scripts.js')}}"></script>
    <!--//scrolling js-->

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::to('admin_files/js/bootstrap.js')}}"> </script>
    <!-- //Bootstrap Core JavaScript -->

    <!-- dataTables JS -->
    <script src="{{URL::to('admin_files/vendor/DataTables-1.10.18/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::to('admin_files/vendor/DataTables-1.10.18/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{URL::to('admin_files/vendor/Buttons-1.5.2/js/dataTables.buttons.js')}}"></script>
    <script src="{{URL::to('admin_files/vendor/Buttons-1.5.2/js/buttons.bootstrap.js')}}"></script>
    <script src="{{URL::to('admin_files/vendor/Select-1.2.6/js/dataTables.select.js')}}"></script>
    <script src="{{URL::to('admin_files/vendor/Select-1.2.6/js/select.bootstrap.js')}}"></script>


    <!-- Custom JS -->
    <script src="{{URL::to('admin_files/js/custom.js')}}"></script>

    <script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

@show