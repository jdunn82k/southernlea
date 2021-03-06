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
                if (isset($product[0]->description2))
                {
                    $name = $cart_item->name." - ".$product[0]->description2;
                }
                else
                {
                    $name = $cart_item->name;
                }

                $products[$cart_item->id] = [
                    'name' => $name,
                    'qty' => $cart_item->qty,
                    'unit_price' => $product[0]->price,
                    'total_price' => ($product[0]->price * $cart_item->qty),
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
            ->with('shipping',number_format($this->order->shipping_cost,2) )
            ->with('local_pickup', $this->order->local_pickup)
            ->with('grandTotal', (Cart::subtotal() + Cart::tax() + $this->order->shipping_cost))
            ->with('subTotal', Cart::subtotal())
            ->with('cartTotal', Cart::count())
            ->with('products', $products);
    }
}
