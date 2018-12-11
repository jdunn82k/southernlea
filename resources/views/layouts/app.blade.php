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
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mate+SC" rel="stylesheet">
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
            <div class="row">
                <div class="col-md-6 col-md-6 s-c">
                   
                    <div class="clearfix"> </div>
                </div>
                </div>

                            <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://southernlea.us19.list-manage.com/subscribe/post?u=9988f80973051ae7477bb4e96&amp;id=bcca275441" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
    <label for="mce-EMAIL">Join Our Mailing List ! </label>
    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_9988f80973051ae7477bb4e96_bcca275441" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>
                        
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-2 our-st">
                        <h4>FOLLOW US</h4>
                     <div class="clearfix"> </div>
                    <li><a href="https://www.facebook.com/groups/469608456707538/"><i class="facebok"> </i></a></li>
                            <li><a href="https://www.instagram.com/southernleaboutique/"><i class="be"> </i></a></li>
                        </div>
                <div class="col-md-2 myac">
                    <h4>MY ACCOUNT</h4>
                    <li><a href="{{URL::to('/cart')}}">My Cart</a></li>
                        <div class="clearfix"> </div>
                </div>
                <div class="col-md-3 our-st">
                      <h4>OUR STORE</h4>
                     <div class="clearfix"> </div>
                    <li><i class="add"> </i>Royse City, Texas</li>
                    <li><i class="phone"> </i>972-974-7842</li>
                    <li><a href="mailto:jamie@southernlea.com"><i class="mail"> </i>jamie@southernlea.com </a></li>
               </div>
            </div>
            <div class="col-md-2">
                </div>

            <div class="clearfix"> </div>
            <p class="text-center">Copyrights © 2018 Southern Lea | All Rights Reserved</p>
        </div>
    </div>
    <script src="{{URL::to('js/jquery.min.js')}}"></script>
    <script src="{{URL::to('js/popper.min.js')}}"></script>
    <script src="{{URL::to('js/app.js')}}"></script>
    <script src="{{URL::to('js/megamenu.js')}}"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <script src="{{URL::to('js/menu_jquery.js')}}"></script>
    <script src="{{URL::to('js/custom.js')}}"></script>
    <script>updateCart();</script>
    <script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
@show