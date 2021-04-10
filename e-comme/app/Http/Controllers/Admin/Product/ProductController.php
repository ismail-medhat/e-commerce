<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Get All Product From Database..
    public function index()
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->get();
        //return response()->json($product);
        return view('admin.product.index', compact('product'));

    }

    // Create Product and Store it in Database..
    public function create()
    {
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.create', compact('category', 'brand'));
    }

    // Get Sub Category by ajax..
    public function GetSubcat($category_id)
    {
        $cat = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_decode($cat);
    }

    // store product into database..
    public function store(Request $request)
    {
        // validate input of Product Table..
//        $request->validate([
//            'product_name' => 'required',
//            'product_code' => 'required',
//            'product_quantity' => 'required',
//            'product_details' => 'required',
//            'product_size' => 'required',
//            'product_color' => 'required',
//            'selling_price' => 'required',
//        ]);


        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['status'] = 1;
        $data['created_at'] = Carbon::now();


        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if ($image_one && $image_two && $image_three) {
            $image_one_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300, 300)->save('media/product/' . $image_one_name);
            $data['image_one'] = 'media/product/' . $image_one_name;

            $image_two_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_two)->resize(300, 300)->save('media/product/' . $image_two_name);
            $data['image_two'] = 'media/product/' . $image_two_name;

            $image_three_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_three)->resize(300, 300)->save('media/product/' . $image_three_name);
            $data['image_three'] = 'media/product/' . $image_three_name;

            $product = DB::table('products')->insert($data);
            // Display a toaster  Updated message..
            $notification = array(
                'message' => 'Product Inserted successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }

        //return response()->json($data);

    }

    // Change Product Status To Inactive..
    public function inactive($product_id)
    {
        DB::table('products')->where('id', $product_id)->update(['status' => 0]);
        // Display a toaster  Updated message..
        $notification = array(
            'message' => 'Product successfully Inactive',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Change Product Status To Active..
    public function active($product_id)
    {
        DB::table('products')->where('id', $product_id)->update(['status' => 1]);
        // Display a toaster  Updated message..
        $notification = array(
            'message' => 'Product successfully Active',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Delete Product From Database..
    public function deleteproduct($product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        // Unlink Images From public directory..
        $image1 = $product->image_one;
        $image2 = $product->image_two;
        $image3 = $product->image_three;
        unlink($image1);
        unlink($image2);
        unlink($image3);
        DB::table('products')->where('id', $product_id)->delete();
        // Display a toaster  delete message..
        $notification = array(
            'message' => 'Product successfully Deleted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // View Product From Database..
    public function show($product_id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name', 'subcategories.subcategory_name')
            ->where('products.id', $product_id)
            ->first();
        //return response()->json($product);
        return view('admin.product.show', compact('product'));

    }

    // Edit Product Details..
    public function editproduct($product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        return view('admin.product.edit', compact('product'));
    }

    // Update Product without image..
    public function updateproduct(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['discount_price'] = $request->discount_price;
        $data['status'] = 1;

        $update = DB::table('products')->where('id', $product_id)->update($data);
        if ($update) {
            // Display a toaster  update message..
            $notification = array(
                'message' => 'Product successfully Updated',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notification);
        } else {
            // Display a toaster  update message..
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'warning'
            );
            return Redirect()->route('all.product')->with($notification);
        }
    }

    // Update Product with image..
    public function UpdateProductImges(Request $request,$product_id)
    {
        // use query builder..
        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;
        $data = array();
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');
        if ($image_one)
        {
            unlink($old_one);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image_one->move($upload_path,$image_full_name);
            // save image in array..
            $data['image_one'] = $image_url;
            // insert all data from array into database..
            $productImg = DB::table('products')->where('id',$product_id)->update($data);

            // Display a toaster message..
            $notification = array(
                'message' => 'Image One Updated successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }

        if ($image_two)
        {
            unlink($old_two);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image_two->move($upload_path,$image_full_name);
            // save image in array..
            $data['$image_two'] = $image_url;
            // insert all data from array into database..
            $productImg = DB::table('products')->where('id',$product_id)->update($data);

            // Display a toaster message..
            $notification = array(
                'message' => 'Image Two Updated successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }

        if ($image_three)
        {
            unlink($old_three);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image_three->move($upload_path,$image_full_name);
            // save image in array..
            $data['$image_three'] = $image_url;
            // insert all data from array into database..
            $productImg = DB::table('products')->where('id',$product_id)->update($data);

            // Display a toaster message..
            $notification = array(
                'message' => 'Image Three Updated successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }
    }

}
