@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row check">
        @if ($cartCount === 0)
            <div class="col-md-12 col-lg-12 col-sm-12">
                <h3 class="text-center">Shopping Cart Empty</h3>
            </div>
        @else
        <div class="col-md-9 cart-items">

                <h1>My Shopping Cart ({{$cartCount}})</h1>
                @foreach($cartContent as $cartItem)
                    @php
                        $productImage = \App\ProductImages::where('product_id', $cartItem->id)->where('default', 1)->get()[0];
                    @endphp
                    <div class="cart-header">
                        <div class="close1 remove-cart-item" data-row-id="{{$cartItem->rowId}}"> </div>
                        <div class="cart-sec simpleCart_shelfItem">
                            <div class="cart-item cyc">
                                <img src="{{URL::to($productImage->url)}}" class="img-responsive" alt=""/>
                            </div>
                            <div class="cart-item-info">
                                <h3><a href="{{URL::to("/product/".$cartItem->id)}}">{{$cartItem->name}}</a></h3>
                                <ul class="qty">
                                    <li><p>Size : {{ucwords($cartItem->options->size)}}</p></li>
                                    <li><p>Qty : {{$cartItem->qty}}</p></li>
                                </ul>

                                <div class="delivery">
                                    <span>Delivered in 2-3 business days</span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-md-3 cart-total">
                <div class="price-details">
                    <h3>Price Details</h3>
                    <span>SubTotal</span>
                    <span class="total1">${{$cartSubTotal}}</span>
                    <span>Sales Tax ({{$taxRate}}%)</span>
                    <span class="total1">{{$cartTax}}</span>
                    <span>Shipping</span>
                    <span class="total1">0.00</span>
                    <div class="clearfix"></div>
                </div>
                <ul class="total_price">
                    <li class="last_price"> <h4>TOTAL</h4></li>
                    <li class="last_price"><span>${{number_format($cartSubTotal + $cartTax, 2)}}</span></li>
                    <div class="clearfix"> </div>
                </ul>


                <div class="clearfix"></div>
                <a class="order" href="#">Place Order</a>

            </div>

            <div class="clearfix"> </div>
        @endif
    </div>
</div>
@endsection