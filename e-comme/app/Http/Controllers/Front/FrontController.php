<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

    public function StoreNewslater(Request $request)
    {
        // validate input of category name..
        $request->validate([
            'email' => 'required|max:55|unique:newslaters|email',
        ]);
        $data = array();
        $data['email'] = $request->email;
        $data['created_at'] = Carbon::now();
        DB::table('newslaters')->insert($data);
        // Display a toaster message..
        $notification = array(
            'message' => 'Thanks For Subscribing',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
