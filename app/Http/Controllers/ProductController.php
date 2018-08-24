<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductImages;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getProductTable($sort)
    {
        switch($sort)
        {
            case "asc":
                $products = Products::orderBy('price')->get();
            break;

            case "desc":
                $products = Products::orderByDesc('price')->get();
            break;

            default:
                $products = Products::orderBy('price')->get();
            break;

        }

        $response       = [];
        $image_array    = [];
        foreach($products as $product)
        {
            $data               = [];
            $data['id']         = $product->id;
            $data['name']       = $product->description1;
            $data['price']      = $product->price;
            $data['discount']   = $product->discount;

            $response[] = $data;

            $images = ProductImages::where('product_id', $product->id)->get();
            foreach($images as $image)
            {
                $image_array[$product->id][$image->id]['url']       = $image->url;
                $image_array[$product->id][$image->id]['default']   = $image->default;
            }
        }


        return response()->json(["products" => $response, "images" => $image_array]);
    }
}
