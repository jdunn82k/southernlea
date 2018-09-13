@extends('layouts.admin2')

@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                {{--<h2 class="title1">Products</h2>--}}
                <div class="table-responsive bs-example widget-shadow">
                    <h4>Products</h4>
                    <table class="table table-bordered display" id="products-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Price</th>
                            {{--<th>Discount</th>--}}
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td></td>
                                <td><a href="{{URL::to('/admin/products/'.$product->id)}}">{{$product->description1}}</a></td>
                                <td>
                                    @foreach($categories as $cat)
                                        @if($cat->id === $product->category)
                                            {{$cat->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($categories as $cat)
                                        @if($cat->id === $product->category)
                                            @foreach($subcategories as $sub)
                                                @if($cat->id === $product->category && $sub->category_id === $product->subcategory)
                                                    {{$sub->name}}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td>${{$product->price}}</td>
                                {{--<td>{{$product->discount}}%</td>--}}
                                <td>{{$product->quantityInStock}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection