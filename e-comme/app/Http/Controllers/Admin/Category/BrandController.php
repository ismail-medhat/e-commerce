<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Get Brand Data..
    public function brand()
    {
        $brand = Brand::all();
        return view('admin.category.brand', compact('brand'));
    }

    // store brand in database..
    public function storeBrand(Request $request)
    {

        // validate input of category name..
        $request->validate([
            'brand_name' => 'required|max:55|unique:brands',
            'brand_logo' => 'required',
        ]);

        // use query builder..
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['created_at'] = Carbon::now();
        $image = $request->file('brand_logo');
        if ($image)
        {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            // save image in array..
            $data['brand_logo'] = $image_url;
            // insert all data from array into database..
            DB::table('brands')->insert($data);

            // Display a toaster message..
            $notification = array(
                'message' => 'Brand Inserted successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else {
            DB::table('brands')->insert($data);
            // Display a toaster message..
            $notification = array(
                'message' => 'Its Done.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    // Delete Category From database..
    public function deleteBrand($brand_id)
    {
        // select brand row by id..
        $data = DB::table('brands')->where('id',$brand_id)->first();
        $image = $data->brand_logo;
        // Delete image in folder..
        unlink($image);
        // Delete image from database.
        DB::table('brands')->where('id',$brand_id)->delete();
        // Display a toaster  Deleted message..
        $notification = array(
            'message' => 'Brand Deleted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Get Brand Name by id to edit it..
    public function editBrand($brand_id)
    {
        // get brand by brand_id..
        $brand = DB::table('brands')->where('id',$brand_id)->first();
        return view('admin.category.edit_brand',compact('brand'));
    }

    // Update Brand Name by id ..
    public function updateBrand(Request $request,$brand_id)
    {
        // validate input of category name..
        $request->validate([
            'brand_name' => 'required|max:255',
        ]);

        // use query builder..
        $old_logo = $request->old_logo;
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['updated_at'] = Carbon::now();
        $image = $request->file('brand_logo');
        if ($image)
        {
            unlink($old_logo);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            // save image in array..
            $data['brand_logo'] = $image_url;
            // insert all data from array into database..
            DB::table('brands')->where('id',$brand_id)->update($data);

            // Display a toaster message..
            $notification = array(
                'message' => 'Brand Updated successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands')->with($notification);
        }else {
            DB::table('brands')->where('id',$brand_id)->update($data);
            // Display a toaster message..
            $notification = array(
                'message' => 'Update Without Image',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands')->with($notification);
        }
    }


}
