<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{


    public function addWishlist($product_id)
    {
        $user_id = Auth::id();
        $check = DB::table('wishlists')->where('user_id', $user_id)->where('product_id', $product_id)->first();
        $data = array();
        $data['user_id'] = $user_id;
        $data['product_id'] = $product_id;
        if (Auth::check()) {
            if ($check) {
                return response()->json(['error' => 'Product Already Has On Wishlist']);

            } else {
                DB::table('wishlists')->insert($data);
                return response()->json(['success' => 'Product Add On Wishlist']);
            }

        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }

}
