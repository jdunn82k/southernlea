@extends('layouts.admin2')

@section('content')
    <div class="container font-calibri">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <h3>Products</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
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
                                <td>{{$product->discount}}%</td>
                                <td>{{$product->quantityInStock}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection