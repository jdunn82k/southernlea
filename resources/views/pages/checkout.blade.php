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
                                <h3><a href="{{URL::to("/product/".$cartItem->id)}}">{{$cartItem->name}} - {{$cartItem->options->desc}}</a></h3>
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
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">

                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="herschelgomez@xyzzyu.com">

                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">

                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" value="Hot Sauce-12oz. Bottle">
                    <input type="hidden" name="amount" value="5.95">
                    <input type="hidden" name="currency_code" value="USD">

                    <!-- Display the payment button. -->
                    <input type="image" name="submit" border="0"
                           src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                           alt="Buy Now">
                    <img alt="" border="0" width="1" height="1"
                         src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

                </form>

            </div>

            <div class="clearfix"> </div>
        @endif
    </div>
</div>
@endsection