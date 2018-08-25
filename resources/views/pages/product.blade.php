@extends('layouts.app')

@section('content')
    <div class="container">
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
                <p><span class="font-weight-bold">PRODUCT CODE: </span><span class="highlight">{{$product->code}}</span></p>
                <div class="clearfix">
                    @if ($product->quantityInStock > 0)
                        <p class="float-left">Availability: <span class="text-green">In stock</span></p>
                    @else
                        <p class="float-left">Availability: <span class="text-red">Out Of Stock</span></p>
                    @endif

                    <p class="float-right">Only <span class="font-weight-bold">{{$product->quantityInStock}}</span> Left</p>
                </div>
                <p class="mt-5 font-weight-bold">{{$product->description1}}</p>
            </div>
        </div>
    </div>
@endsection