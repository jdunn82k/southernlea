<?php

namespace App\Http\Controllers;

use App\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCartCount()
    {
        return Cart::count();
    }

    public function getCartSubTotal()
    {
        return Cart::subtotal();
    }

    public function getCartContent()
    {
        return Cart::content();
    }

    public function emptyCart()
    {
        return Cart::destroy();
    }

    public function getStats()
    {
        return response()->json(["count" => self::getCartCount(), "total" => self::getCartSubTotal()]);
    }

    public function addToCart(Request $request)
    {
        $product = Products::findOrFail($request->product);

        //Configure discount
        if ($product->discount > 0)
        {
            $price = number_format($product->price - ($product->price * ($product->discount / 100)),2);
        }
        else
        {
            $price = $product->price;
        }

        if (isset($request->size))
        {
            $size = $request->size;
        }
        else
        {
            $size = false;
        }

        $data = ['id' => $request->product, 'name' => $product->description1, 'qty' => $request->quantity, 'price' => $price];

        if ($size)
        {
            $data['options'] = ['size' => $size];
        }

        return Cart::add($data);
    }
}
