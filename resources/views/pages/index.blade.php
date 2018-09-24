@extends('layouts.app')

@section('content')
    <div class="special">
        <div class="container">
            <h3>Special Offers</h3>
            <div class="specia-top">
                <ul class="grid_2">
                    @foreach($specials as $special)
                        <li>
                            <a href="#">
                                <img src="@if ($special->image){{URL::to($special->image)}}@else{{URL::to("img/No_Image_Available.jpg")}}@endif" class="img-responsive special-image" alt=""></a>
                            <div class="special-info-2 grid_1 simpleCart_shelfItem">
                                <h5>{{$special->name}}</h5>
                                <div class="item_add"><span class="item_price"><h6>${{$special->price}}</h6></span></div>
                                @if ($special->size === 1)
                                    <div class="item_add"><span class="item_price"><a href="#" class="show-size-modal" data-special-id="{{$special->id}}">add to cart</a></span></div>
                                @else
                                    <div class="item_add"><span class="item_price"><a href="#" class="show-confirm-modal" data-special-id="{{$special->id}}">add to cart</a></span></div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    {{--<li>--}}
                        {{--<a href="#"><img src="{{URL::to('img/LOVE Firefighter front.PNG')}}" class="img-responsive special-image" alt=""></a>--}}
                        {{--<div class="special-info-2 grid_1 simpleCart_shelfItem">--}}
                            {{--<h5>LOVE Firefighter Tank</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>$18.00</h6></span></div>--}}
                            {{--<div class="item_add"><span class="item_price"><a href="#">add to cart</a></span></div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#"><img src="{{URL::to('img/Hanging with the Heifers.PNG')}}" class="img-responsive special-image" alt=""></a>--}}
                        {{--<div class="special-info-2 grid_1 simpleCart_shelfItem">--}}
                            {{--<h5>Hanging with the Heifers Tank</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>$18.00</h6></span></div>--}}
                            {{--<div class="item_add"><span class="item_price"><a href="#">add to cart</a></span></div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#"><img src="{{URL::to('img/No_Image_Available.jpg')}}" class="img-responsive special-image" alt=""></a>--}}
                        {{--<div class="special-info-2 grid_1 simpleCart_shelfItem">--}}
                            {{--<h5>Mauve Ice LipSense</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>$22.00</h6></span></div>--}}
                            {{--<div class="item_add"><span class="item_price"><a href="#">add to cart</a></span></div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#"><img src="{{URL::to('img/No_Image_Available.jpg')}}" class="img-responsive special-image" alt=""></a>--}}
                        {{--<div class="special-info-2 grid_1 simpleCart_shelfItem">--}}
                            {{--<h5>Blu-Red LipSense</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>$22.00</h6></span></div>--}}
                            {{--<div class="item_add"><span class="item_price"><a href="#">add to cart</a></span></div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
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

@endsection