<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subcategory()
    {
        $category = DB::table('categories')->get();
        $subcat = Subcategory::all();
        //return $subcat;
        return view('admin.category.subcategory', compact('subcat','category'));
    }

    // store category in database..
    public function storeSubcategory(Request $request)
    {

        // validate input of category name..
        $request->validate([
            'subcategory_name' => 'required',
        ]);

        // use query builder..
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['created_at'] = Carbon::now();
        DB::table('subcategories')->insert($data);

        // Display a toaster message..
        $notification = array(
            'message' => 'Sub Category Inserted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);

    }

    // Delete Sub Category From database..
    public function deleteSubcategory($subcat_id)
    {
        DB::table('subcategories')->where('id',$subcat_id)->delete();
        // Display a toaster  Deleted message..
        $notification = array(
            'message' => 'Sub Category Deleted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Get Sub Category Name by id to edit it..
    public function editSubcategory($subcat_id)
    {
        // get category by cat_id..
        $subcategory = DB::table('subcategories')->where('id',$subcat_id)->first();
        $category = DB::table('categories')->get();
        return view('admin.category.edit_subcategory',compact('subcategory','category'));
    }

    // Update Sub Category Name by id ..
    public function updateSubcategory(Request $request,$subcat_id)
    {
        // validate input of Sub category name..
        $request->validate([
            'subcategory_name' => 'required|max:255'
        ]);

        // use query builder..
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['updated_at'] = Carbon::now();
        DB::table('subcategories')->where('id',$subcat_id)->update($data);

        // Display a toaster message..
        $notification = array(
            'message' => 'Sub Category Updated successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->route('sub.categories')->with($notification);

    }
}
