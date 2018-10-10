@extends('layouts.admin2')

@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                {{--<h2 class="title1">Products</h2>--}}
                <div class="table-responsive bs-example widget-shadow">
                    <h4 class="pull-left">Products</h4>
                    <div class="button-group">
                        <div class="flex pull-right">
                            <a class="btn btn-primary mr-10" href="{{URL::to('/admin/product/new')}}">Add Product</a>
                            <form action="{{URL::to('/admin/product/export')}}" method="POST">
                                {{csrf_field()}}
                                <button class="btn btn-primary " type="submit">Export Excel</button>
                            </form>
                        </div>


                    </div>
                    <table class="table table-bordered display" id="products-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th>Category Information</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr id="product_{{$product->id}}">
                                <td></td>
                                <td><a href="{{URL::to('/admin/products/'.$product->id)}}">{{$product->description1}} / {{$product->description2}}</a></td>
                                <td>
                                    @foreach($categories as $cat)
                                        @if($cat->id === $product->category)
                                            {{$cat->name}}
                                        @endif
                                    @endforeach
                                </td>
                                {{--<td>--}}
                                    {{--@foreach($categories as $cat)--}}
                                        {{--@if($cat->id === $product->category)--}}
                                            {{--@foreach($subcategories as $sub)--}}
                                                {{--@if($cat->id === $product->category && $sub->category_id === $product->subcategory)--}}
                                                    {{--{{$sub->name}}--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</td>--}}
                                <td>${{$product->price}}</td>
                                <td>{{$product->quantityInStock}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirm-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Delete <span id="delete-count"></span></h4>
                </div>
                <div class="modal-body text-center">
                    <button class="btn btn-warning" id="delete-selected-products">Delete Product(s)</button>
                </div>
            </div>
        </div>
    </div>
@endsection