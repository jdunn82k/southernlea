<?php

namespace App\Http\Controllers;

use App\Categories;
use App\CategoryLinks;
use App\ColorFilters;
use App\Products;
use App\ProductImages;
use App\ProductSizes;
use App\Orders;
use App\SubCategories;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    private function getNonAdminUsersCount()
    {
        return User::where('isAdmin', 0)->count();
    }

    private function getProductSizes($id)
    {
        return ProductSizes::where('id', $id)->get();
    }

    private function getOrderStats()
    {
        $orders_complete_revenue    = 0;
        $orders_complete_number     = 0;
        $orders_pending_number      = 0;
        $orders_complete            = Orders::where('order_shipped', 1)->where('payment_successful', 1)->get();
        $orders_pending             = Orders::where('order_shipped', 0)->where('payment_successful', 1)->get();

        if (count($orders_complete) > 0)
        {
            foreach($orders_complete as $order)
            {
                $orders_complete_revenue = $orders_complete_revenue + $order->grand_total;
                $orders_complete_number++;
            }
        }

        if (count($orders_pending) > 0)
        {
            foreach($orders_pending as $order)
            {
                $orders_complete_revenue = $orders_complete_revenue + $order->grand_total;
                $orders_pending_number++;
            }
        }

        return ["total_revenue" => $orders_complete_revenue, "complete" => $orders_complete_number, "pending" => $orders_pending_number];


    }
    public function adminAuth(Request $request)
    {

        if (count(User::where('email', $request->email)->where('isAdmin' , 1)->get()) === 0)
        {
            return view('admin.login')->withErrors(['email' => 'Account Not Found']);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return $this->dashboard();
        }
        else
        {
            return view('admin.login')->withErrors(['password' => 'Wrong Password']);
        }

    }

    public function showProduct($id)
    {
        return view('admin.product-details')
            ->with('product', Products::findOrFail($id))
            ->with('categories', Categories::all())
            ->with('subcategories', SubCategories::all())
            ->with('colors', ColorFilters::all())
            ->with('images', ProductImages::where('product_id', $id)->get())
            ->with('sizes', ProductSizes::where('product_id', $id)->get())
            ->with('id', $id);
    }

    public function products()
    {
        return view('admin.products')
                    ->with('products', Products::all())
                    ->with('categories', Categories::all())
                    ->with('subcategories', SubCategories::all())
                    ->with('links', CategoryLinks::all());
    }
    public function dashboard()
    {
        return view('admin.dashboard')
            ->with('user_count', $this->getNonAdminUsersCount())
            ->with('order_stats', $this->getOrderStats());
    }

    public function logout()
    {
        Auth::logout();
        return view('admin.login');
    }

    public function index()
    {
        return view('admin.login');
    }
}
