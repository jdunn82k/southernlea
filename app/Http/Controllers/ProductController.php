<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function showProduct($id)
    {
        $product = Products::findOrFail($id);
        $images  = ProductImages::where('product_id', $id)->get();

        return view('pages.product')
                    ->with('product', $product)
                    ->with('images', $images);
    }
    public function getProducts(Request $request)
    {
        //Declared Variables
        $filters = $request->filters;
        $color = false;
        $sort_by = false;
        $discount = false;
        $skip = false;
        $take = false;

        //Check if Color Filter is active
        if (isset($filters['color'])) {
            $color = $filters['color'];
        }

        //Check if 'Sort By' filter is active
        if (isset($filters['sort_by'])) {
            switch ($filters['sort_by']) {
                case "1":
                    $sort_by = "asc";
                    break;

                case "2":
                    $sort_by = "desc";
                    break;

            }
        }

        //Check if Discount Filter is active
        if (isset($filters['discount']) && $filters['discount'] > 0) {
            $discount = $filters['discount'];
        }

        //Get total count of results
        $products_count = DB::table('products')
            ->when($color, function ($query, $color) {
                return $query->where('color', $color);
            })
            ->when($sort_by, function ($query, $sort_by) {
                return $query->orderBy('price', $sort_by);
            })
            ->when($discount, function ($query, $discount) {
                return $query->where('discount', '>=', $discount);
            })->count();

        //If more than 20 results are present, paginate and determine results to obtain

        if ($products_count > 20 && $request->view_all == "false") {
            if ($request->page > 1) {
                $skip = (($request->page - 1) * 20);
            }
            $take = 20;
        }

        $products = DB::table('products')
            ->when($color, function ($query, $color) {
                return $query->where('color', $color);
            })->when($sort_by, function ($query, $sort_by) {
                return $query->orderBy('price', $sort_by);
            })->when($discount, function ($query, $discount) {
                return $query->where('discount', '>=', $discount);
            })->when($skip, function ($query, $skip) {
                return $query->skip($skip);
            })->when($take, function ($query, $take) {
                return $query->take($take);
            })->get();

        $response = [];
        $image_array = [];
        foreach ($products as $product) {
            $data = [];
            $data['id'] = $product->id;
            $data['name'] = $product->description1;
            $data['price'] = $product->price;
            $data['discount'] = $product->discount;

            $response[] = $data;

            $images = ProductImages::where('product_id', $product->id)->get();
            foreach ($images as $image) {
                $image_array[$product->id][$image->id]['url'] = $image->url;
                $image_array[$product->id][$image->id]['default'] = $image->default;
            }
        }


        return response()->json(["products" => $response, "images" => $image_array, "products_count" => $products_count]);

    }

}