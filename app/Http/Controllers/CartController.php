<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Products;
use App\Orders;
use App\ProductSizes;
use App\Specials;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function createOrder(Request $request)
    {
        //Gather Product Info
        $product_info = [];
        foreach(Cart::content() as $item)
        {
            $product = Products::find($item->id);
            if ($product)
            {
                $product_size = $product->size;
                $product_price = $item->price;
                if (isset($item->options->size))
                {
                    $productSize = ProductSizes::find($item->options->size_id);
                    $product_price = $productSize->price;
                    $product_size = $productSize->size;
                }


                $product_info[] = [
                    'id' => $item->id,
                    'product_name' => $product->description1." - ".$product->description2,
                    'product_size' => $product_size,
                    'product_price' => $product_price,
                    'quantity' => $item->qty,
                ];
            }
            else
            {
                $product_size = "";
                $product_price = $item->price;
                if (isset($item->options->size))
                {
                    $product_size = $item->options->size;
                }
                $product_info[] = [
                    'id' => $item->id,
                    'product_name' => $item->name,
                    'product_size' => $product_size,
                    'product_price' => $product_price,
                    'quantity' => $item->qty,
                ];
            }
        }

        $order = new Orders();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address_1 = $request->address_1;
        $order->address_2 = $request->address_2;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip_code = $request->zip_code;
        $order->phone     = $request->phone;
        $order->product_info = json_encode($product_info);
        $order->shipping_cost = \Config::get('cart.shipping');
        $order->tax_rate = \Config::get('cart.tax');
        $order->subtotal = Cart::subtotal();
        $order->grand_total = (Cart::subtotal() + Cart::tax() + \Config::get('cart.shipping'));
        $order->total_items_sold = Cart::count();
        $order->save();
        $request->session()->put('order_id', $order->id);

        return $order->id;

    }
    public function checkOut()
    {
        return view('pages.shipping')
            ->with('cartContent', self::getCartContent())
            ->with('cartCount', self::getCartCount())
            ->with('cartSubTotal', self::getCartSubTotal())
            ->with('cartTax', self::getCartTax())
            ->with('taxRate', \Config::get('cart.tax'))
            ->with('shippingRate', \Config::get('cart.shipping'));
    }

    public function thankYou(Request $request)
    {
        if ($request->session()->has('order_id'))
        {
            $order      = Orders::findOrFail($request->session()->get('order_id'));
            $products   = json_decode($order->product_info, true);

            foreach($products as $product)
            {
                $id     = $product['id'];
                $qty    = $product['quantity'];
                $prod   = Products::find($id);
                if ($prod)
                {

                    if ($prod->quantityInStock > $qty)
                    {
                        $prod->quantityInStock = ($prod->quantityInStock - $qty);
                    }
                    else
                    {
                        $prod->quantityInStock = 0;
                    }
                    $prod->save();
                }

            }

            $order->payment_successful = true;
            $order->save();

            $request->session()->forget('order_id');

            Mail::to( 'jamie@southernlea.com')->send(new OrderPlaced($order));
            self::emptyCart();
        }

        return view('pages.thankyou');
    }
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
            ->with('taxRate', \Config::get('cart.tax'))
            ->with('shippingRate', \Config::get('cart.shipping'));
    }

    public function addToCartSpecial(Request $request)
    {
        $special = Specials::findOrFail($request->id);
        $size    = false;

        if (isset($request->size))
        {
            $size = $request->size;
        }

        $data = ['id' => 'special_'.$request->id, 'name' => $special->name, 'qty' => 1, 'price' => $special->price];

        if ($size)
        {
            $data['options'] = ['size' => $size];
        }

        return Cart::add($data);
    }

    public function addToCart(Request $request)
    {
        $product = Products::findOrFail($request->product);
        $productSize = ProductSizes::where('id', $request->size_id)->get();

        $price = $product->price;
        $size  = false;
        if (count($productSize) > 0)
        {
            $price = $productSize[0]->price;
            $size  = $productSize[0]->size;
        }

        //Configure discount
        if ($product->discount > 0)
        {
            $price = number_format($price - ($price * ($product->discount / 100)),2);
        }


        $data = ['id' => $request->product, 'name' => $product->description1, 'qty' => $request->quantity, 'price' => $price];

        if ($size)
        {
            $data['options'] = ['size' => $size, 'desc' => $product->description2, 'size_id' => $request->size_id];
        }
        else
        {
            $data['options'] = ['desc' => $product->description2];
        }

        return Cart::add($data);
    }
}
