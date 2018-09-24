<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductImages;
use App\ProductSizes;
use App\CategoryLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    public function getProductSizes($sid)
    {
        $size = ProductSizes::findOrFail($sid);
        return $size;
    }
    public function showProduct($id)
    {
        $product = Products::findOrFail($id);
        $images  = ProductImages::where('product_id', $id)->get();
        $sizes   = ProductSizes::where('product_id', $id)->get();

        return view('pages.product')
                    ->with('product', $product)
                    ->with('sizes', $sizes)
                    ->with('images', $images);
    }


    public function getProducts(Request $request)
    {
        //Declared Variables
        $filters = $request->filters;
        $category = false;
        $color = false;
        $sort_by = false;
        $price_range = false;
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
        if (isset($filters['price_range']) && $filters['price_range'] !== 0) {
            $price_range = $filters['price_range'];
        }

        //Check for category
        if ($filters['category'] !== 0)
        {
            $category = $filters['category'];
        }

        if ($filters['subcat2'] !== 0)
        {
            $subcat2 = $filters['subcat2'];
        }

        if ($filters['subcategory'] !== 0)
        {
            $subcategory = $filters['subcategory'];
            $find = CategoryLinks::where('id', $subcategory)->get();

            if (count($find) > 0)
            {
                if (strtolower($find[0]->name) == "all")
                {
                    $subcategory = false;
                }
            }
        }

        //Get total count of results
        $products_count = DB::table('products')
            ->when($color, function ($query, $color) {
                return $query->where('color', $color);
            })
            ->when($sort_by, function ($query, $sort_by) {
                return $query->orderBy('price', $sort_by);
            })
            ->when($category, function ($query, $category){
                return $query->where('category', $category);
            })
            ->when($subcat2, function($query, $subcat2){
                return $query->where('subcategory', $subcat2);
            })
            ->when($subcategory, function ($query, $subcategory){
                return $query->where('categorylink', $subcategory);
            })
            ->when($price_range, function ($query, $price_range) {
                switch ($price_range){
                    case "10":
                        $high = 9.99;
                        $low = 0.00;
                    break;

                    case "20":
                        $high = 19.99;
                        $low = 10.00;
                    break;

                    case "20+":
                        $high = 1000.00;
                        $low  = 20.00;
                    break;
                }
                return $query->where('price', '>=', $low)->where('price', '<=', $high);
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
            })->when($category, function ($query, $category){
                return $query->where('category', $category);

            })->when($subcat2, function($query, $subcat2){
                return $query->where('subcategory', $subcat2);
            })
            ->when($subcategory, function ($query, $subcategory){
                return $query->where('categorylink', $subcategory);
            })->when($price_range, function ($query, $price_range) {
                switch ($price_range){
                    case "10":
                        $high = 9.99;
                        $low = 0.00;
                        break;

                    case "20":
                        $high = 19.99;
                        $low = 10.00;
                        break;

                    case "20+":
                        $high = 1000.00;
                        $low  = 20.00;
                        break;
                }
                return $query->where('price', '>=', $low)->where('price', '<=', $high);
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
            $data['desc'] = $product->description2;
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