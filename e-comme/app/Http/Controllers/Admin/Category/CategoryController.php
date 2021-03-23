<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category()
    {
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }

    // store category in database..
    public function storeCategory(Request $request)
    {

        // validate input of category name..
        $request->validate([
            'category_name' => 'required|max:255|unique:categories'
        ]);

        // use query builder..
//        $data = array();
//        $data['category_name'] = $request->category_name;
//        $data['created_at'] = Carbon::now();
//        DB::table('categories')->insert($data);

        // store category by using Model category..
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->created_at = Carbon::now();
        $category->save();

        // Display a toaster message..
        $notification = array(
            'message' => 'Category added successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Delete Category From database..
    public function deleteCategory($cat_id)
    {
        DB::table('categories')->where('id',$cat_id)->delete();
        // Display a toaster  Deleted message..
        $notification = array(
            'message' => 'Category Deleted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Get Category Name by id to edit it..
    public function editCategory($cat_id)
    {
        // get category by cat_id..
        $category = DB::table('categories')->where('id',$cat_id)->first();
        return view('admin.category.edit_category',compact('category'));
    }

    // Update Category Name by id ..
    public function updateCategory(Request $request,$cat_id)
    {
        // validate input of category name..
        $request->validate([
            'category_name' => 'required|max:255'
        ]);
        // update category by cat_id..
        $data = array();
        $data['category_name'] = $request->category_name;
        //$data['updated_at'] = Carbon::now();
        $update_category = DB::table('categories')->where('id',$cat_id)->update($data);
        if ($update_category)
        {
            // Display a toaster  Updated message..
            $notification = array(
                'message' => 'Category Updated successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->route('categories')->with($notification);
        }else {
            // Display a toaster No Updated message..
            $notification = array(
                'message' => 'Nothing Data To Update.',
                'alert-type' => 'warning'
            );
            return Redirect()->route('categories')->with($notification);
        }
    }

}
