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
                        <div class="main-photo text-center">
                            @if ($product->category === 4 && $product->subcategory === 26 && $product->categorylink === 19)
                                <img src="{{URL::to("img/Picture1.png")}}" class="new-overlay-product" alt="">
                            @endif
                            <img src="{{URL::to($image->url)}}" class="profile-image" alt="">
                        </div>
                    @endif

                @endforeach
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="clearfix">
                    @if ($product->quantityInStock > 0)
                        <p class="float-left font-size-13" id="stock">Availability: <span class="text-green">In stock</span></p>
                    @else
                        <p class="float-left font-size-13" id="stock">Availability: <span class="text-red">Out Of Stock</span></p>
                    @endif

                    <p class="float-right font-size-13">Only <span class="font-weight-bold" id="quantity-in-stock">{{$product->quantityInStock}}</span> Left</p>
                </div>
                <h3 class="mt-5 font-weight-bold">{{$product->description1}}</h3>
                <h4 class="font-weight-bold">@if ($product->description2){{$product->description2}}@endif</h4>

                <p class="mt-2 mb-4 price-color clearfix">
                    <span class="your-price">Your Price</span>
                    @if ($product->discount > 0)
                        <span id="your-price">${{ number_format( ($product->price - ($product->price * ($product->discount / 100)) ),2) }}</span>
                    @else
                        <span id="your-price">${{$product->price}}</span>
                    @endif
                </p>
                <hr>
                @if (count($sizes) > 0)
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12">
                            <div class="size-picker">
                                Size: <select class="ml-1 form-control" id="size-select">
                                    @foreach($sizes as $size)
                                        @if ($size->default === 1)
                                            <option value="{{$size->id}}" selected>{{$size->size}}</option>
                                        @else
                                            <option value="{{$size->id}}">{{$size->size}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mt-4">
                    <div class="col-md-5 col-lg-5 col-sm-5">
                        <div class="quantity-picker">
                            Qty: <input type="number" class='form-control' id="quantity" value="1" max="99">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-7 clearfix text-center">
                        <div class="float-right">


                            @if (count($sizes) > 0)

                                <button class="add_to_cart" id="add_to_cart" data-product-id="{{$product->id}}" data-product-size="{{$sizes[0]->id}}">add to cart</button><br>

                            @else
                                <button class="add_to_cart" id="add_to_cart" data-product-id="{{$product->id}}" data-product-size="0">add to cart</button><br>
                            @endif


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
                            <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Description</a>
                            <a class="list-group-item list-group-item-action  active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Additional Information</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Reviews</a>
                        </div>
                    </div>
                    <div class="col-8 tab-div">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">{{$product->description2}}</div>
                            <div class="tab-pane fade  show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">@if($product->additional){{$product->additional}}@endif</div>
                            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                        </div>
                    </div>
                </div>

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
@endsection