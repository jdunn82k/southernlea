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
                <h3 class="mt-5 font-weight-bold">{{$product->description1}}</h3>
                <p class="mt-5 price-color clearfix">
                    @if ($product->discount > 0)
                        <span>${{ number_format( ($product->price - ($product->price * ($product->discount / 100)) ),2) }}</span>
                    @else
                        ${{$product->price}}
                    @endif
                </p>
                <hr>
                {{--<div class="size-picker">--}}
                    {{--<div class="size-picker-top clearfix">--}}
                        {{--<p class="float-left">SIZE <span class="text-red">*</span></p>--}}
                        {{--<p class="float-right text-red">* Required Fields</p>--}}
                    {{--</div>--}}
                    {{--<div class="size-picker-item">--}}
                        {{--<input type="radio" name="size-picker-radio" value="small" checked> S--}}
                    {{--</div>--}}
                    {{--<div class="size-picker-item">--}}
                        {{--<input type="radio" name="size-picker-radio" value="medium"> M--}}
                    {{--</div>--}}
                    {{--<div class="size-picker-item">--}}
                        {{--<input type="radio" name="size-picker-radio" value="large"> L--}}
                    {{--</div>--}}
                    {{--<div class="size-picker-item">--}}
                        {{--<input type="radio" name="size-picker-radio" value="1x"> XL--}}
                    {{--</div>--}}
                    {{--<div class="size-picker-item">--}}
                        {{--<input type="radio" name="size-picker-radio" value="2x"> XXL--}}
                    {{--</div>--}}
                    {{--<div class="size-picker-item">--}}
                        {{--<input type="radio" name="size-picker-radio" value="3x"> XXXL--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="row mt-4">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <div class="quantity-picker">
                            QTY: <input type="number" id="quantity" value="1" max="99">
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-9 clearfix text-center ">
                        <div class="float-right">
                            <button class="add_to_cart" id="add_to_cart" data-product-id="{{$product->id}}">add to cart</button><br>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-md-10 col-lg-10 col-sm-12 mx-auto">

                <div class="row">
                    <div class="col-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Description</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Additional Information</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Reviews</a>
                        </div>
                    </div>
                    <div class="col-8 tab-div">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">{{$product->description2}}</div>
                            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
                            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection