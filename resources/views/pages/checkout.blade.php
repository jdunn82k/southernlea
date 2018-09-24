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
                        if (strpos($cartItem->id, "special") === false)
                        {
                            $productImage = \App\ProductImages::where('product_id', $cartItem->id)->where('default', 1)->get();
                            if (count($productImage) > 0)
                            {
                                $url = $productImage[0]->url;
                            } else {
                                $url = 'img/No_Image_Available.jpg';
                            }
                        }
                        else
                        {
                            $id = str_replace("special_", "", $cartItem->id);
                            $special = \App\Specials::find($id);
                            if ($special->image)
                            {
                                $url = $special->image;
                            }
                            else
                            {
                                $url = 'img/No_Image_Available.jpg';
                            }
                        }

                    @endphp
                    <div class="cart-header">
                        <div class="close1 remove-cart-item" data-row-id="{{$cartItem->rowId}}"> </div>
                        <div class="cart-sec simpleCart_shelfItem">
                            <div class="cart-item cyc">
                                <img src="{{URL::to($url)}}" class="shopping-cart-image" alt=""/>
                            </div>
                            <div class="cart-item-info">
                                <h3><a href="{{URL::to("/product/".$cartItem->id)}}">{{$cartItem->name}} - {{$cartItem->options->desc}}</a></h3>
                                <ul class="qty">
                                    @if ($cartItem->options->size)
                                        <li><p>Size : {{ucwords($cartItem->options->size)}}</p></li>
                                    @endif
                                    <li><p>Qty : {{$cartItem->qty}}</p></li>
                                </ul>
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
                    <span class="total1">{{$shippingRate}}</span>
                    <div class="clearfix"></div>
                </div>
                <ul class="total_price">
                    <li class="last_price"> <h4>TOTAL</h4></li>
                    <li class="last_price"><span>${{number_format( ($cartSubTotal + $cartTax + $shippingRate), 2)}}</span></li>
                    <div class="clearfix"> </div>
                </ul>


                <div class="clearfix"></div>
                <a href="{{URL::to('/checkout')}}"><button class="checkout pull-left">Checkout</button></a>

            </div>

            <div class="clearfix"> </div>
        @endif
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirm-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-body text-center">
                <p id="error-message" class="mb-10">Remove this cart item?</p>
                <button type="button" class="btn btn-primary" id="confirm-delete-button" data-row-id="">Yes</button>
            </div>
        </div>
    </div>
</div>
@endsection