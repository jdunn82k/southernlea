@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-sm-2">
                @foreach($images as $image)
                    <div class="preview-photo">
                        <img src="{{URL::to($image->url)}}" alt="">
                    </div>
                @endforeach
            </div>
            <div class="col-md-6 col-lg-6 col-sm-4">
                @foreach($images as $image)
                    @if ($image->default)
                        <div class="main-photo">
                            <img src="{{URL::to($image->url)}}" alt="">
                        </div>
                    @endif

                @endforeach
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <p><span class="font-weight-bold font-size-13">PRODUCT CODE: </span><span class="highlight">{{$product->code}}</span></p>
                <div class="clearfix">
                    @if ($product->quantityInStock > 0)
                        <p class="float-left font-size-13">Availability: <span class="text-green">In stock</span></p>
                    @else
                        <p class="float-left font-size-13">Availability: <span class="text-red">Out Of Stock</span></p>
                    @endif

                    <p class="float-right font-size-13">Only <span class="font-weight-bold">{{$product->quantityInStock}}</span> Left</p>
                </div>
                <p class="mt-5 font-weight-bold">{{$product->description1}}</p>
                <p class="mt-5 price-color clearfix">
                    @if ($product->discount > 0)
                        <span class="strikeout-line"></span><span class="strikeout">${{$product->price}}</span><br><span>${{ number_format( ($product->price - ($product->price * ($product->discount / 100)) ),2) }}</span><span class="discount-text float-right mt-2">* You save {{$product->discount}}%!</span>
                    @else
                        {{$product->price}}
                    @endif
                </p>
                <hr>
                <div class="size-picker">
                    <div class="size-picker-top clearfix">
                        <p class="float-left">SIZE*</p>
                        <p class="float-right">* Required Fields</p>
                    </div>
                    <div class="size-picker-item">
                        <input type="radio" name="size-picker-radio" value="small" checked> S
                    </div>
                    <div class="size-picker-item">
                        <input type="radio" name="size-picker-radio" value="medium"> M
                    </div>
                    <div class="size-picker-item">
                        <input type="radio" name="size-picker-radio" value="large"> L
                    </div>
                    <div class="size-picker-item">
                        <input type="radio" name="size-picker-radio" value="1x"> XL
                    </div>
                    <div class="size-picker-item">
                        <input type="radio" name="size-picker-radio" value="2x"> XXL
                    </div>
                    <div class="size-picker-item">
                        <input type="radio" name="size-picker-radio" value="3x"> XXXL
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <div class="quantity-picker">
                            QTY: <input type="number" id="quantity" value="1" max="99">
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-9 clearfix text-center">
                        <div class="mx-auto">
                            <button class="add_to_cart" id="add_to_cart" data-product-id="{{$product->id}}">add to cart</button><br>
                            -OR-<br>
                            <button type="button">Paypal</button><br>
                            -OR-<br>
                            <button type="button">Paypal Credit</button><br>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection