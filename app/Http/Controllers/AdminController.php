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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function rotateImage1(Request $request)
    {

        $image_url = $request->url;


        $file = Storage::disk('image-upload')->get($image_url);
        $new_image = Image::make($file);
        $new_image->rotate(90);

        $new_image->save("img/".$image_url);

        return response();
    }
    public function removeProductImages(Request $request)
    {
        ProductImages::destroy($request->ids);
        return "1";
    }

    public function newProduct(Request $request)
    {
        $product = new Products();
        $product->category      = $request->category;

        if (isset($request->subcategory))
        {
            $product->subcategory   = $request->subcategory;

        }
        $product->description1  = $request->description_1;
        $product->description2  = $request->description_2;
        $product->quantityInStock = $request->quantity;
        $product->price         = $request->price;
        $product->save();

        if (isset($request->new_sizes))
        {
            foreach($request->new_sizes as $size)
            {
                $new_size = new ProductSizes();
                $new_size->product_id = $product->id;
                $new_size->size = $size['size'];
                $new_size->quantity = $size['quantity'];
                $new_size->price = $size['price'];
                $new_size->save();
            }
        }


        //Add images
        if (isset($request->new_images))
        {
            $count = 0;
            foreach($request->new_images as $image)
            {
                $new_image = new ProductImages();
                $new_image->product_id = $product->id;
                $new_image->url         = "img/".$image;

                if (isset($request->defaultImage))
                {
                    if ($request->defaultImage === $image)
                    {
                        $new_image->default = 1;
                    }
                    else
                    {
                        $new_image->default = 0;
                    }
                }
                else
                {
                    if ($count === 0)
                    {
                        $new_image->default = 1;
                    }
                    else
                    {
                        $new_image->default = 0;
                    }
                }


                $new_image->save();
                $count++;

            }
        }

        return $product;

    }

    public function addProductImageNewProduct(Request $request)
    {
        $this->validate($request, [

            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $file = $request->file('file');
        $image = Image::make($file);

        $filename = date('Ymdhis').'.jpg';

        $watermark = Image::make(Storage::disk('image-upload')->get('submark-01.png'))->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        });

        $image->insert($watermark, 'top-right');
        $image->save('img/'.$filename);

        return response()->json(["file" => $filename]);
    }
    public function addProductImage(Request $request)
    {
        $this->validate($request, [

            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $file = $request->file('file');
        $image = Image::make($file);

        $filename = date('Ymdhis').'.jpg';

        $watermark = Image::make(Storage::disk('image-upload')->get('submark-01.png'))->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        });

        $image->insert($watermark, 'top-right');
        $image->save('img/'.$filename);
//        $file = $request->file('file')->store(false, 'image-upload');



        if (isset($request->product_id))
        {
            $image = new ProductImages();
            $image->product_id = $request->product_id;
            $image->url = "img/".$filename;
            $image->default = 0;
            $image->save();
            return response()->json(["id" => $image->id, "file" => $filename]);

        }

        return response()->json(["file" => $filename]);


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

        return "true";

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

    public function updateProduct(Request $request)
    {
        $product                = Products::find($request->product_id);
        $product->category      = $request->category;

        if (isset($request->subcategory))
        {
            $product->subcategory   = $request->subcategory;

        }
        $product->description1  = $request->description_1;
        $product->description2  = $request->description_2;
        $product->quantityInStock = $request->quantity;
        $product->price         = $request->price;
        $product->save();

        //Check for default image
        if (isset($request->defaultImage))
        {
            $images = ProductImages::where('product_id', $request->product_id)->get();
            foreach($images as $image)
            {
                $image->default = 0;
                $image->save();
            }

            $image = ProductImages::find($request->defaultImage);
            $image->default = 1;
            $image->save();

        }

        //Check Existing Sizes
        $existing_sizes = ProductSizes::where('product_id', $request->product_id)->get();


        foreach($existing_sizes as $size)
        {
            if (!isset($request->existing_sizes) || !in_array($size->id, $request->existing_sizes))
            {
                $size->delete();
            }
        }

        //Check new sizes
        if (isset($request->new_sizes))
        {
            foreach($request->new_sizes as $size)
            {
                $new_size = new ProductSizes();
                $new_size->product_id = $request->product_id;
                $new_size->size = $size['size'];
                $new_size->quantity = $size['quantity'];
                $new_size->price = $size['price'];
                $new_size->save();
            }
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
