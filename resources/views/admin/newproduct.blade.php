@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="container font-calibri">
                <div class="row">
                    <h3 class="title1">Add A New Product</h3>
                    <div class="form-three widget-shadow">
                        <form class="form-horizontal">
                            <input type="hidden" id="product-id" value="">

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Product Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="desc1" name='product-name' value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Top Level Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="product-topcategory" name="product-category">
                                        <option value="blank"></option>

                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="product-category" name="product-category">
                                        <option value="blank"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Subcategory</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="product-categorylink" name="product-categorylink">
                                        <option value="blank"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="product-price" name='product-price' value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Quantity In Stock</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="product-quantity" name='product-quantity' value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtarea1" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="txtarea1" id="txtarea1" cols="50" rows="4" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtarea2" class="col-sm-2 control-label">Additional Information</label>
                                <div class="col-sm-8">
                                    <textarea name="txtarea2" id="txtarea2" cols="50" rows="4" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Images</label>
                                <div class="col-sm-8 flex image-blocks">
                                    <input type="file" class="hide" id="new-image-input" name="image">
                                </div>
                                <div class="col-sm-10">
                                    <div class="pull-right">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary select-default">Set Default</button>
                                            <button type="button" class="btn btn-primary rotate-image">Rotate Image</button>
                                            <button type="button" class="btn btn-primary add-new-image-2">Add Image</button>
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

                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary pull-right" id="add-size">Add Size</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <hr>
                                    <button type="button" class="btn btn-primary pull-right" id="add-product-button">Add Product</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="added-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p class="mb-10">Product Added</p>
                    <a href="{{URL::to("/admin/products")}}" type="button" class="btn btn-primary">Ok</a>
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