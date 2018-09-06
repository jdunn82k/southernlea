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

    public function getCartTax()
    {
        return Cart::tax();
    }

    public function removeCartItem(Request $request)
    {
        return Cart::remove($request->rowId);
    }

    public function getStats()
    {
        return response()->json(["count" => self::getCartCount(), "total" => self::getCartSubTotal()]);
    }

    public function showCart()
    {

        return view('pages.checkout')
            ->with('cartContent', self::getCartContent())
            ->with('cartCount', self::getCartCount())
            ->with('cartSubTotal', self::getCartSubTotal())
            ->with('cartTax', self::getCartTax())
            ->with('taxRate', \Config::get('cart.tax'));
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
            $data['options'] = ['size' => $size, 'desc' => $product->description2];
        }
        else
        {
            $data['options'] = ['desc' => $product->description2];
        }

        return Cart::add($data);
    }
}
