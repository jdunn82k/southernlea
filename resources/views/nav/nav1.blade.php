<!-- header_top -->
<div class="top_bg">
    <div class="container">
        <div class="header_top">
            <div class="top_right">
                <ul>
                    <li><a href="#">help</a></li>|
                    <li><a href="{{URL::to('/contact')}}">Contact</a></li>|
                    <li><a href="#">Delivery information</a></li>
                </ul>
            </div>
            <div class="top_left">
                <h2><span></span> Call us : 972.974.7842</h2>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<!-- header -->
<div class="header_bg">
    <div class="container">
        <div class="header">
            <div class="head-t">
                <div class="logo">
                    <a href="{{URL::to('/')}}"><img src="{{URL::to('img/main-01.jpg')}}" width="300px" class="img-responsive" alt=""> </a>
                </div>
                <!-- start header_right -->
                <div class="header_right">
                    <div class="rgt-bottom">
                        {{--<div class="log">--}}
                            {{--<div class="login" >--}}
                                {{--<div id="loginContainer"><a href="#" id="loginButton"><span>Login</span></a>--}}
                                    {{--<div id="loginBox">--}}
                                        {{--<form id="loginForm">--}}
                                            {{--<fieldset id="body">--}}
                                                {{--<fieldset>--}}
                                                    {{--<label for="email">Email Address</label>--}}
                                                    {{--<input type="text" name="email" id="email">--}}
                                                {{--</fieldset>--}}
                                                {{--<fieldset>--}}
                                                    {{--<label for="password">Password</label>--}}
                                                    {{--<input type="password" name="password" id="password">--}}
                                                {{--</fieldset>--}}
                                                {{--<input type="submit" id="login" value="Sign in">--}}
                                                {{--<label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>--}}
                                            {{--</fieldset>--}}
                                            {{--<span><a href="#">Forgot your password?</a></span>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="reg">--}}
                            {{--<a href="register.html">REGISTER</a>--}}
                        {{--</div>--}}
                        <div class="cart box_1">
                            <a href="{{URL::to('/cart')}}">
                                <h3> <span class="simpleCart_total">$0.00</span> (<span id="simpleCart_quantity" class="simpleCart_quantity">0</span> items)<img src="{{URL::to('img/bag.png')}}" alt=""></h3>
                            </a>
                            <p><a href="javascript:;" class="simpleCart_empty">(empty cart)</a></p>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="create_btn">
                            <a href="{{URL::to('/cart')}}">CHECKOUT</a>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="search">
                        <form>
                            <input type="text" value="" placeholder="search...">
                            <input type="submit" value="">
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!-- start header menu -->
            <ul class="megamenu skyblue">
                <li class="active grid"><a class="color1" href="{{URL::to('/')}}">Home</a></li>
                <li class="grid"><a class="color2" href="#">new arrivals</a>
                    <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Clothing</h4>
                                    <ul>
                                        <li><a href="#">new arrivals</a></li>
                                        <li><a href="#">men</a></li>
                                        <li><a href="#">women</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">kids</a></li>
                                        <li><a href="#">brands</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>kids</h4>
                                    <ul>
                                        <li><a href="#">Pools&Tees</a></li>
                                        <li><a href="#">shirts</a></li>
                                        <li><a href="#">shorts</a></li>
                                        <li><a href="#">twinsets</a></li>
                                        <li><a href="#">kurts</a></li>
                                        <li><a href="#">jackets</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Bags</h4>
                                    <ul>
                                        <li><a href="#">Handbag</a></li>
                                        <li><a href="#">Slingbags</a></li>
                                        <li><a href="#">Clutches</a></li>
                                        <li><a href="#">Totes</a></li>
                                        <li><a href="#">Wallets</a></li>
                                        <li><a href="#">Laptopbags</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>account</h4>
                                    <ul>
                                        <li><a href="#">login</a></li>
                                        <li><a href="register.html">create an account</a></li>
                                        <li><a href="#">create wishlist</a></li>
                                        <li><a href="#">my shopping bag</a></li>
                                        <li><a href="#">brands</a></li>
                                        <li><a href="#">create wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Accessories</h4>
                                    <ul>
                                        <li><a href="#">Belts</a></li>
                                        <li><a href="#">Pens</a></li>
                                        <li><a href="#">Eyeglasses</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">Watches</a></li>
                                        <li><a href="#">Jewellery</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Footwear</h4>
                                    <ul>
                                        <li><a href="#">new arrivals</a></li>
                                        <li><a href="#">men</a></li>
                                        <li><a href="#">women</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">kids</a></li>
                                        <li><a href="#">style videos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>
                <li><a class="color4" href="#">APPAREL</a>
                    <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Clothing</h4>
                                    <ul>
                                        <li><a href="#">new arrivals</a></li>
                                        <li><a href="#">men</a></li>
                                        <li><a href="#">women</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">kids</a></li>
                                        <li><a href="#">brands</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>kids</h4>
                                    <ul>
                                        <li><a href="#">Pools&Tees</a></li>
                                        <li><a href="#">shirts</a></li>
                                        <li><a href="#">shorts</a></li>
                                        <li><a href="#">twinsets</a></li>
                                        <li><a href="#">kurts</a></li>
                                        <li><a href="#">jackets</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Bags</h4>
                                    <ul>
                                        <li><a href="#">Handbag</a></li>
                                        <li><a href="#">Slingbags</a></li>
                                        <li><a href="#">Clutches</a></li>
                                        <li><a href="#">Totes</a></li>
                                        <li><a href="#">Wallets</a></li>
                                        <li><a href="#">Laptopbags</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>account</h4>
                                    <ul>
                                        <li><a href="#">login</a></li>
                                        <li><a href="register.html">create an account</a></li>
                                        <li><a href="#">create wishlist</a></li>
                                        <li><a href="#">my shopping bag</a></li>
                                        <li><a href="#">brands</a></li>
                                        <li><a href="#">create wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Accessories</h4>
                                    <ul>
                                        <li><a href="#">Belts</a></li>
                                        <li><a href="#">Pens</a></li>
                                        <li><a href="#">Eyeglasses</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">Watches</a></li>
                                        <li><a href="#">Jewellery</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Footwear</h4>
                                    <ul>
                                        <li><a href="#">new arrivals</a></li>
                                        <li><a href="#">men</a></li>
                                        <li><a href="#">women</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">kids</a></li>
                                        <li><a href="#">style videos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>
                <li><a class="color5" href="#">CUSTOM</a>
                    <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>T-Shirts</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Men</a></li>
                                        <li><a href="#">Women</a></li>
                                        <li><a href="#">Children</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Bath</h4>
                                    <ul>
                                        <li><a href="#">Bath Bombs</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Air Fresheners</h4>
                                    <ul>
                                        <li><a href="#">Aroma Beads</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Decals</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Window</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="col1">
                                <div class="h_nav">
                                    <h4>Accessories</h4>
                                    <ul>
                                        <li><a href="#">Belts</a></li>
                                        <li><a href="#">Pens</a></li>
                                        <li><a href="#">Eyeglasses</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">Watches</a></li>
                                        <li><a href="#">Jewellery</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Footwear</h4>
                                    <ul>
                                        <li><a href="#">new arrivals</a></li>
                                        <li><a href="#">men</a></li>
                                        <li><a href="#">women</a></li>
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">kids</a></li>
                                        <li><a href="#">style videos</a></li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>
                <li><a class="color6" href="#">MAKEUP</a>
                    <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Lips</h4>
                                    <ul>
                                        <li><a href="#">Specialty Glosses</a></li>
                                        <li><a href="#">Lipsense</a></li>
                                        <li><a href="#">Lipsense Collections</a></li>
                                        <li><a href="#">Gloss</a></li>
                                        <li><a href="#">Lip Care</a></li>
                                        <li><a href="#">Diamond LipSense</a></li>
                                        <li><a href="#">LipSense Collegiate Colors</a></li>
                                        <li><a href="#">LinerSense</a></li>
                                        <li><a href="#">Ooops! Remover</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Eyes</h4>
                                    <ul>
                                        <li><a href="#">EyeSense</a></li>
                                        <li><a href="#">LashSense</a></li>
                                        <li><a href="#">BrowSense</a></li>
                                        <li><a href="#">ShadowSense</a></li>
                                        <li><a href="#">Fooops! Remover</a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Treatment</h4>
                                    <ul>
                                        <li><a href="#">SeneDerm Solutions</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Face</h4>
                                    <ul>
                                        <li><a href="#">Advance Anti-Aging Foundations</a></li>
                                        <li><a href="#">MakeSense Hydration Foundation</a></li>
                                        <li><a href="#">Foundation</a></li>
                                        <li><a href="#">Blush</a></li>
                                        <li><a href="#">Blender / Concealer</a></li>
                                        <li><a href="#">Powders</a></li>
                                        <li><a href="#">Fooops! Remover</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Skin</h4>
                                    <ul>
                                        <li><a href="#">Collagen Night Pak</a></li>
                                        <li><a href="#">SeneSerum-C</a></li>
                                        <li><a href="#">SeneDerm SkinCare</a></li>
                                        <li><a href="#">Climate Control</a></li>
                                        <li><a href="#">Facial Serum</a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Body</h4>
                                    <ul>
                                        <li><a href="#">Senederm Body Care</a></li>
                                        <li><a href="#">Boutique</a></li>
                                        <li><a href="#">Spa</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>

                <li><a class="color7" href="#">JEWELRY</a>
                    <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>New Releases</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Bracelets</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Uniquely Urban</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Earrings</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Hoop</a></li>
                                        <li><a href="#">Clip-On</a></li>
                                        <li><a href="#">Post</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Rings</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Necklaces</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Lanyards</a></li>
                                        <li><a href="#">Uniquely Urban</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Paparazzi Collections</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Magnificent Musings</a></li>
                                        <li><a href="#">Simply Santa Fe</a></li>
                                        <li><a href="#">Fiercely 5th Avenue</a></li>
                                        <li><a href="#">Glimpses of Malibu</a></li>
                                        <li><a href="#">Sunset Signtings</a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Blockbusters</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Necklaces</a></li>
                                        <li><a href="#">Bracelets</a></li>
                                        <li><a href="#">Earrings</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Zi Collection</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Signature Series</a></li>
                                        <li><a href="#">Launch Pack</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Hair Accessories</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Hair Clips</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>

                <li><a class="color8" href="#">SIC CUPS</a>
                    <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Tumblers</h4>
                                    <ul>
                                        <li><a href="#">12oz</a></li>
                                        <li><a href="#">20oz</a></li>
                                        <li><a href="#">30oz</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Stemless</h4>
                                    <ul>
                                        <li><a href="#">16oz</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Wine Bottles</h4>
                                    <ul>
                                        <li><a href="#">25oz</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Bottles</h4>
                                    <ul>
                                        <li><a href="#">12oz Lil SIC</a></li>
                                        <li><a href="#">27oz</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Cocktail Shakers</h4>
                                    <ul>
                                        <li><a href="#">30oz</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Accessories</h4>
                                    <ul>
                                        <li><a href="#">Sport Lids</a></li>
                                        <li><a href="#">Splashproof Lids</a></li>
                                        <li><a href="#">Shaker Lid</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>
                <li><a class="color9" href="#">CLEARANCE</a>
                    <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Apparel</h4>
                                    <ul>
                                        <li><a href="#">All</a></li>
                                        <li><a href="#">Women</a></li>
                                        <li><a href="#">Men</a></li>
                                        <li><a href="#">Children</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Custom</h4>
                                    <ul>
                                        <li><a href="#">Decals</a></li>
                                        <li><a href="#">Bath Bombs</a></li>
                                        <li><a href="#">Air Fresheners</a></li>
                                        <li><a href="#">T-Shirts</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4>Makeup</h4>
                                    <ul>
                                        <li><a href="#">LipSense</a></li>
                                        <li><a href="#">Gloss</a></li>
                                        <li><a href="#">ShadowSense</a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4></h4>
                                    <ul>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4></h4>
                                    <ul>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"> </a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <h4></h4>
                                    <ul>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>