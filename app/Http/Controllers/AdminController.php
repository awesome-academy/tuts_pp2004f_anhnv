<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin_default.pages.index');
    }

    public function page404()
    {
        return view('admin_default.pages.404');
    }
}
