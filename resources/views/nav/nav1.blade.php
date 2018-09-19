<!-- header_top -->
<div class="top_bg">
    <div class="container">
        <div class="header_top">
            <div class="top_right">
                <ul>
                    {{--<li><a href="#">help</a></li>|--}}
                    {{--<li><a href="{{URL::to('/contact')}}">Contact</a></li>|--}}
                    {{--<li><a href="#">Delivery information</a></li>--}}
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
                    {{--<div class="search">--}}
                        {{--<form>--}}
                            {{--<input type="text" value="" placeholder="search...">--}}
                            {{--<input type="submit" value="">--}}
                        {{--</form>--}}
                    {{--</div>--}}
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!-- start header menu -->
            <ul class="megamenu skyblue">
                <li class="active grid"><a class="color1" href="{{URL::to('/')}}">Home</a></li>

                @php
                    $categories = \App\Categories::all();
                    $subcategories = \App\SubCategories::all();
                    $categorylinks = \App\CategoryLinks::all();
                @endphp
                @foreach($categories as $category)
                    <li class="grid">
                        <a class="color2 navigation-link" data-link-id="{{$category->id}}" id="{{strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $category->name))}}" href="#">
                            {{$category->name}}
                        </a>
                        <div class="megapanel">
                            <div class="row">
                                @foreach($subcategories as $subcat)
                                    @if ($subcat->category_id === $category->id)
                                        <div class="col1">
                                            <div class="h_nav">
                                                <h4>{{$subcat->name}}</h4>
                                                <ul>
                                                    @foreach($categorylinks as $catlink)
                                                        @if($catlink->subcategory_id === $subcat->id)
                                                            <li><a class="navigation-link-2" data-link-id="{{$catlink->id}}" href="#">{{$catlink->name}}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<form id="page-nav" method="POST" action="/">
    <input type="hidden" name="category" value="0">
    <input type="hidden" name="subcategory" value="0">
</form>