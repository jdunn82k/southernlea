@extends('layouts.admin2')

@section('content')
    @php
        $product        = \App\Products::findOrFail($id);
        $categories     = \App\Categories::all();
        $subcategories  = \App\SubCategories::all();
        $links          = \App\CategoryLinks::all();
        $colors         = \App\ColorFilters::all();
        $images         = \App\ProductImages::where('product_id', $id)->get();
    @endphp

    <div class="container font-calibri">
        <form action="{{URL::to('/product/update')}}" method="post">

            <!-- Product Information Section-->
            <div class="row">
                <div class="col-md-10 col-lg-10 col-sm-12">
                    <h4 class="font-italic">Product Information</h4>
                    <hr class="mt-0">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label for="product-name">Product Name:</label>
                        <input class='form-control' type="text" id="product-name" value="{{$product->description1}}">
                    </div>
                    <div class="form-group">
                        <label for="product-code">Product Code:</label>
                        <input type="text" class="form-control" id="product-code" value="{{$product->code}}">
                    </div>
                    <div class="form-group">
                        <label for="product-quantity">Quantity In Stock:</label>
                        <input type="number" class="form-control" value="{{$product->quantityInStock}}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label for="product-category">Category</label>
                        <select class="form-control" id="product-category">
                            <option value="blank"></option>

                            @foreach($categories as $cat)
                                @if ($cat->id === $product->category)
                                    <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                @else
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product-subcategory">Subcategory:</label>
                        <select class="form-control" id="product-subcatagory">
                            <option value="blank"></option>
                            @foreach($subcategories as $subcat)
                                @if ($subcat->id === $product->subcategory)
                                    <option value="{{$subcat->id}}" selected>{{$subcat->name}}</option>
                                @else
                                    <option value="{{$subcat->id}}">{{$subcat->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product-category-link">Subcategory:</label>
                        <select class="form-control" id="product-catagory-link">
                            <option value="blank"></option>
                            @foreach($links as $link)
                                @if ($link->id === $product->categorylink)
                                    <option value="{{$link->id}}" selected>{{$link->name}}</option>
                                @else
                                    <option value="{{$link->id}}">{{$link->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Pricing Section -->
            <div class="row">
                <div class="col-md-10 col-lg-10 col-sm-12">
                    <h4 class="font-italic">Pricing</h4>
                    <hr class="mt-0">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label for="product-price">Price:</label>
                        <input type="number" class="form-control" value="{{$product->price}}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label for="product-discount">Discount:</label>
                        <input type="number" class="form-control" value="{{$product->discount}}">
                    </div>
                </div>
            </div>
            <!-- Color Section -->
            <div class="row">
                <div class="col-md-10 col-lg-10 col-sm-12">
                    <h4 class="font-italic">Color</h4>
                    <hr class="mt-0">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">

                        <ul class="w_nav2">
                            @foreach($colors as $color)
                                <li><div class="color-block" data-id="{{$color->id}}" style="background-color: {{$color->hex}}"></div></li>
                            @endforeach
                        </ul>

                </div>
            </div>

            <!-- Photos Section -->
            <div class="row">
                <div class="col-md-10 col-lg-10 col-sm-12">
                    <h4 class="font-italic">Images</h4>
                    <hr class="mt-0">
                </div>
            </div>
            <div class="row">
                    <div class="photo-area">
                        @foreach($images as $image)
                            @if ($image->default === 1)
                                <div class="photo-block m-3">
                                    <div class="photo-block-image">
                                        <input type="checkbox" class="form-control" checked>
                                        <img src="{{URL::to($image->url)}}" class="img-responsive" alt="">
                                    </div>
                                </div>
                            @endif
                            <div class="photo-block m-3">
                                <div class="photo-block-image">
                                    <input type="checkbox" class="form-control">
                                    <img src="{{URL::to($image->url)}}" class="img-responsive" alt="">
                                </div>                             </div>
                        @endforeach
                        <div class="photo-block m-3 upload-new"><span class="add-new-image-text">Add New Image</span></div>
                    </div>

            </div>

            <!-- Description Section -->
            <div class="row">
                <div class="col-md-10 col-lg-10 col-sm-12">
                    <h4 class="font-italic">Description</h4>
                    <hr class="mt-0">
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <div class="form-group">
                        <textarea class='form-control' id="product-description"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="submit-product-changes">Update</button>
            </div>
                </form>
            </div>
@endsection