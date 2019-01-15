@extends('layouts.app')

@section('content')
    <div class="arriv">
        <div class="container">
            <div class="arriv-top" style="margin-left: 40px"	 >
                <div class="row">
                    <div class="col-md-5 pull-left">
                        <img src="{{URL::to('img/fall.jpg')}}" class="img-responsive" alt="">
                        <div class="arriv-info">
                            <h3>Apparel</h3>
                            <p></p>
                            <div class="crt-btn">
                                <a href="#" class="navigation-link" data-link-id="1">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  pull-right" style="margin-left: 50px">
                        <img src="{{URL::to('img/slcustom.JPG')}}" class="img-responsive" alt="">
                        <div class="arriv-info-custom-2 text-center  full-width">
                            <p class="text-black">T-Shirts, Decals and More...</p>
                            <div class="crt-btn">
                                <a href="#" class="navigation-link text-black crt-color" data-link-id="2">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="arriv-las">
                <div class="row">
                    <div class="col-md-4 pull-left" style="margin-left: 40px" >
                        <img src="{{URL::to('img/senegence.jpg')}}" width="400px"  class="img-responsive" alt="">
                        <div class="arriv-info3">
                            <h3></h3>
                            <div class="crt-btn">
                                <a href="http://www.hempworx.com/southernlea" target="_blank" class="crt-color">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 arriv-middle" style="margin-left: -25px" >
                        <img src="{{URL::to('img/display.jpg')}}" width="300px"  class="img-responsive" alt="">
                        <div class="arriv-info3">
                            <h3>Accessories</h3>
                            <div class="crt-btn">
                                <a href="#" class="navigation-link" data-link-id="4">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right" style="margin-left: -75px" >
                        <img src="{{URL::to('img/SIC.jpg')}}" width="340px" class="img-responsive" alt="">
                        <div class="arriv-info3">
                            <h3>SIC CUPS</h3>
                            <div class="crt-btn">
                                <a href="#" class="navigation-link" data-link-id="8">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="special">
        <div class="container">
            <h3>Special Offers</h3>
            <div class="specia-top">
                <ul class="grid_2">
                    @foreach($specials as $special)
                        <li>
                            <a href="#">
                                <img src="@if (isset($specials_images[$special->id])){{URL::to($specials_images[$special->id])}}@else{{URL::to("img/No_Image_Available.jpg")}}@endif" class="img-responsive special-image" alt=""></a>
                            <div class="special-info-2 grid_1 simpleCart_shelfItem">
                                <h5>{{$special->description1}}</h5>
                                <div class="item_add"><span class="item_price"><h6>${{$special->price}}</h6></span></div>
                                <div class="item_add"><span class="item_price"><a href="{{URL::to("product/".$special->id)}}">add to cart</a></span></div>

                            </div>
                        </li>
                    @endforeach
                    <div class="clearfix"> </div>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="added-to-cart-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Product Added</h3>
                    <a href="{{URL::to('/cart')}}"><button type="button" class="btn btn-info text-white">Proceed To Checkout</button></a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="size-modal">
        <input type="hidden" id="special-id" value="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="hide" id="product-added">
                        <h3>Product Added</h3>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Ok</button>
                    </div>
                    <div id="product-size">
                        <div class="form-group">
                            <h4>Select A Size</h4>
                            <select class="form-control col-3 sizing-select" id="select-a-size">
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="2X">XXL</option>
                            </select>
                        </div>
                        <div class="button-group">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="button" class="btn btn-info text-white" id="special-proceed">Proceed To Checkout</button>
                            <button type="button" class="btn btn-primary" id="add-to-cart-special">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var navHome = document.getElementById('nav-home');
        navHome.classList.add('active');
    </script>
@endsection
