<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Get Post Category date..
    public function BlogCatList()
    {
        $blogcat = DB::table('post_category')->get();
        return view('admin.blog.category.index', compact('blogcat'));
    }

    // Store Blog Category ...
    public function storeBlogCategory(Request $request)
    {
        $validateData = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_ar' => 'required|max:255',
        ]);

        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_ar'] = $request->category_name_ar;
        $data['created_at'] = Carbon::now();
        DB::table('post_category')->insert($data);
        // Display a toaster  Updated message..
        $notification = array(
            'message' => 'Blog Category Inserted successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Delete Blog Category ..
    public function deleteBlogCategory($cat_id)
    {
        DB::table('post_category')->where('id', $cat_id)->delete();
        // Display a toaster  delete message..
        $notification = array(
            'message' => 'Blog Category successfully Deleted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // Edit Blog Category ..
    public function editBlogCategory($cat_id)
    {
        $blogcatedit = DB::table('post_category')->where('id', $cat_id)->first();
        return view('admin.blog.category.edit', compact('blogcatedit'));
    }

    // Edit Blog Category ..
    public function updateBlogCategory(Request $request, $cat_id)
    {
        $validateData = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_ar' => 'required|max:255',
        ]);

        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_ar'] = $request->category_name_ar;
        $blogcatupdate = DB::table('post_category')->where('id', $cat_id)->update($data);
        if ($blogcatupdate) {
            // Display a toaster  Updated message..
            $notification = array(
                'message' => 'Blog Category Updated successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->route('add.blog.category.list')->with($notification);
        } else {
            // Display a toaster  Updated message..
            $notification = array(
                'message' => 'Nothing To Update.',
                'alert-type' => 'warning'
            );
            return Redirect()->route('add.blog.category.list')->with($notification);
        }

    }

    // TODO : create function Blog Post ..
    public function create()
    {
        $blogcategory = DB::table('post_category')->get();
        return view('admin.blog.category.create', compact('blogcategory'));
    }

    // TODO : create function Blog Post ..
    public function storePost(Request $request)
    {

        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_ar'] = $request->post_title_ar;
        $data['category_id'] = $request->category_id;
        $data['details_en'] = $request->details_en;
        $data['details_ar'] = $request->details_ar;
        $data['created_at'] = Carbon::now();
        // TODO : Store image in database and storage ..
        $post_image = $request->file('post_image');
        if ($post_image) {
            $post_image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400, 200)->save('media/post/' . $post_image_name);
            $data['post_image'] = 'media/post/' . $post_image_name;
            // TODO: store post in database..
            DB::table('posts')->insert($data);
            // TODO: Display a toaster  Insert message..
            $notification = array(
                'message' => 'Post Inserted successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $data['post_image'] = '';
            // TODO: store post in database..
            DB::table('posts')->insert($data);
            // TODO: Display a toaster  Insert message..
            $notification = array(
                'message' => 'Post Inserted Without Image.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    // TODO : Index function Blog Post ..
    public function index()
    {
        $post = DB::table('posts')
            ->join('post_category', 'posts.category_id', 'post_category.id')
            ->select('posts.*', 'post_category.category_name_en', 'post_category.category_name_ar')
            ->get();

        return view('admin.blog.category.index', compact('post'));
        //return response()->json($post);
    }

    // TODO : Show Post function Blog Post ..
    public function showPost($post_id)
    {
        $post = DB::table('posts')
            ->join('post_category', 'posts.category_id', 'post_category.id')
            ->select('posts.*', 'post_category.category_name_en', 'post_category.category_name_ar')
            ->where('posts.id', $post_id)
            ->first();

        return view('admin.blog.category.show', compact('post'));
        //return response()->json($post);
    }

    // TODO : Delete Post function Blog Post ..
    public function deletePost($post_id)
    {
        $post = DB::table('posts')->where('id', $post_id)->first();
        $post_image = $post->post_image;
        if ($post_image) {
            // TODO: Unlink image from storage before deleted it from DB ..
            unlink($post_image);
            DB::table('posts')->where('id', $post_id)->delete();
            // TODO: Display a toaster  Delete message..
            $notification = array(
                'message' => 'Post Deleted Successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            DB::table('posts')->where('id', $post_id)->delete();
            // TODO: Display a toaster  Delete message..
            $notification = array(
                'message' => 'Post Deleted Successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }


    // TODO : Edit Post function Blog Post ..
    public function editPost($post_id)
    {
        $post = DB::table('posts')->where('id', $post_id)->first();

        return view('admin.blog.category.edit_post', compact('post'));
        //return response()->json($post);
    }

    // TODO : Update Post function Blog Post ..
    public function updatePost(Request $request,$post_id)
    {

        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_ar'] = $request->post_title_ar;
        $data['category_id'] = $request->category_id;
        $data['details_en'] = $request->details_en;
        $data['details_ar'] = $request->details_ar;

        $old_image = $request->old_post_image;
        $post_image = $request->file('post_image');
        if ($post_image) {
            // TODO: Unlink Old image from storage before updated into DB ..
            unlink($old_image);
            $post_image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400, 200)->save('media/post/' . $post_image_name);
            $data['post_image'] = 'media/post/' . $post_image_name;
            // TODO: Insert Post Data Update Into DB ..
            DB::table('posts')->where('id', $post_id)->update($data);
            // TODO: Display a toaster  Update message..
            $notification = array(
                'message' => 'Post Updated Successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            // TODO: Insert Post Data Update Into DB ..
            DB::table('posts')->where('id', $post_id)->update($data);
            // TODO: Display a toaster  Update message..
            $notification = array(
                'message' => 'Post Updated Without Change Image.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }

    }


}
