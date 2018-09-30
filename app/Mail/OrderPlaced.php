<?php

namespace App\Mail;

use App\Products;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Gloudemans\Shoppingcart\Facades\Cart;


class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //Get Product Information

        $products = [];
        foreach(Cart::content() as $cart_item)
        {
            $product = Products::where('id',$cart_item->id)->get();
            if (count($product) > 0)
            {
                $products[$cart_item->id] = [
                    'name' => $cart_item->name." - ".$product->description2,
                    'qty' => $cart_item->qty,
                    'unit_price' => $product->price,
                    'total_price' => ($product->price * $cart_item->qty),
                    'product_size' => $cart_item->options->size
                ];
            }
            else
            {
                $products[$cart_item->id] = [
                    'name' => $cart_item->name,
                    'qty' => $cart_item->qty,
                    'unit_price' => $cart_item->price,
                    'total_price' => ($cart_item->price * $cart_item->qty),
                    'product_size' => $cart_item->options->size
                ];
            }

        }
        return $this->view('email.orderplace')
            ->with('name', $this->order->name)
            ->with('add1', $this->order->address_1)
            ->with('add2', $this->order->address_2)
            ->with('city', $this->order->city)
            ->with('state', $this->order->state)
            ->with('zip', $this->order->zip_code)
            ->with('tax', Cart::tax())
            ->with('shipping',number_format(\Config::get('cart.shipping'),2) )
            ->with('grandTotal', (Cart::subtotal() + Cart::tax() + \Config::get('cart.shipping')))
            ->with('subTotal', Cart::subtotal())
            ->with('cartTotal', Cart::count())
            ->with('products', $products);
    }
}
