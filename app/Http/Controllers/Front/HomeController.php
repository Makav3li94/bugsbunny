<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Blog;
use App\Models\Category;
use App\Models\FrontCallTo;
use App\Models\FrontFaq;
use App\Models\FrontFeature;
use App\Models\FrontHero;
use App\Models\FrontOverlay;
use App\Models\FrontSocail;
use App\Models\FrontWay;
use App\Models\Like;
use App\Models\LogActivity;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizHeader;
use App\Models\Reply;
use App\Models\Section;
use App\Models\Setting;
use App\Models\TotalScore;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $categories = Category::all();

        $frontFaqs = FrontFaq::all();
        $frontCallTo = FrontCallTo::first();
        $frontFeatures = FrontFeature::all();
        $frontHeros = FrontHero::first();
        $frontOverlay = FrontOverlay::first();
        $frontWays = FrontWay::all();

        return view('front.home', compact('setting', 'categories', 'frontCallTo', 'frontFaqs', 'frontFeatures', 'frontHeros', 'frontOverlay', 'frontWays'));
    }

    public function user($username)
    {
        $user = User::where('username', $username)->first();

        //Open Tickets Count
        if (Setting::all()->count() > 0) {
            $setting = Setting::all()->first();
        } else {
            $setting = null;
        }
        $cats = Category::all();
        //Sliders
        $userSections = Section::where([['type', 0],['status', 2], ['user_id', auth()->id()]])->orWhere('status', 4)->get();
//        $likeDis=  Like::query()->whereMorphedTo('userable', $user)->get();
        $activities = LogActivity::where('user_id', auth()->id())->get();
        $plusScores = TotalScore::where([['user_id', $user->id], ['type', 1]])->get()->sum('score');
        $minusScores = TotalScore::where([['user_id', $user->id], ['type', 0]])->get()->sum('score');
//        $totalScore = ($likes - $dislikes) + ($plusScores - $minusScores);
        $totalScore = $plusScores - $minusScores;
        return view('user.profile', compact('setting', 'cats', 'user',  'userSections', 'activities','totalScore'));
    }

    public function forum()
    {
        $mainSection = Section::where([['status', 2], ['kind', 0], ['type', 1]])->with('category')->orderBy('id', 'desc')->get();
        $userSection = Section::where([['status', 2], ['kind', 0], ['type', 0]])->with('category')->orderBy('id', 'desc')->get();

        $threads = Section::where([['status', 2], ['kind', 1]])->with('category')->orderBy('id', 'desc')->get();

        return view('front.forum', compact('mainSection', 'userSection', 'threads'));
    }

    public function section($slug)
    {
        $section = Section::where('slug', $slug)->with(['questions' => function ($q) {
            $q->with('answers');
        }])->first();
        $section->increment('total_views');
        $best_user = '';
        $replies = Reply::where([['section_id', $section->id], ['parent_id', 0]])->with(['user', 'children' => function ($q) {
            $q->with('user')->withCount(['likes', 'dislikes']);
        }])->withCount(['likes', 'dislikes'])->get();
        if ($section->status == 4){
//          return  $best_user = QuizHeader::latest()->where('section_id',$section->id)->value('score');
            $best_user = QuizHeader::where('section_id',$section->id)->orderBy('score', 'desc')->first();
        }
        return view('front.section', compact('section', 'replies','best_user'));
    }

    public function category($slug)
    {
        $category = Category::where('title', $slug)->first();
        $section = Section::where('category_id', $category->id)->with('category')->orderBy('id', 'desc')->get();
        return view('front.category', compact('section'));
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
            $q = Question::where('id', $key)->first();
            $a = Answer::where([['question_id', $q->id], ['is_checked', '1']])->first();
            $ua = Answer::find($value);

            Quiz::create([
                'user_id' => auth()->id(),
                'section_id' => $section->id,
                'quiz_header_id' => $quizHeader->id,
                'question_id' => $key,
                'answer_id' => $value,
                'is_correct' => $a->id == $ua->id ? $q->unit : 0
            ]);
        }
        return redirect()->back();
    }

    public function show($slug)
    {
        $page = Blog::where('slug', $slug)->first();
        if (!$page) {
            return redirect(route($slug));
        }
        return view('front.page', compact('page'));
    }


    public function search(Request $request)
    {
        if ($request->ajax()) {
            $val = $request->input('val');
            $cat = $request->input('cat');
            if ($cat == 'all') {
                $sectionByTitle = Section::where([['status', '=', 2], ['title', 'like', "%$val%"]])->get();
            } else {
                $sectionByTitle = Section::where([['status', '=', 2], ['category_id', $cat ?? true], ['title', 'like', "%$val%"]])->get();
            }
            if (count($sectionByTitle) == 0) {
                return response()->json([
                    'records' => 'none'
                ]);
            } else {
                $result = [];

                foreach ($sectionByTitle as $key => $section) {
                    $result[$key] = [
                        'name' => $section->title,
                        'link' => route('section', $section->slug),
                    ];
                }
                return response()->json([
                    'records' => $result
                ]);
            }
        }
    }
}
