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
@include('nav.nav1')
@yield('content')

@section('footer')
    <div class="foot-top">
        <div class="container">
            <div class="col-md-6 s-c">
                <li>
                    <div class="fooll">
                        <h5>follow us on</h5>
                    </div>
                </li>
                <li>
                    <div class="social-ic">
                        <ul>
                            <li><a href="#"><i class="facebok"> </i></a></li>
                            <li><a href="#"><i class="twiter"> </i></a></li>
                            <li><a href="#"><i class="goog"> </i></a></li>
                            <li><a href="#"><i class="be"> </i></a></li>
                            <li><a href="#"><i class="pp"> </i></a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </li>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-6 s-c">
                <div class="stay">
                    <div class="stay-left">
                        <form>
                            <input type="text" placeholder="Enter your email to join our newsletter" required="">
                        </form>
                    </div>
                    <div class="btn-1">
                        <form>
                            <input type="submit" value="join">
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 cust">
                    <h4>CUSTOMER CARE</h4>

                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="buy.html">How To Buy</a></li>
                        <li><a href="#">Delivery</a></li>

                </div>
                <div class="col-md-2 abt">
                    <h4>ABOUT US</h4>

                        <li><a href="#">Our Stories</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="contact.html">Contact</a></li>


                </div>
                <div class="col-md-2 myac">
                    <h4>MY ACCOUNT</h4>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="#">My Cart</a></li>
                    <li><a href="#">Order History</a></li>
                    <li><a href="buy.html">Payment</a></li>
                </div>
                <div class="col-md-5 our-st">
                    <div class="our-left">
                        <h4>OUR STORE</h4>
                    </div>
                    <div class="clearfix"> </div>
                    <li><i class="add"> </i>Royse City, Texas</li>
                    <li><i class="phone"> </i>972-974-7842</li>
                    <li><a href="mailto:jamie@southernlea.com"><i class="mail"> </i>jamie@southernlea.com </a></li>

                </div>
            </div>

            <div class="clearfix"> </div>
            <p>Copyrights © 2018 Southern Lea | All rights reserved</p>
        </div>
    </div>
    <script src="{{URL::to('js/jquery.min.js')}}"></script>
    <script src="{{URL::to('js/app.js')}}"></script>
    <script src="{{URL::to('js/megamenu.js')}}"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <script src="{{URL::to('js/menu_jquery.js')}}"></script>
    <script src="{{URL::to('js/simpleCart.min.js')}}"> </script>
    <script src="{{URL::to('js/custom.js')}}"></script>
    <script>updateCart();</script>
    <script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
@show