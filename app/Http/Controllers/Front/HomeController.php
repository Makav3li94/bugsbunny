<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\UserCompany;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function blogs()
    {
        $blogs = Blog::paginate(2);
        return view('front.blogs', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->with('tags')->firstOrFail();
        $blogs = Blog::where('id', '!=', $blog->id)->orderBy('id', 'desc')->take(3)->get();
        $bc = count($blogs);
        return view('front.single_page', compact('blog', 'blogs', 'bc'));
    }


}
