@extends('layouts.admin2')

@section('content')
<div id="page-wrapper">
    <div class="main-page">
        <div class="widget-shadow">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title1 mt-10">Active Special Offers</h3>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th width="35"></th>
                                <th>Product</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($specials as $special)
                            <tr>
                                <td><input type="checkbox" class="special-check" data-id="{{$special->id}}"></td>
                                <td>{{$special->name}}</td>
                                <td>${{$special->price}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="button-group">
                        <div class="pull-right">
                            <button type="button" class="btn btn-warning" id="add-new-offer">Add New Offer</button>
                            <button type="button" class="btn btn-info" id="edit-offer">Edit Offer</button>
                            <button type="button" class="btn btn-primary" id="remove-selected-offers">Remove Selected Offers</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row edit-offer hide">
                <div class="col-md-8">

                </div>
            </div>
            <div class="add-offer hide">
                <div class="row">
                    <div class="col-md-10 col-lg-12">
                        <h3 class="title1 mt-10">Add Special Offer</h3>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label">1. Select An Option</label>
                                <select class="form-control">
                                    <option value=""></option>
                                    <option value="1">Use an existing product</option>
                                    <option value="2">Custom options</option>
                                </select>
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-4">--}}
                                {{--<label class="control-label">Product Name</label>--}}
                                {{--<input type="text" class="form-control" id="product-name-input">--}}
                                {{--<p class="text-center">-OR-</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-md-8 mt-10">
                        <br>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label class="control-label">2. Select An Existing Product</label>
                            </div>
                        </div>
                        <table class="table table-sm display" id="special-offers-dt" width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th>Category Information</th>
                                <th>Current Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><input type="radio" class="product-radio" data-id="{{$product->id}}"></td>
                                    <td>{{$product->description1}} / {{$product->description2}}</td>
                                    <td>@php
                                            $category_id = $product->category;
                                            $subcat_id   = $product->subcategory;
                                            $catlink_id  = $product->categorylink;

                                            $category   = \App\Categories::find($category_id);
                                            $subcat     = \App\SubCategories::find($subcat_id);
                                            $catlink    = \App\CategoryLinks::find($catlink_id);

                                            $cats       = [];
                                            if ($category){
                                                $cats[] = $category->name;
                                            }

                                            if ($subcat){
                                                $cats[] = $subcat->name;
                                            }

                                            if ($catlink){
                                                $cats[] = $catlink->name;
                                            }

                                            echo implode(" - ", $cats);
                                        @endphp
                                    </td>
                                    <td>${{$product->price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <div class="col-md-5">
                                <label class="control-label">3. Select One Image</label>
                            </div>
                        </div>

                        <div class="form-group">
                            {{--<label class="col-sm-2 control-label">Images</label>--}}
                            <div class="col-sm-8 flex image-blocks" id="image-pane">
                                <input type="file" class="hide" id="new-image-input" name="image">
                                {{--@foreach($images as $image)--}}
                                    {{--@if ($image->default === 1)--}}
                                        {{--<div class="photo-block m-3">--}}
                                            {{--<div class="photo-block-image photo-select">--}}
                                                {{--<input type="checkbox" class="form-control" data-photo-url="{{str_replace('img/', '', $image->url)}}" data-photo-id="{{$image->id}}">--}}
                                                {{--<img src="{{URL::to($image->url)}}" class="img-responsive" alt="">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@else--}}
                                        {{--<div class="photo-block m-3">--}}
                                            {{--<div class="photo-block-image">--}}
                                                {{--<input type="checkbox" class="form-control" data-photo-url="{{str_replace('img/', '', $image->url)}}" data-photo-id="{{$image->id}}">--}}
                                                {{--<img src="{{URL::to($image->url)}}" class="img-responsive" alt="">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            </div>
                            <div class="col-sm-10">
                                <div class="pull-right">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary select-default">Use Image</button>
                                        <button type="button" class="btn btn-primary rotate-image">Rotate Image</button>
                                        <button type="button" class="btn btn-primary add-new-image-2">Add Image</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection