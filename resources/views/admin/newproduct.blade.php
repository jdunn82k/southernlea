@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="container font-calibri">
                <div class="row">
                    <h3 class="title1">Add New Product</h3>
                    <div class="form-three widget-shadow">
                        <form class="form-horizontal" action="{{URL::to('/product/update')}}" method="post">

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Product Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="focusedinput" name='product-name' value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Product Code</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="focusedinput" name='product-code' value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="product-category" name="product-category">
                                        <option value="blank"></option>
                                        @foreach($categories as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                            {{--<label for="focusedinput" class="col-sm-2 control-label">Subcategory</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<select class="form-control" id="product-subcatagory" name="product-subcategory">--}}
                            {{--<option value="blank"></option>--}}
                            {{--@foreach($subcategories as $subcat)--}}
                            {{--@if ($subcat->id === $product->subcategory)--}}
                            {{--<option value="{{$subcat->id}}" selected>{{$subcat->name}}</option>--}}
                            {{--@else--}}
                            {{--<option value="{{$subcat->id}}">{{$subcat->name}}</option>--}}
                            {{--@endif--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label for="focusedinput" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control1" id="focusedinput" name='product-price' value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtarea1" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="txtarea1" id="txtarea1" cols="50" rows="4" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sizes Available </label>
                                <div class="col-sm-8">
                                    <p class="mt-7"> This Product Has Sizing Information: <input type="checkbox" class="ml-6 sizes-available-checkbox"></p>

                                    <div class="hide sizes-available-table">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Product Code</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{--@foreach($sizes as $size)--}}
                                            {{--<tr>--}}
                                            {{--<td>{{$size->size}}</td>--}}
                                            {{--<td>{{$size->product_code}}</td>--}}
                                            {{--<td>{{$size->price}}</td>--}}
                                            {{--<td>{{$size->quantity}}</td>--}}
                                            {{--<td>--}}
                                            {{--<i class="fa fa-trash"></i>--}}
                                            {{--</td>--}}
                                            {{--</tr>--}}
                                            {{--@endforeach--}}
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary pull-right">Add Size</button>
                                    </div>


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Images</label>
                                <div class="col-sm-8 flex">
                                    {{--@foreach($images as $image)--}}
                                        {{--@if ($image->default === 1)--}}
                                            {{--<div class="photo-block m-3">--}}
                                                {{--<div class="photo-block-image">--}}
                                                    {{--<input type="checkbox" class="form-control" checked>--}}
                                                    {{--<img src="{{URL::to($image->url)}}" class="img-responsive" alt="">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                        {{--<div class="photo-block m-3">--}}
                                            {{--<div class="photo-block-image">--}}
                                                {{--<input type="checkbox" class="form-control">--}}
                                                {{--<img src="{{URL::to($image->url)}}" class="img-responsive" alt="">--}}
                                            {{--</div>                             </div>--}}
                                    {{--@endforeach--}}

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-10">
                                    <hr>
                                    <button type="submit" class="btn btn-primary pull-right" id="submit-product-changes">Update</button>
                                </div>
                            </div>





                            {{--<div class="form-group">--}}
                            {{--<label for="disabledinput" class="col-sm-2 control-label">Disabled Input</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<input disabled="" type="text" class="form-control1" id="disabledinput" placeholder="Disabled Input">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="inputPassword" class="col-sm-2 control-label">Password</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<input type="password" class="form-control1" id="inputPassword" placeholder="Password">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="checkbox" class="col-sm-2 control-label">Checkbox</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<div class="checkbox-inline1"><label><input type="checkbox"> Unchecked</label></div>--}}
                            {{--<div class="checkbox-inline1"><label><input type="checkbox" checked=""> Checked</label></div>--}}
                            {{--<div class="checkbox-inline1"><label><input type="checkbox" disabled=""> Disabled Unchecked</label></div>--}}
                            {{--<div class="checkbox-inline1"><label><input type="checkbox" disabled="" checked=""> Disabled Checked</label></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="checkbox" class="col-sm-2 control-label">Checkbox Inline</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<div class="checkbox-inline"><label><input type="checkbox"> Unchecked</label></div>--}}
                            {{--<div class="checkbox-inline"><label><input type="checkbox" checked=""> Checked</label></div>--}}
                            {{--<div class="checkbox-inline"><label><input type="checkbox" disabled=""> Disabled Unchecked</label></div>--}}
                            {{--<div class="checkbox-inline"><label><input type="checkbox" disabled="" checked=""> Disabled Checked</label></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="selector1" class="col-sm-2 control-label">Dropdown Select</label>--}}
                            {{--<div class="col-sm-8"><select name="selector1" id="selector1" class="form-control1">--}}
                            {{--<option>Lorem ipsum dolor sit amet.</option>--}}
                            {{--<option>Dolore, ab unde modi est!</option>--}}
                            {{--<option>Illum, fuga minus sit eaque.</option>--}}
                            {{--<option>Consequatur ducimus maiores voluptatum minima.</option>--}}
                            {{--</select></div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label class="col-sm-2 control-label">Multiple Select</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<select multiple="" class="form-control1">--}}
                            {{--<option>Option 1</option>--}}
                            {{--<option>Option 2</option>--}}
                            {{--<option>Option 3</option>--}}
                            {{--<option>Option 4</option>--}}
                            {{--<option>Option 5</option>--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="txtarea1" class="col-sm-2 control-label">Textarea</label>--}}
                            {{--<div class="col-sm-8"><textarea name="txtarea1" id="txtarea1" cols="50" rows="4" class="form-control1"></textarea></div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="radio" class="col-sm-2 control-label">Radio</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<div class="radio block"><label><input type="radio"> Unchecked</label></div>--}}
                            {{--<div class="radio block"><label><input type="radio" checked=""> Checked</label></div>--}}
                            {{--<div class="radio block"><label><input type="radio" disabled=""> Disabled Unchecked</label></div>--}}
                            {{--<div class="radio block"><label><input type="radio" disabled="" checked=""> Disabled Checked</label></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="radio" class="col-sm-2 control-label">Radio Inline</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<div class="radio-inline"><label><input type="radio"> Unchecked</label></div>--}}
                            {{--<div class="radio-inline"><label><input type="radio" checked=""> Checked</label></div>--}}
                            {{--<div class="radio-inline"><label><input type="radio" disabled=""> Disabled Unchecked</label></div>--}}
                            {{--<div class="radio-inline"><label><input type="radio" disabled="" checked=""> Disabled Checked</label></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="smallinput" class="col-sm-2 control-label label-input-sm">Small Input</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<input type="text" class="form-control1 input-sm" id="smallinput" placeholder="Small Input">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="mediuminput" class="col-sm-2 control-label">Medium Input</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<input type="text" class="form-control1" id="mediuminput" placeholder="Medium Input">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group mb-n">--}}
                            {{--<label for="largeinput" class="col-sm-2 control-label label-input-lg">Large Input</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<input type="text" class="form-control1 input-lg" id="largeinput" placeholder="Large Input">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </form>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection