@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="container font-calibri">
                    <div class="row">
                        <h3 class="title1">Product Information</h3>
                        <div class="form-three widget-shadow">
                            <form class="form-horizontal">
                                <input type="hidden" id="product-id" value="{{$product->id}}">
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Product Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="desc1" name='product-name' value="{{$product->description1}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Top Level Category</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="product-topcategory" name="product-category">
                                            <option value="0"></option>

                                            @foreach($categories as $cat)
                                                @if ($cat->id === $product->category)
                                                    <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                                @else
                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="product-subcategory" name="product-subcategory">
                                            <option value="0"></option>

                                            @foreach($subcategories as $subcat)
                                                @if ($subcat->id === $product->subcategory)
                                                    <option value="{{$subcat->id}}" selected>{{$subcat->name}}</option>
                                                @elseif($subcat->category_id === $product->category)
                                                    <option value="{{$subcat->id}}">{{$subcat->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Subcategory</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="product-categorylink" name="product-categorylink">
                                            <option value="0"></option>
                                            @foreach($categorylinks as $link)
                                                @if ($link->id === $product->categorylink)
                                                    <option value="{{$link->id}}" selected>{{$link->name}}</option>
                                                @elseif($link->subcategory_id === $product->subcategory)
                                                    <option value="{{$link->id}}">{{$link->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Price</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="product-price" name='product-price' value="{{$product->price}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Special Offer?</label>
                                    <div class="col-sm-8 flex">

                                        <label style="margin-right:10px;">No:</label>
                                        <input type="radio" class="form-controll" id="special-no" name="special-offer" value="no" @if($product->special_offer === 0) checked @endif >
                                        <label style="margin-right:10px;margin-left:45px;">Yes:</label>
                                        <input type="radio" class="form-controll" id="special-yes" name="special-offer" value="yes" @if($product->special_offer === 1) checked @endif>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Shipping Cost</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="product-shipping" name='product-shipping' value="{{$product->shipping}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Quantity In Stock</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" id="product-quantity" name='product-quantity' value="{{$product->quantityInStock}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea1" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-8">
                                        <textarea name="txtarea1" id="txtarea1" cols="50" rows="4" class="form-control">@if ($product->description2){{$product->description2}}@endif</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea2" class="col-sm-2 control-label">Additional Information</label>
                                    <div class="col-sm-8">
                                        <textarea name="txtarea2" id="txtarea2" cols="50" rows="4" class="form-control">@if ($product->additional){{$product->additional}}@endif</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtarea2" class="col-sm-2 control-label">Reviews</label>
                                    <div class="col-sm-8">
                                        <textarea name="txtarea2" id="txtarea2" cols="50" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Images</label>
                                    <div class="col-sm-8 flex image-blocks">
                                        <input type="file" class="hide" id="image-input" name="image">

                                        @foreach($images as $image)
                                            @if ($image->default === 1)
                                                <div class="photo-block m-3">
                                                    <div class="photo-block-image photo-select">
                                                        <input type="checkbox" class="form-control" data-photo-url="{{str_replace('img/', '', $image->url)}}" data-photo-id="{{$image->id}}">
                                                        <img src="{{URL::to($image->url)}}" class="img-responsive" alt="">
                                                    </div>
                                                </div>
                                            @else
                                            <div class="photo-block m-3">
                                                <div class="photo-block-image">
                                                    <input type="checkbox" class="form-control" data-photo-url="{{str_replace('img/', '', $image->url)}}" data-photo-id="{{$image->id}}">
                                                    <img src="{{URL::to($image->url)}}" class="img-responsive" alt="">
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="pull-right">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary select-default">Set Default</button>
                                                <button type="button" class="btn btn-primary rotate-image">Rotate Image</button>
                                                <button type="button" class="btn btn-primary add-new-image">Add Image</button>
                                                <button type="button" class="btn btn-primary pull-right delete-images">Delete Selected Images</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Sizes Available </label>
                                    <div class="col-sm-8">
                                        <table class="table" id="sizes-available">
                                            <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sizes as $size)
                                                <tr class="existing" id="size_{{$size->id}}">
                                                    <td>{{$size->size}}</td>
                                                    <td>{{$size->price}}</td>
                                                    <td>{{$size->quantity}}</td>
                                                    <td>
                                                        <i class="fa fa-trash"></i>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary pull-right" id="add-size">Add Size</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <hr>
                                        <button type="button" class="btn btn-primary pull-right" id="submit-product-changes">Update Product</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </form>
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