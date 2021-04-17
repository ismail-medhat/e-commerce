<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productView($product_id, $product_name)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.id', $product_id)
            ->first();
        $color = $product->product_color;
        $product_color = explode(',', $color);
        $size = $product->product_size;
        $product_size = explode(',', $size);
        return view('pages.product_details', compact('product', 'product_color', 'product_size'));
    }

    public function addCart(Request $request, $product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        $data = array();
        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options'] = ['color' => $request->color, 'size' => $request->size, 'image' => $product->image_one];
            Cart::add($data);
            // TODO: Display a toaster  cart message..
            $notification = array(
                'message' => 'Product successfully Added',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options'] = ['color' => $request->color, 'size' => $request->size, 'image' => $product->image_one];
            Cart::add($data);
            // TODO: Display a toaster  cart message..
            $notification = array(
                'message' => 'Product successfully Added',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    public function productsView($id)
    {
        $products = DB::table('products')->where('subcategory_id', $id)->paginate(5);
        $subcat_id = $id;
        $categories = DB::table('categories')->get();
        $brands = DB::table('products')->where('subcategory_id', $id)
                    ->select('brand_id')->groupBy('brand_id')->get();
        return view('pages.all_products', compact('products', 'subcat_id', 'categories','brands'));
    }

    public function viewAllCat($id)
    {
        $cat_all = DB::table('products')->where('category_id', $id)->paginate(10);
        $cat_id = $id;
        return view('pages.all_category',compact('cat_all','cat_id'));
    }

}
