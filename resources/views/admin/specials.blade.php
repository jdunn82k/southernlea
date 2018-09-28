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
                    <div class="button-group clearfix mb-10">
                        <div class="pull-right">
                            <button type="button" class="btn btn-warning" id="add-new-offer">Add New Offer</button>
                            <button type="button" class="btn btn-info" id="edit-offer">Edit Offer</button>
                            <button type="button" class="btn btn-primary" id="remove-selected-offers">Remove Selected Offers</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row edit-offer hide">
                <div class="col-md-10 col-lg-12">
                    <input type="hidden" id="update-special-id" value="">
                    <h3 class="title1 mt-10">Edit Special Offer</h3>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label mb-10">2. Product Name</label>
                        </div>
                    </div>

                    <div class="form-group mb-10">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="product-name-2" value="">
                        </div>
                    </div>
                    <div class="form-group mt-25">
                        <div class="col-md-12">
                            <label class="control-label mt-10 mb-10">3. Price</label>
                        </div>
                    </div>

                    <div class="form-group mt-10">
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="special-price-2" value="">
                        </div>
                    </div>

                    <div class="form-group mt-250">
                        <div class="col-md-12">
                            <label class="control-label mt-10 mb-10">4. Show T-Shirt Sizes? </label>
                        </div>
                    </div>

                    <div class="form-group mt-10">
                        <div class="col-md-3">
                            <span><label for="show-size-3">Yes</label> <input type="radio" class="mr-10" name="show-size-2" id="show-size-3" value="1" ></span>
                            <span><label for="show-size-4">No</label> <input type="radio" name="show-size-2" value="0" id="show-size-4" checked></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label mt-25">5. Select One Image</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 flex image-blocks" id="image-pane-4">
                            <input type="file" class="hide" id="new-image-input-4" name="image">
                        </div>
                    </div>
                    <div class=" col-md-8">
                        <div class="form-group mt-10">
                            <button type="button" class="btn btn-primary rotate-image">Rotate Selected Image</button>
                            <button type="button" class="btn btn-primary add-new-image-4">Add Image</button>
                            <button type="button" class="btn btn-danger delete-image-edit">Delete Image</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 clearfix ">
                            <button type="button" class="btn btn-primary mt-25 mb-10" id="update-special">Update Special</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-offer hide">
                <div class="row">
                    <div class="col-md-10 col-lg-12">
                        <h3 class="title1 mt-10">Add Special Offer</h3>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label">1. Select An Option</label>
                                <select class="form-control mb-10" id="select-option">
                                    <option value=""></option>
                                    <option value="1">Use an existing product</option>
                                    <option value="2">Custom options</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="new-product">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label mb-10">2. Product Name</label>
                                </div>
                            </div>

                            <div class="form-group mt-10 mb-10">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="product-name" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group existing-product">
                            <div class="col-md-5">
                                <label class="control-label mt-10 mb-10">2. Select An Existing Product</label>
                            </div>
                        </div>

                        <table class="table existing-product" id="special-offers-dt" width="100%">
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
                                    <td><input type="radio" class="product-radio" name="product-radio" data-id="{{$product->id}}"></td>
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

                                            echo implode(" / ", $cats);
                                        @endphp
                                    </td>
                                    <td>${{$product->price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="after-product-select">

                            <div class="form-group mt-10">
                                <div class="col-md-12">
                                    <label class="control-label mt-10 mb-10">3. Price</label>
                                </div>
                            </div>

                            <div class="form-group mt-10">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="special-price" value="">
                                </div>
                            </div>

                            <div class="form-group mt-10">
                                <div class="col-md-12">
                                    <label class="control-label mt-10 mb-10">4. Show T-Shirt Sizes? </label>
                                </div>
                            </div>

                            <div class="form-group mt-10">
                                <div class="col-md-3">
                                    <span><label for="show-size-1">Yes</label> <input type="radio" class="mr-10" name="show-size" id="show-size-1" value="1" ></span>
                                    <span><label for="show-size-2">No</label> <input type="radio" name="show-size" value="0" id="show-size-2" checked></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label mt-10">4. Select One Image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 flex image-blocks" id="image-pane">
                                    <input type="file" class="hide" id="new-image-input-3" name="image">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-group mt-10">
                                        <button type="button" class="btn btn-primary rotate-image">Rotate Selected Image</button>
                                        <button type="button" class="btn btn-primary add-new-image-3">Add Image</button>
                                        <button type="button" class="btn btn-danger delete-new-image">Delete Image</button>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 clearfix ">
                                    <button type="button" class="btn btn-primary mt-10 mb-10" id="add-special">Add Special Offer</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirm-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <pclass="mb-10">Deleted Selected Offers?</p>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="button" class="btn btn-primary" id="remove-offers">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="messages">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p id="error-message" class="mb-10"></p>
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection