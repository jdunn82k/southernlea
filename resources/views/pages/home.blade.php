@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 clearfix mt-3 product-count">
            <div class="product-num float-left">
                Product (Total Items: <span id="product-count">0</span>)
            </div>
            <div class="float-right">
                <div class="form-check form-check-inline clearfix mr-0 mb-2 mt-1">
                    <label for="sort-filter" class="sort-label">Sort By:</label>
                    <select class="form-control" id="sort-filter">
                        <option value="1">Price: Low to High</option>
                        <option value="2">Price: High To Low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12 clearfix">
            <div class="float-right pagination1">
                <ul class="pagination ">
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">


        <div class="col-md-3 s-d">
            <div class="w_sidebar">
                {{--<section class="sky-form">--}}
                    {{--<h4>color</h4>--}}
                    {{--<ul class="w_nav2">--}}

                        {{--@foreach($colors as $color)--}}
                            {{--<li><div class="color-block" data-id="{{$color->id}}" style="background-color: {{$color->hex}}"></div></li>--}}
                        {{--@endforeach--}}

                    {{--</ul>--}}
                {{--</section>--}}
                <section class="sky-form">
                    <h4>Price</h4>
                    <div class="row1 scroll-pane">
                        <div class="col">
                            <label class="radio"><input type="radio" name="price_range" value="20+"><i></i>$20+</label>
                            <label class="radio"><input type="radio" name="price_range" value="20"><i></i>$10 - $19.99</label>
                            <label class="radio"><input type="radio" name="price_range" value="10"><i></i>Up To $9.99</label>
                            <label class="radio"><input type="radio" name="price_range" value="0" checked><i></i>Any</label>
                        </div>
                    </div>
                </section>
            </div>
        </div>

            <div class="col w_content">
                <div class="col-md-12 clearfix">
                    <div class="float-right pagination2">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
                <input type="hidden" id="link_page" value="home">
                <input type="hidden" id="page" value="1">
                <input type="hidden" id="category" value="{{ $category }}">
                <input type="hidden" id="subcategory" value="{{ $subcategory }}">
                <input type="hidden" id="subcat2" value="{{$subcat2}}">
                <div class="d-flex flex-row flex-wrap justify-content-start mb-3 p-2" id="product-listings"></div>
            </div>
         </div>
    </div>


    <div class="container mb-5">
        <div class="col-md-12 clearfix">
            <div class="float-right">
                <ul class="pagination">
                </ul>
            </div>
        </div>
    </div>



@endsection
