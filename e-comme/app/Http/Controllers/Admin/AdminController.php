<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // create index home function..
    public function index()
    {
        return view('admin.home');
    }

    // Create Logout Admin Function..
    public function logout()
    {
        Auth::logout();
        $notification = array(
           'message' => 'Admin Successfully Logout',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.login')->with($notification);
    }
}
