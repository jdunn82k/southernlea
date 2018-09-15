<?php

namespace App\Http\Controllers;

use App\Categories;
use App\CategoryLinks;
use App\ColorFilters;
use App\Products;
use App\ProductImages;
use App\ProductSizes;
use App\Orders;
use App\OrderNotes;
use App\SubCategories;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    private function dailySalesChart()
    {
        $orders = Orders::all();
        $today = new \DateTime();
        $begin = new \DateTime();
        $begin->sub(new \DateInterval('P14D'));

        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($begin, $interval, $today);

        $data = [];
        foreach($dateRange as $date)
        {
            $order_count = 0;
            $order_total = 0.00;
            foreach($orders as $order)
            {
                $order_dt = new \DateTime($order->created_at);


                if ($date->format('Y-m-d') == $order_dt->format('Y-m-d'))
                {
                    $order_count++;
                    $order_total = $order_total + $order->grand_total;
                }
            }
            $data[$date->format('Y-m-d')] = ['order_count' => $order_count, 'order_total' => $order_total] ;
        }
        $array = [];

        foreach($data as $key => $val)
        {
            $dt = new \DateTime($key);
            $array[] = ["X" => $dt->format("m/d"), "Y" => $val['order_total']];
        }

        return $array;

    }

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

        return [
            "total_revenue" => $orders_complete_revenue,
            "complete" => $orders_complete_number,
            "pending" => $orders_pending_number];

    }

    public function removeProductImages(Request $request)
    {
        ProductImages::destroy($request->ids);
        return "1";
    }
    public function addProductImage(Request $request)
    {
        $this->validate($request, [

            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $file = $request->file('file')->store(false, 'image-upload');

        $image = new ProductImages();
        $image->product_id = $request->product_id;
        $image->url = "img/".$file;
        $image->default = 0;
        $image->save();

        return response()->json(["id" => $image->id, "file" => $file]);
    }
    public function completeOrder(Request $request)
    {
        $order = Orders::find($request->order_id);
        $order->order_shipped = 1;
        $order->tracking_number = $request->tracking;
        $order->method          = $request->carrier;
        $order->shipping_date   = \Carbon\Carbon::now();
        $order->save();

        if ( isset($request->note) && strlen($request->note) !== 0 )
        {
            $notes = new OrderNotes();
            $notes->order_id = $request->order_id;
            $notes->note = $request->note;
            $notes->save();
        }
        return $request->order_id;

    }

    public function showNewProductForm()
    {
        return view('admin.newproduct')
            ->with('categories', Categories::all())
            ->with('subcategories', SubCategories::all())
            ->with('colors', ColorFilters::all());
    }
    public function deleteProducts(Request $request)
    {
        Products::destroy($request->ids);

        foreach($request->ids as $id)
        {
            ProductImages::where('product_id', $id)->delete();
            ProductSizes::where('product_id', $id)->delete();
        }

        return true;

    }

    public function showOrder($id)
    {
        return view('admin.order-details')
            ->with('order_details', Orders::find($id))
            ->with('order_notes', OrderNotes::where('order_id', $id)->get());
    }
    public function showOrders()
    {
        return view('admin.orders')->with('orders', Orders::all());
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
            ->with('sales_chart', $this->dailySalesChart())
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
