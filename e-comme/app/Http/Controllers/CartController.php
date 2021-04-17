<?php

namespace App\Http\Controllers;


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    public function addCart($product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        $data = array();
        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options'] = ['color' => '', 'size' => '', 'image' => $product->image_one];
            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options'] = ['color' => '', 'size' => '', 'image' => $product->image_one];
            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }

    }

    public function check()
    {
        $content = Cart::content();
        return response()->json($content);
    }

    // TODO: show all cart content..
    public function showCart()
    {
        $cart = Cart::content();
        //return response()->json($cart);
        return view('pages.cart', compact('cart'));

    }

    public function removeCart($rowId)
    {
        Cart::remove($rowId);
        // TODO: Display a toaster  remove cart message..
        $notification = array(
            'message' => 'Product Remove from cart.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function updateCartQty(Request $request)
    {
        $product_id = $request->product_id;
        Cart::update($product_id, ['qty' => $request->qty]); // TODO: Will update the qty
        // TODO: Display a toaster  remove cart message..
        $notification = array(
            'message' => 'Quantity Updated Successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function viewProduct($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.id', $id)
            ->first();
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return \response()->json(array(
            'product' => $product,
            'size' => $product_size,
            'color' => $product_color,

        ));
    }

    public function insertCart(Request $request)
    {
        $id = $request->product_id;

        $product = DB::table('products')->where('id', $id)->first();
        $color = $request->color;
        $size = $request->size;
        $qty = $request->qty;
        $data = array();
        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options'] = ['color' => $color, 'size' => $size, 'image' => $product->image_one];
            Cart::add($data);
            // TODO: Display a toaster  Added cart message..
            $notification = array(
                'message' => 'Successfully Added on Your Cart',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);

        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options'] = ['color' => $color, 'size' => $size, 'image' => $product->image_one];
            Cart::add($data);
            // TODO: Display a toaster  Added cart message..
            $notification = array(
                'message' => 'Successfully Added on Your Cart',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    public function checkout()
    {
        if (Auth::check()) {

            $cart = Cart::content();
            return view('pages.checkout', compact('cart'));
        } else {
            // TODO: Display a toaster  warning cart message..
            $notification = array(
                'message' => 'At First Login Your Account',
                'alert-type' => 'warning'
            );
            return Redirect()->route('login')->with($notification);
        }
    }

    public function wishlist()
    {
        $user_id = Auth::id();
        $product = DB::table('wishlists')
            ->join('products', 'wishlists.product_id', 'products.id')
            ->select('products.*', 'wishlists.user_id')
            ->where('wishlists.user_id', $user_id)
            ->get();

        //return \response()->json($product);
        return view('pages.wishlist', compact('product'));
    }

    public function coupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = DB::table('coupons')->where('coupon', $coupon)->first();
        if ($check) {
            Session::put('coupon', [
                'name' => $check->coupon,
                'discount' => $check->discount,
                'balance' => Cart::subtotal() - $check->discount,
            ]);
            // TODO: Display a toaster  success cart message..
            $notification = array(
                'message' => 'Successfully Coupon Applied',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            // TODO: Display a toaster  success cart message..
            $notification = array(
                'message' => 'Invalid Coupon',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        // TODO: Display a toaster  success cart message..
        $notification = array(
            'message' => ' Coupon Removed Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function paymentPage()
    {
        $cart = Cart::content();
        return view('pages.payment',compact('cart'));
    }

}
