<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Coupon()
    {
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon',compact('coupon'));
    }

    // store Coupon in database..
    public function storeCoupon(Request $request)
    {
        // validate input of category name..
        $request->validate([
            'coupon' => 'required|max:55|unique:coupons',
            'discount' => 'required|numeric',
        ]);
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        $data['created_at'] = Carbon::now();
        DB::table('coupons')->insert($data);
        // Display a toaster message..
        $notification = array(
            'message' => 'Coupon Inserted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Delete Coupon from database..
    public function deleteCoupon($coupon_id)
    {
        DB::table('coupons')->where('id',$coupon_id)->delete();
        // Display a toaster message..
        $notification = array(
            'message' => 'Coupon Deleted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Get Coupon Name by id to edit it..
    public function editCoupon($coupon_id)
    {
        // get coupon by cat_id..
        $coupon = DB::table('coupons')->where('id',$coupon_id)->first();
        return view('admin.coupon.edit_coupon',compact('coupon'));
    }

    // Update Coupon Name by id ..
    public function updateCoupon(Request $request,$coupon_id)
    {
        // validate input of coupon name..
        $request->validate([
            'coupon' => 'required|max:255',
            'discount' => 'required|numeric',
        ]);
        // update coupon by cat_id..
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        //$data['updated_at'] = Carbon::now();
        $update_coupon = DB::table('coupons')->where('id',$coupon_id)->update($data);
        if ($update_coupon)
        {
            // Display a toaster  Updated message..
            $notification = array(
                'message' => 'Coupons Updated successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.coupon')->with($notification);
        }else {
            // Display a toaster No Updated message..
            $notification = array(
                'message' => 'Nothing Data To Update.',
                'alert-type' => 'warning'
            );
            return Redirect()->route('admin.coupon')->with($notification);
        }
    }

    // Newslater Methods..
    public function Newslater()
    {
        $subscribe = DB::table('newslaters')->get();
        return view('admin.coupon.newslater',compact('subscribe'));
    }

    // Delete News Laters from database..
    public function deleteNewslater($news_id)
    {
        DB::table('newslaters')->where('id',$news_id)->delete();
        // Display a toaster message..
        $notification = array(
            'message' => 'Email Subscribe Deleted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

}
