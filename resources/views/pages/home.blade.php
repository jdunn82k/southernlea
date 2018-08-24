@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 clearfix mt-3">
            <div class="product-num float-left">
                Product (Total Items: 32434)
            </div>
            <div class="float-right">
                <div class="form-check form-check-inline clearfix mr-0 mb-2 mt-1">
                    <label for="sort-filter" class="sort-label">Sort By:</label>
                    <select class="form-control" id="sort-filter">
                        <option value="price_low_high">Price: Low to High</option>
                        <option value="price_high_low">Price: High To Low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12 clearfix">
            <div class="float-right">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous Page</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next Page</a></li>
                    <li class="page-item"><a class="page-link" href="#">View All</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container product-listing">
        <div class="row">
            <div class="col-md-3 sidebar-offset">
                <div class="sidebar-item">
                    <div class="panel">
                        <div class="panel-header">
                            COLOR
                        </div>
                        <div class="panel-body">
                            <div class="d-flex flex-row flex-wrap justify-content-start mb-3 p-2">
                            @foreach($colors as $color)
                                    <div class="color-block" data-id="{{$color->id}}" style="background-color: {{$color->hex}}"></div>
                            @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="sidebar-item">
                    <div class="panel">
                        <div class="panel-header">
                            DISCOUNT
                        </div>
                        <div class="panel-body">
                            <ul class="discount-list">
                                <li>
                                    <div>
                                        <input type="radio" name="discount">
                                        60% and below
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <input type="radio" name="discount">
                                        50% and below
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <input type="radio" name="discount">
                                        40% and below
                                    </div>
                                </li>
                                <li>
                                   <div>
                                       <input type="radio" name="discount">
                                       30% and below
                                   </div>
                                </li>
                                <li>
                                    <div>
                                        <input type="radio" name="discount">
                                        20% and below
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <input type="radio" name="discount">
                                        10% and below
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-row flex-wrap justify-content-start mb-3 p-2" id="product-listings">
                    {{--<div class="product-block">--}}
                        {{--<a href="details.html"><img src="img/Picture2.png" class="img-responsive product-image" alt=""></a>--}}
                        {{--<div class="special-info grid_1 simpleCart_shelfItem">--}}
                            {{--<h5 class="product-description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>ONLY $40.00</h6></span></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="product-block">--}}
                        {{--<a href="details.html"><img src="img/Picture2.png" class="img-responsive product-image" alt=""></a>--}}
                        {{--<div class="special-info grid_1 simpleCart_shelfItem">--}}
                            {{--<h5 class="product-description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>ONLY $40.00</h6></span></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="product-block">--}}
                        {{--<a href="details.html"><img src="img/Picture2.png" class="img-responsive product-image" alt=""></a>--}}
                        {{--<div class="special-info grid_1 simpleCart_shelfItem">--}}
                            {{--<h5 class="product-description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>ONLY $40.00</h6></span></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="product-block">--}}
                        {{--<a href="details.html"><img src="img/Picture2.png" class="img-responsive product-image" alt=""></a>--}}
                        {{--<div class="special-info grid_1 simpleCart_shelfItem">--}}
                            {{--<h5 class="product-description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>ONLY $40.00</h6></span></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="product-block">--}}
                        {{--<a href="details.html"><img src="img/Picture2.png" class="img-responsive product-image" alt=""></a>--}}
                        {{--<div class="special-info grid_1 simpleCart_shelfItem">--}}
                            {{--<h5 class="product-description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</h5>--}}
                            {{--<div class="item_add"><span class="item_price"><h6>ONLY $40.00</h6></span></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

            </div>
         </div>
    </div>

    <div class="container">
        <div class="col-md-12 clearfix">
            <div class="float-right">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous Page</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next Page</a></li>
                    <li class="page-item"><a class="page-link" href="#">View All</a></li>
                </ul>
            </div>
        </div>
    </div>


@endsection
