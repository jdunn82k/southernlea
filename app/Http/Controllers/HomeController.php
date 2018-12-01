<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ColorFilters;
use App\Products;
use App\ProductImages;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Products::where("special_offer", 1)->get();
        $images   = [];
        foreach($products as $product)
        {
            $product_images = ProductImages::where("product_id", $product->id)->get();
            foreach($product_images as $image)
            {
                if ($image->default === 1)
                {
                    $images[$product->id] = $image->url;
                }

                if (count($images) === 0)
                {
                    $images[$product->id] = $product_images[0]->url;
                }

            }
        }
        return view('pages.index')
            ->with('specials', $products)
            ->with('specials_images', $images);
    }

    public function home()
    {
        return view('pages.home')
            ->with('colors', ColorFilters::all())
            ->with('category', 0)
            ->with('subcategory', 0);
    }

    public function catIndex(Request $request)
    {
        return view('pages.home')
            ->with('colors', ColorFilters::all())
            ->with('category', $request->category)
            ->with('subcategory', $request->subcategory)
            ->with('subcat2', $request->subcat2);
    }
}
