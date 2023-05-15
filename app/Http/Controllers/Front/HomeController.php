<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Quiz;
use App\Models\QuizHeader;
use App\Models\Reply;
use App\Models\Section;
use App\Models\Setting;
use App\Models\UserCompany;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $categories = Category::all();
        return view('front.home', compact('setting', 'categories'));
    }

    public function forum()
    {
        $mainSection = Section::where('type', 1)->with('category')->orderBy('id', 'desc')->get();
        return view('front.forum', compact('mainSection'));
    }

    public function section($slug)
    {
        $section = Section::where('slug', $slug)->with(['questions' => function ($q) {
            $q->with('answers');
        }])->first();
        $section->increment('total_views');
        $replies = Reply::where([['section_id',$section->id],['parent_id',0]])->with(['user','children' => function ($q) {
            $q->with('user');
        }])->withCount(['likes', 'dislikes'])->get();
        return view('front.section', compact('section','replies'));
    }

    public function quiz(Request $request, Section $section)
    {
        $quizHeader = QuizHeader::create([
            'user_id' => auth()->id(),
            'section_id' => $section->id,
            'quiz_size' => $section->questions()->count(),
            'questions_taken' => serialize($request->answer),
            'completed' => 1,
            'status' => 0,
            'score' => 0,
        ]);

        foreach ($request->answer as $key => $value) {
            Quiz::create([
                'user_id' => auth()->id(),
                'section_id' => $section->id,
                'quiz_header_id' => $quizHeader->id,
                'question_id' => $key,
                'answer_id' => $value,
            ]);
        }
        return redirect()->back();
    }

    public function show($slug)
    {
        $page = Blog::where('slug', $slug)->firstOrFail();
        return view('front.page', compact('page'));
    }


}
