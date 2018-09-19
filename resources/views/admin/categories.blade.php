@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="row">

                <div class="col-md-12 widget-shadow">
                    <h3 class="title1 mt-10">Edit Categories</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new-category" class="mb-10">Select Existing Top Level Category</label>
                                <select class="form-control mb-10" id="top-level-cat">
                                    <option value="blank"></option>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                <label>OR</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group clearfix">
                                <label for="sub-categories">Add New Top Level Category</label>
                                <input type="text" class="form-control sub-category" id="new-top-cat">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary pull-right" id="add-new-cat">Add New Category</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 widget-shadow" id="add-category">



                </div>
                @foreach($categories as $cat)
                    <div class="col-md-12 widget-shadow hide mt-10 hidden-tables" id="table_for_{{$cat->id}}">
                        <div class="row mt-10">
                            <div class="col-md-6">
                                <h3 class="title1 mt-4">Edit <span class="top-level-name"></span> <button type="button" class="btn btn-primary delete-top-level pull-right delete-top-level" data-cat-id="{{$cat->id}}">Delete Top Level Category</button></h3>

                                <table class="table  display" id="sub-table">
                                    <thead>
                                    <tr>
                                        <th style="width:180px;">Categories</th>
                                        <th>SubCategories</th>
                                        <th style="width:70px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subcategories as $subcat)
                                        @if ($subcat->category_id === $cat->id)
                                            <tr>
                                                <td>
                                                    <p>{{$subcat->name}}</p>
                                                    <input type="text" class="form-control hide" id="input_cat_{{$subcat->id}}" value="{{$subcat->name}}">
                                                </td>
                                                <td>
                                                    @foreach($category_links as $link)
                                                        @if ($link->subcategory_id === $subcat->id)
                                                            <p>{{$link->name}}</p>
                                                            <div class="form-group hide">
                                                                <input type="text" class="subcat-update-value form-control hide mb-10 subcat_{{$link->id}}" data-subcat-id="{{$link->id}}" id="input_cat_{{$link->id}}" value="{{$link->name}}">
                                                                <i class="fa fa-trash remove-subcat-line subcat_{{$link->id}}" id="subcat_{{$link->id}}"></i>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                        <div class="form-group hide clearfix text-center">
                                                            <i class="fa fa-2x fa-plus text-green add-new-sub-line"></i>
                                                        </div>

                                                        <div class="hide clearfix text-center button-holder">
                                                            <button class="btn btn-primary mt-10 cancel-update">Cancel</button>
                                                            <button class="btn btn-primary mt-10 update-categories" data-cat-id="{{$subcat->id}}">Update Category</button>
                                                        </div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-edit category-icons edit-category"></i>
                                                    <i class="fa fa-trash category-icons delete-category" data-cat-id="{{$subcat->id}}"></i>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr class="hide">
                                        <td>
                                            <input type="text" class="form-control" id="new-cat-name" placeholder="Category Name">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control subcat-update-value" placeholder="SubCategory Name">
                                            </div>

                                            <div class="form-group text-center">
                                                <i class="fa fa-2x fa-plus text-green add-new-sub-line2"></i>
                                            </div>
                                            <div class=" clearfix text-center button-holder">
                                                <button class="btn btn-primary mt-10 cancel-update">Cancel</button>
                                                <button class="btn btn-primary mt-10 add-category" data-cat-id="{{$cat->id}}">Add Category</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-primary show-hidden-form" type="button">Add New Category</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

            {{--<div class="row">--}}
                {{--<div class="col-md-12 widget-shadow">--}}
                    {{--<h3 class="title1 mt-4">Edit Categories</h3>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-7 col-sm-12">--}}
                            {{--<label for="select-top-level">--}}
                                {{--Select Top Level Category To Continue--}}
                            {{--</label>--}}
                            {{--<select class="form-control mb-10" id="change-top-level">--}}
                                {{--@foreach($categories as $cat)--}}
                                    {{--<option value="{{$cat->id}}">{{$cat->name}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}

                            {{--@foreach($categories as $category)--}}
                            {{--<table class="table table-bordered display" id="categories-table">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Categories</th>--}}
                                    {{--<th>Sub-Categories</th>--}}
                                    {{--<th>Actions</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@foreach($subcategories as $subcat)--}}
                                    {{--@if ($subcat->category_id === $cat->id)--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<p class="subcat_{{$subcat->id}}">{{$subcat->name}}</p>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                 {{--<span class="hide subcat_{{$subcat->id}}">--}}
                                                        {{--<input type="text" class="form-control mb-10 subcat-update-value subcat_{{$subcat->id}}" data-subcat-id="{{$subcat->id}}" value="{{$subcat->name}}">--}}
                                                        {{--<i class="fa fa-trash remove-subcat-line subcat_{{$subcat->id}}" id="subcat_{{$subcat->id}}"></i>--}}
                                                    {{--</span>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}

                                    {{--@endif--}}
                                {{--@endforeach--}}

                                    {{--<tr>--}}
                                        {{--<td>--}}

                                            {{--<div class="form-group hide">--}}
                                                {{--<button type="button" class="btn btn-info add-new-sub-line">Add New Sub-Category</button>--}}
                                                {{--<button type="button" class="btn btn-primary update-category" data-cat-id="{{$cat->id}}">Update Category</button>--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--<i class="fa fa-edit category-icons edit-category"></i>--}}
                                            {{--<i class="fa fa-trash category-icons"></i>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}

                                {{--</tbody>--}}
                            {{--</table>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirm-cat-delete2">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <input type="hidden" id="selected-cat-id2" value="">
                    <p id="count-message" class="mb-10">Delete Category?</p>

                    <div class="form-group mt-10">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">Go Back</button>
                        <button type="button" class="btn btn-primary" id="yes-delete-cat2">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirm-cat-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <input type="hidden" id="selected-cat-id" value="">
                    <p id="count-message" class="mb-10">Delete Top Level Category?</p>

                    <div class="form-group mt-10">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">Go Back</button>
                        <button type="button" class="btn btn-primary" id="yes-delete-cat">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirm-subcat-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <input type="hidden" id="selected-subcat-id" value="">
                    <p id="count-message" class="mb-10">Delete Sub-Category?</p>
                    <div class="form-group mt-10">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">Go Back</button>
                        <button type="button" class="btn btn-primary" id="yes-delete-subcat">Yes</button>
                    </div>
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