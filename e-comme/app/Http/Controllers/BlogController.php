<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class BlogController extends Controller
{
    public function blog()
    {
        $post = DB::table('posts')
            ->join('post_category','posts.category_id','post_category.id')
            ->select('posts.*','post_category.category_name_en','post_category.category_name_ar')
            ->get();
        //return response()->json($post);
        return view('pages.blog',compact('post'));
    }

    public function english()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','english');
        return redirect()->back();

    }

    public function arabic()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','arabic');
        return redirect()->back();

    }

    public function singleBlog($id)
    {
        $post = DB::table('posts')->where('id',$id)->get();
        return view('pages.blog_single',compact('post'));
    }
}
