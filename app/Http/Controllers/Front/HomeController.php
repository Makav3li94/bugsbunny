<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\UserCompany;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $categories = Category::all();
        return view('front.home',compact('setting','categories'));
    }

    public function forum()
    {
        return view('front.forum');
    }

    public function show($slug)
    {
        $page = Blog::where('slug', $slug)->firstOrFail();
        return view('front.page', compact('page'));
    }


}
