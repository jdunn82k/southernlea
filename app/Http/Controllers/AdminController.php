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
use App\Specials;
use App\SubCategories;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer as Writer;

use Symfony\Component\HttpFoundation\StreamedResponse;


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

    public function exportProducts()
    {
        $products   = Products::all();
        $sheet_obj  = new Spreadsheet();
        $sheet      = $sheet_obj->getActiveSheet();
        $cell_count = 1;

        $sheet->setCellValue('A1', 'Description')
              ->setCellValue('B1', 'Additional Information')
              ->setCellValue('C1', 'Price')
              ->setCellValue('D1', 'Category Information')
              ->setCellValue('E1', 'Sizes Available')
              ->setCellValue('F1', 'Quantity In Stock');


        foreach($products as $product)
        {
            $cell_count++;
            $product_id = $product->id;
            $cat_id     = $product->category;
            $subcat_id  = $product->subcategory;
            $link_id    = $product->categorylink;
            $desc1      = $product->description1;
            $desc2      = $product->description2;
            $additional = $product->additional;
            $sizes_avail= ProductSizes::where('product_id', $product_id)->get();

            if ($desc2)
            {
                $description = $desc1." / ".$desc2;
            }
            else
            {
                $description = $desc1;
            }

            if ($additional)
            {
                $add = $additional;
            }
            else
            {
                $add = "";
            }

            $category_info = [];
            if ($cat_id !== 0)
            {
                $category = Categories::find($cat_id);
                if ($category)
                {
                    $category_info[] = $category->name;
                }
            }

            if ($subcat_id !== 0)
            {
                $subcategory = SubCategories::find($subcat_id);
                if ($subcategory)
                {
                    $category_info[] = $subcategory->name;
                }
            }

            if ($link_id !== 0)
            {
                $categorylink = CategoryLinks::find($link_id);
                if ($categorylink)
                {
                    $category_info[] = $categorylink->name;
                }
            }

            $size_info = [];
            if ($sizes_avail)
            {

                foreach($sizes_avail as $size)
                {
                    $size_info[] = $size->size." - ".$size->price;
                }
            }

            $sheet->setCellValue('A'.$cell_count, $description)
                  ->setCellValue('B'.$cell_count, $add)
                  ->setCellValue('C'.$cell_count, number_format($product->price, 2))
                  ->setCellValue('D'.$cell_count, implode(" / ", $category_info))
                  ->setCellValue('E'.$cell_count, implode("\n", $size_info))
                  ->setCellValue('F'.$cell_count, $product->quantityInStock);

            $sheet_obj->getActiveSheet()->getStyle('E'.$cell_count)->getAlignment()->setWrapText(true);

            $sheet_obj->getActiveSheet()->getStyle('A'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $sheet_obj->getActiveSheet()->getStyle('B'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $sheet_obj->getActiveSheet()->getStyle('C'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $sheet_obj->getActiveSheet()->getStyle('D'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $sheet_obj->getActiveSheet()->getStyle('E'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $sheet_obj->getActiveSheet()->getStyle('F'.$cell_count)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        }

        $sheet_obj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $sheet_obj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $sheet_obj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $sheet_obj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $sheet_obj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $sheet_obj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);


        $filename = "ProductExport-".date("Y-m-d").".xls";
        $writer = new Writer\Xls($sheet_obj);

        $response =  new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            }
        );
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename.'"');
        $response->headers->set('Cache-Control','max-age=0');
        return $response;
    }

    public function updateCategory(Request $request)
    {

        $category       = SubCategories::findOrFail($request->cat_id);
        $cat_links      = CategoryLinks::where('subcategory_id', $request->cat_id)->get();

        $category->name = $request->cat_name;
        $category->save();



        foreach($request->sub_cats as $sub_cat)
        {
            if ($sub_cat[0] == "0")
            {
                $subcat = new CategoryLinks();
                $subcat->subcategory_id     = $request->cat_id;
                $subcat->name               = $sub_cat[1];
                $subcat->save();
            }
            else
            {

                foreach($cat_links as $subs)
                {
                    $count = 0;
                    foreach($request->sub_cats as $sub_cat2)
                    {
                        if ($sub_cat2[0] == $subs->id){
                            $count++;
                            $subs->name = $sub_cat2[1];
                            $subs->save();
                        }
                    }
                    if ($count === 0)
                    {
                        $subs->delete();
                    }

                }


            }

        }

        return $count;
    }
    public function checkSubCat(Request $request)
    {
        return Products::where('categorylink', $request->subcat)->get();
    }

    public function deleteCat(Request $request)
    {
        $cat = Categories::findOrFail($request->cat_id);
        $subcats = SubCategories::where('category_id', $request->cat_id)->get();
        foreach($subcats as $subcat)
        {
            $categorylinks = CategoryLinks::where('subcategory_id', $subcat->id)->get();
            foreach($categorylinks as $link)
            {
                $link->delete();
            }
            $subcat->delete();
        }
        $cat->delete();
    }

    public function deleteCat2(Request $request)
    {

        $subcat = SubCategories::findOrFail($request->cat_id);
        $categorylinks = CategoryLinks::where('subcategory_id', $subcat->id)->get();
        foreach($categorylinks as $link)
        {
            $link->delete();
        }

        $subcat->delete();
        return "1";
    }

    public function categories()
    {
        return view('admin.categories')
            ->with('categories', Categories::all())
            ->with('subcategories', SubCategories::all())
            ->with('category_links', CategoryLinks::all());
    }

    public function addSubCat(Request $request)
    {
        $subcat = new SubCategories();
        $subcat->name = $request->cat_name;
        $subcat->category_id = $request->cat_id;
        $subcat->save();

        foreach($request->subcats as $catlinks)
        {
            $cat = new CategoryLinks();
            $cat->name = $catlinks;
            $cat->subcategory_id = $subcat->id;
            $cat->save();
        }
        return "1";
    }
    public function addCategory(Request $request)
    {
        $cat = new Categories();
        $cat->name = $request->cat;
        $cat->save();

        return "1";
    }

    public function getImages($product_id)
    {
        return ProductImages::where('product_id', $product_id)->get();
    }

    public function rotateImage1(Request $request)
    {

        $image_url = $request->url;


        $file = Storage::disk('image-upload')->get($image_url);
        $new_image = Image::make($file);
        $new_image->rotate(90);

        $new_image->save("img/".$image_url);

        return "1";
    }
    public function removeProductImages(Request $request)
    {
        ProductImages::destroy($request->ids);
        return "1";
    }

    public function specials()
    {
        return view('admin.specials')
            ->with('products', Products::all())
            ->with('specials', Specials::all());
    }

    public function removeImage(Request $request)
    {
        $url = str_replace("img/", "", $request->url);
        Storage::disk('image-upload')->delete($url);
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

        if (isset($request->categorylink))
        {
            $product->categorylink = $request->categorylink;
        }

        $product->additional    = $request->additional;
        $product->description1  = $request->description_1;
        $product->description2  = $request->description_2;
        $product->quantityInStock = $request->quantity;
        $product->price         = $request->price;
        $product->shipping      = $request->shipping;
        if ($request->special == "yes")
        {
            $product->special_offer = 1;
        }
        else
        {
            $request->special_offer = 0;
        }
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

    public function updateSpecial(Request $request)
    {
        $special = Specials::findOrFail($request->special_id);
        $special->name = $request->name;
        $special->price = $request->price;
        $special->size = $request->size;
        $special->image = $request->image;
        $special->save();

        return $special;
    }
    public function getSpecial($id)
    {
        return Specials::findOrFail($id);
    }

    public function addSpecial(Request $request)
    {
        $special = new Specials();
        $special->price = $request->price;
        $special->image = $request->image;
        $special->name = $request->desc;
        if (isset($request->product_id))
        {
            $special->product_id = $request->product_id;
        }
        $special->size = $request->size;
        $special->save();

        return $special;
    }

    public function removeSpecials(Request $request){
        foreach($request->ids as $id)
        {
            Specials::destroy($id);
        }
    }
    public function addSpecialImage(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $file = $request->file('file');
        $image = Image::make($file);

        $image_width = $image->width();
        $watermark_width = $image_width * 0.30;

        $filename = date('Ymdhis').'.jpg';

        $watermark = Image::make(Storage::disk('image-upload')->get('submark-01.png'))->resize($watermark_width, null, function($constraint){
            $constraint->aspectRatio();
        });

        $image->insert($watermark, 'top-right');
        $image->save('img/'.$filename);

        return response()->json(["file" => $filename, 'size' => $watermark_width, 'image-size' => $image_width]);
    }

    public function addProductImageNewProduct(Request $request)
    {
        $this->validate($request, [

            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $file = $request->file('file');
        $image = Image::make($file);
        $image_width = $image->width();
        $watermark_width = $image_width * 0.30;
        $filename = date('Ymdhis').'.jpg';

        $watermark = Image::make(Storage::disk('image-upload')->get('submark-01.png'))->resize($watermark_width, null, function($constraint){
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

        $image_width = $image->width();
        $watermark_width = $image_width * 0.30;
        $filename = date('Ymdhis').'.jpg';

        $watermark = Image::make(Storage::disk('image-upload')->get('submark-01.png'))->resize($watermark_width, null, function($constraint){
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

    public function getCats(Request $request)
    {
        return SubCategories::where('category_id', $request->id)->get();
    }

    public function getLinks(Request $request)
    {
        return CategoryLinks::where('subcategory_id', $request->id)->get();
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

        if (isset($request->categorylink))
        {
            $product->categorylink = $request->categorylink;
        }
        $product->description1  = $request->description_1;
        $product->description2  = $request->description_2;
        $product->additional    = $request->additional;
        $product->quantityInStock = $request->quantity;
        $product->price         = $request->price;
        $product->shipping      = $request->shipping;
        if ($request->special == "yes")
        {
            $product->special_offer = 1;
        }
        else
        {
            $request->special_offer = 0;
        }
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


    public function showNetIncome(Request $request)
    {
        switch ($request->filter)
        {
            case "lastmonth":

                break;
        }
    }

    public function showProduct($id)
    {
        return view('admin.product-details')
            ->with('product', Products::findOrFail($id))
            ->with('categories', Categories::all())
            ->with('subcategories', SubCategories::all())
            ->with('categorylinks', CategoryLinks::all())
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
