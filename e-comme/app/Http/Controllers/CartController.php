<?php

namespace App\Http\Controllers;


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function addCart($product_id)
    {
        $product = DB::table('products')->where('id',$product_id)->first();
        $data = array();
        if ($product->discount_price == NULL)
        {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['option']['image'] = $product->image_one;
            //Cart::add($data);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['option']['image'] = $product->image_one;
            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }

    }

    public function check()
    {
        $content =  Cart::content();
        return response()->json($content);
    }

}
